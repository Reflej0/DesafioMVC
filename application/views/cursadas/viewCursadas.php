<html>
<head>
<link rel="stylesheet" href="https://www.dropbox.com/s/tkh34n4e5wb86fh/buttons.css?dl=1" type="text/css" media="all">
<link rel="stylesheet" href="https://www.dropbox.com/s/epz46flzm8sejg7/w3.css?dl=1" type="text/css" media="all">
</head>
</html>
<?php
// Todo esto proviene del anterior desafio.
echo "<table class='w3-table-all w3-hoverable'> 
<tr class='w3-green'>
<th>Materia</th>
<th>Nota</th>
<th>Fecha</th>
</tr>";

foreach ($cursadas as $row)
{
    echo "<tr>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['nota'] . "</td>";
    echo "<td>" . $row['fecha'] . "</td>";
    echo "</tr>";

}
?>