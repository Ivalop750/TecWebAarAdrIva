<?php
function MP_Modificar_FormVisteseda($MP_user , $user_email)
{//formulario de modificar amigos de $user_email
    ?>
    <h1>Modificación de Usuarios </h1>
    <form class="fom_usuario" action="?action=mis_datos&proceso=update&person_id=<?php print $_GET['person_id'] ?> " method="POST" enctype="multipart/form-data">
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
            <img id="img_foto" src="/Lab/P1/img/<?php print $MP_user['foto_file'] ?>" width="100" height="100"> 
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

$persona= $_GET['person_id'];
$query = "SELECT     * FROM       $table WHERE person_id =$persona"; 
$consult = $MP_pdo->prepare($query);
$a=$consult->execute(array());
if (1>$a){echo "Error en buscar person_id";}
$MP_user=$consult->fetchAll(PDO::FETCH_ASSOC);
//var_dump($MP_user[0]);
MP_Modificar_FormVisteseda($MP_user[0], $user_email);
?>