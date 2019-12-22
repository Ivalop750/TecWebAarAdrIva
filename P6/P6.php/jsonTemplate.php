<?php 
header('Content-Type:application/json').
include(dirname(__FILE__)."/../../../wp-config.php");
$pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD); 
echo "HE LLEGADO???";
$result= $pdo->prepare("SELECT * FROM A_GrupoCliente000");
$result->execute();
$datos= $result->fetchAll(PDO::FETCH_ASSOC);
$salida = array(plantilla=>"listarTemplate.html","datos"=>$datos);
$datos2 =json_parse($datos);
$salida ="{\"plantilla\":\"listarTemplate.html\",\"datos\":$datos2}";
echo "$salida";
?>