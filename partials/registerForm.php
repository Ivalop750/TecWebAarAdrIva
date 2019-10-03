<main>
	<h1>GestiÓn de Usuarios </h1>
	<form class="fom_usuario" action="?action=registrar" method="POST">

		<legend>Datos básicos</legend>
		<label for="client_id">client_id</label>
		<br/>
		<input type="number" name="client_id" class="item_requerid" size="20" maxlength="25" value="<?php print $client_id ?>"
		 placeholder="" />
		<br/>
		<label for="nombre">Nombre</label>
		<br/>
		<input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $userName ?>"
		 placeholder="Juan" />
		<br/>
		<label for="apellidos">Apellidos</label>
		<br/>
		<input type="text" name="apellidos" class="item_requerid" size="20" maxlength="25" value="<?php print $apellidos ?>"
		 placeholder="Benitez Garcia " />
		<br/>
		<label for="email">Email</label>
		<br/>
		<input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $email ?>"
		 placeholder="kiko@ic.es" />
		<br/>
		<label for="dni">dni</label>
		<br/>
		<input type="text" name="dni" class="item_requerid" size="9" maxlength="9" value="<?php print $dni ?>"
		 placeholder="" />
		<br/>
		<label for="passwd">Clave</label>
		<br/>
		<input type="password" name="passwd" class="item_requerid" size="8" maxlength="25" value="<?php print $passwd ?>"
		/>
		<br/>
		<label for="foto">Foto</label>
		<br/>
		<input type="text" name="foto" class="item_requerid" size="20" maxlength="25"value="<?php print $foto ?>"
		 placeholder="" />
		<br/>
		<br/>
		<input type="submit" value="Enviar">
		<input type="reset" value="Deshacer">
	</form>
</main>