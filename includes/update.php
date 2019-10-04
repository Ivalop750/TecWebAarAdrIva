<?php
include("./gestionBD.php");
$table = "A_cliente";
$result=buscar($pdo,$table,$_GET['client_id']);
//var_dump($result);
?>
<main>
	<h1>Modificar Usuarios </h1>
	<form class="form_usuario" action="?action=controlUpdate" method="POST">

		<legend>Datos básicos</legend>
		<br>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $result["nombre"] ?>"
		 />
		<br>
		<label for="apellido">Apellidos</label>
		<br/>
		<input type="text" name="apellido" class="item_requerid" size="20" maxlength="25" value="<?php print $result["apellidos"] ?>"
		  />
	
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $result["email"] ?>"
		  />
	  	<br/>
		<label for="dni">DNI</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="20" maxlength="25" value="<?php print $result["dni"] ?>"
		  />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $result["clave"] ?>"
		/>
		<br/>
		<label for="foto_file">Foto</label>
		<br/>
		<input type="hidden" name="client_id" value="<?php print $result["client_id"] ?>"/>
		<input type="text" name="foto_file" class="item_requerid" size="20" maxlength="25" value="<?php print $result["foto_file"] ?>" 
		 />
		<br/>
		<br>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>