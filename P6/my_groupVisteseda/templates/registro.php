<?php
function MP_Register_FormVisteseda($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>
    <head>
       <script type="text/javascript" src="/wp-content/plugins/my_groupVisteseda/templates/imagen.js" charset="utf-8"  async defer ></script>  

    </head>
    <h1>Gestión de Usuarios </h1>
    <form class="fom_usuario" action="?action=mis_datos&proceso=registrar" method="POST" enctype="multipart/form-data">
        <label for="clienteMail">Tu correo</label>
        <br/>
        <input type="text" name="clienteMail"  size="20" maxlength="25" value="<?php print $user_email?>"
        readonly />
        <br/>
        <legend>Datos básicos</legend>
        <label for="nombre">Nombre</label>
        <br/>
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["nombre"] ?>"
        placeholder="Miguel Cervantes" />
        <br/>
        <label for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" />
        <br/>
        <label for="foto_file">Fotografía</label>
        <br/>
       
        <br/>
        <input type="file" id="foto" name="foto_file" class="item_requerid" value="<?php print $MP_user["foto_file"] ?>"
        placeholder="nombre de la foto" />
        <br/>
        <br/>
        <p>
            <img id="img_foto" src="" width=100 height=100> 
        </p>
        <script src="/wp-content/plugins/my_groupVisteseda/templates/script1.js" type="text/javascript" defer charset="utf-8">
         </script> 
        

        <br/>
        <br/>
        <input class='botones menu-principal-container' type="submit" value="Enviar">
        <input class='botones menu-principal-container' type="reset" value="Deshacer">
    </form>
    <br/>
    <table>
        <td align="center"> <a class='botones menu-principal-container' href='admin-post.php?action=mis_datos&proceso=registro'>Registro</a> </td>
	    <td align="center"> <a class='botones menu-principal-container' href='admin-post.php?action=mis_datos&proceso=listar'>Listar</a> </td>
    </table>
<?php
}

wp_register_script('miscript',get_stylesheet_directory_uri().'/plugins/my_groupVisteseda/templates/imagen.js' );
wp_enqueue_script('miscript');

$MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
MP_Register_FormVisteSeda($MP_user,$user_email);
?>