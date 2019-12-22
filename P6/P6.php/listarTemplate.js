var myInit = {
	method: 'GET'
};


function cargarTemplate(datos)
{
	if (document.querySelector('template').content) {

		// Instantiate the table with the existing HTML tbody and the row with the template
		var t = document.querySelector('#productrow');
		var tb = document.getElementsByTagName("tbody");
		var clone;
		td = t.content.querySelectorAll("td");
	    img= t.content.querySelectorAll("img");

		for (var i = 0; i < datos.length; i++) {
			  td[0].textContent = datos[i].person_id;
            td[1].textContent = datos[i].nombre;
            td[2].textContent = datos[i].email;
            img[0].src = datos[i].foto_file + datos[i].foto_file;
            td[4].textContent = datos[i].clienteMail;
    
            clone = document.importNode(t.content, true);
            tb[0].appendChild(clone);

		}
	}
}


async function llamarTemplate(url_template, data) {
	var myRequest = new Request(url_template,);
	try {
		const response = await fetch(myRequest,myInit);
		const respuestaHTML = 	await response.text()


		if (response.status == 200) {
			document.querySelector('#plantilla').innerHTML = respuestaHTML;
			cargarTemplate(data);

		} else throw new Error('ERROOORRR!');

	} catch (error) {
		console.log(error);
	}
}


document.querySelector('#listar').addEventListener("click", async function (event) {
	event.preventDefault();
	try {
	
		const response = await fetch(event.target.href,myInit);
		const resJson = await response.json();
		if (response.status != 200) {
			 throw new Error('HAY ALGO MAL!');}
		
		llamarTemplate(resJson.plantilla, resJson.datos);

	} catch (error) {
		console.log(error);
	}
});