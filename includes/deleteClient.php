<?php
include("./gestionBD.php");


try{
    $table="A_cliente";
    $a=consultar($pdo,$table);
    if (1>$a) {echo "InCorrecto1";return ;}
    var_dump($a);
    borrar($pdo,$table,$_REQUEST['client_id']);





} 
catch (PDOException $e) {
echo "Failed to get DB handle: " . $e->getMessage() . "\n";
exit;
}

?>