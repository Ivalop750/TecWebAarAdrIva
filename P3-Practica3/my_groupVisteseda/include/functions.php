<?php
include("./gestionBD.php");
/**
 * * Descripción: Controlador principal
 * *
 * * Descripción extensa: Iremos añadiendo cosas complejas en PHP.
 * *
 * * @author  Lola <dllido@uji.es> 
 * * @copyright 2018 Lola
 * * @license http://www.fsf.org/licensing/licenses/gpl.txt GPL 2 or later
 * * @version 2
 * */


//Estas 2 instrucciones me aseguran que el usuario accede a través del WP. Y no directamente
if ( ! defined( 'WPINC' ) ) exit;

if ( ! defined( 'ABSPATH' ) ) exit;




//Funcion instalación plugin. Crea tabla
function MP_CrearTVisteseda($tabla){
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    $query="CREATE TABLE IF NOT EXISTS $tabla (person_id INT(11) NOT NULL AUTO_INCREMENT, nombre VARCHAR(100),  email VARCHAR(100),  foto_file VARCHAR(25), clienteMail VARCHAR(100),  PRIMARY KEY(person_id))";
    $consult = $MP_pdo->prepare($query);
    $consult->execute (array());
}


function MP_Register_FormVisteseda($MP_user , $user_email)
{//formulario registro amigos de $user_email
    ?>
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
        <input type="text" name="userName" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["userName"] ?>"
        placeholder="Miguel Cervantes" />
        <br/>
        <label for="email">Email</label>
        <br/>
        <input type="text" name="email" class="item_requerid" size="20" maxlength="25" value="<?php print $MP_user["email"] ?>"
        placeholder="kiko@ic.es" />
        <br/>
        <label for="foto_file">Fotografía</label>
        <br/>
        <input type="file" name="foto_file" class="item_requerid" value="<?php print $MP_user["foto_file"] ?>"
        placeholder="nombre de la foto" />
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

//CONTROLADOR
//Esta función realizará distintas acciones en función del valor del parámetro
//$_REQUEST['proceso'], o sea se activara al llamar a url semejantes a 
//https://host/wp-admin/admin-post.php?action=my_datos&proceso=r 


function hook_css() {
   ?>
   	<style>
       	.wp_head_example {
           	background-color : #f1f1f1;
       	}
   	</style>
   <?php
}

function MP_mis_datos()
{
    
	add_action('wp_head', 'hook_css');

    global $user_ID , $user_email,$table;
    
    $MP_pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
    wp_get_current_user();
    if ('' == $user_ID) {
                //no user logged in
                exit;
    }
    
    
    
    if (!(isset($_REQUEST['action'])) or !(isset($_REQUEST['proceso']))) { print("Opciones no correctas $user_email"); exit;}

    get_header();
    echo '<div class="wrap">';

        
   
    switch ($_REQUEST['proceso']) {
        case "registro":
            $MP_user=null; //variable a rellenar cuando usamos modificar con este formulario
            MP_Register_FormVisteseda($MP_user,$user_email);
            break;
        case "registrar":
            if (count($_REQUEST) < 4) {
                print ("No has rellenado el formulario correctamente");
                return;
            }
            //guarda_foto($_REQUEST['foto_file']);
            $fotoURL="";
            $IMAGENES_USUARIOS = '/storage/ssd1/545/10899545/public_html/Lab/P1/img/';
            
            if(array_key_exists('foto_file', $_FILES) && $_POST['email']) {
                $fotoURL = $IMAGENES_USUARIOS.$_POST['userName']."_".$_FILES['foto_file']['name'];
                echo $fotoURL;
                if (move_uploaded_file($_FILES['foto_file']['tmp_name'], $fotoURL)) { 
                    echo "foto subida con éxito";
                }
            }
           
            $query = "INSERT INTO $table (nombre, email, foto_file, clienteMail) VALUES (?,?,?,?)";         
            $a=array($_REQUEST['userName'], $_REQUEST['email'], $_POST['userName']."_".$_FILES['foto_file']['name'], $_REQUEST['clienteMail'] );
            //var_dump($_FILES);
            //$pdo1 = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            if (1>$a) {echo "InCorrecto $query";}
            else wp_redirect(admin_url( 'admin-post.php?action=mis_datos&proceso=listar'));
            break;
        case "listar":
            //Listado amigos o de todos si se es administrador.
            
            $a=array();
            if (current_user_can('administrator')) {$query = "SELECT     * FROM       $table ";}
            else {$campo="clienteMail";
                $query = "SELECT     * FROM  $table      WHERE $campo =?";
                $a=array( $user_email);
 
            } 

            $consult = $MP_pdo->prepare($query);
            $a=$consult->execute($a);
            $rows=$consult->fetchAll(PDO::FETCH_ASSOC);
            if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
                print '<div><table><th>';
                foreach ( array_keys($rows[0])as $key) {
                    echo "<td>", $key,"</td>";
                }
                print "</th>";
                foreach ($rows as $row) {
                    print "<tr>";
                    foreach ($row as $key => $val) {
                        if ($key=="foto_file" and $val!=null){
                            echo "<td> <img src='/Lab/P1/img/$val'>", "</td>";
                        }
                        else{
                        echo "<td>", $val, "</td>";
                        }
                    }
                    print "</tr>";
                }
                print "</table></div>";
            }
            else{echo "No existen valores";}
            echo "<br/>";
            echo "<table>";
            echo "<td align='center'> <a class='botones menu-principal-container' href='admin-post.php?action=mis_datos&proceso=registro'>Registro</a> </td>";
            echo "<td align='center'> <a class='botones menu-principal-container' href='admin-post.php?action=mis_datos&proceso=listar'>Listar</a> </td>";
            echo "</table>";
            break;
        default:
            print "Opción no correcta";
        
    }
    echo "</div>";
    // get_footer ademas del pie de página carga el toolbar de administración de wordpres si es un 
    //usuario autentificado, por ello voy a borrar la acción cuando no es un administrador para que no aparezca.
    if (!current_user_can('administrator')) {

        // for the admin page
        remove_action('admin_footer', 'wp_admin_bar_render', 1000);
        // for the front-end
        remove_action('wp_footer', 'wp_admin_bar_render', 1000);
    }

    get_footer();
    }
//add_action('admin_post_nopriv_my_datos', 'my_datos');
//add_action('admin_post_my_datos', 'my_datos'); //no autentificados
?>
