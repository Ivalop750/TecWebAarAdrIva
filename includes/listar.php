<?php
include("./gestionBD.php");
function handler($pdo,$table)
{
    
    $rows=consultar($pdo,$table);
   
    if (is_array($rows)) {/* Creamos un listado como una tabla HTML*/
        print '<table><thead>';
        foreach ( array_keys($rows[0])as $key) {
            echo "<th>", $key,"</th>";
        }
        print "</thead>";
        foreach ($rows as $row) {
            print "<tr>";
            foreach ($row as $key => $val) {
                echo "<td>", $val, "</td>";
            }
            echo "<td>", "<a href='?action=update'>Modificar</a>", "</td>";
            echo "<td>", "<a href='?action=delete'>Borrar</a>", "</td>";
            print "</tr>";
        }
        print "</table>";
    }
}
$table = "A_cliente";

try{handler($pdo,$table);}
catch (PDOException $e) {
echo "Failed to get DB handle: " . $e->getMessage() . "\n";
exit;
}

    ?>