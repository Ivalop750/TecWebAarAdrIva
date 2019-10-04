<?php
include("./gestionBD.php");
function handler($pdo,$table)
{
    var_dump($_REQUEST);
    if (count($_REQUEST) < 7) {
        $data["error"] = "No has rellenado el formulario correctamente";
        return;
    }
    $query = "UPDATE $table SET nombre=?, apellidos=?, email=?, dni=?, clave=?, foto_file=? WHERE client_id=?";
    
    echo $query;
                       
    try { 
        
        $a=array($_REQUEST['userName'],$_REQUEST['apellidos'], $_REQUEST['email'],$_REQUEST['dni'],$_REQUEST['passwd'],$_REQUEST['foto_file'], $_REQUEST['client_id'] );
       
        $consult = $pdo->prepare($query);
        $a=$consult->execute(array($_REQUEST['userName'],$_REQUEST['apellidos'], $_REQUEST['email'],$_REQUEST['dni'],$_REQUEST['passwd'],$_REQUEST['foto_file'],$_REQUEST['client_id']));
        if (1>$a)echo "InCorrecto";
    
    } catch (PDOExeption $e) {
        echo ($e->getMessage());
    }
}
$table = "A_cliente";
echo("Información actualizada. <br></br>");
handler($pdo,$table);
?>