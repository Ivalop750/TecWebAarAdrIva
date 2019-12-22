function mostrarFoto(file, imagen) {
    //carga la imagen de file en el elemento src imagen
    var reader = new FileReader();
    reader.addEventListener("load", function () {
    imagen.src = reader.result;
    });
    reader.readAsDataURL(file);
}


function ready() {
    var fichero = document.querySelector("#foto");
    var imagen  = document.querySelector("#img_foto");
    //escuchamos evento selección nuevo fichero.
    fichero.addEventListener("change", function (event) {
        
        if(!/.(jpg|jpeg)$/i.test(fichero.value)){
            alert("Comprueba la extensión de la imagen, solo puede ser .jpg");
            this.value=' ';
            this.files[0]=' ';
        }
        var tam=this.files[0].size
        var tamKB=tam/1024;
        if(tamKB > 400){
            alert("Las imagen es demasiado grande, supera los 400 KB");
            this.value=' ';
            this.files[0]=' ';
        }
        else{
            mostrarFoto(this.files[0], imagen);
        }
        
    });
}

ready();