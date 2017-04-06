<html>
<head>
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>buttons.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>w3.css" type="text/css" media="all">
<script src="<?php echo JS_URL;?>jquery.redirect.js"></script>
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