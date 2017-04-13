<html>
<head>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>buttons.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>w3.css" type="text/css" media="all">
<script src="<?php echo JS_URL;?>jquery.redirect.js"></script>
</head>
<body>
<table class='w3-table-all w3-hoverable'> 
<tr class='w3-green'>
<th>Materia</th>
<th>Nota</th>
<th>Fecha</th>
</tr>
<?php
$datos = ""; // Variable donde se guardaran los datos de la cursada.
foreach ($cursadas as $row)
{
    echo "<tr>";
    echo "<td>" . $row['nombre'] . "</td>";
    $datos .= $row['nombre'] . " ";
    echo "<td>" . $row['nota'] . "</td>";
    $datos .= $row['nota'] . " ";
    echo "<td>" . $row['fecha'] . "</td>";
    echo "</tr>";

}
// Exporto la variable de PHP a JS.
echo '<script languaje="JavaScript">
      var datos="'.$datos.'";
</script>';
echo '<script languaje="JavaScript">
      var usuario_id="'.$usuario_id.'";
</script>';
?>

</table>
<input type="text" name="mail" id="mail" placeholder="Ingrese su mail"><br>
<button type="button" onclick="EnviarMail()">Enviar Mail</button>
<br>
<input type="text" name="mensaje" id="mensaje" placeholder="Ingrese su mensaje"><br>
<button type="button" onclick="EnviarMensaje()">Enviar Mensaje</button>

</body>
</html>
<script>
function EnviarMail() {
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones. 
        url: "<?php echo site_url()."/Cursadac/EnviarMail"; ?>",
        type: 'POST', //POST mas seguro que GET.
        dataType: 'text',
        data: {'mail': ($("#mail").val()), 'datos': datos}, // Parametros.
        success: function() { // Una vez que la funcion terminó (asincronía).
            alert('Mail Enviado !');
        },
    });
}
function EnviarMensaje() {
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones. 
        url: "<?php echo site_url()."/Cursadac/EnviarMensajeAlumno"; ?>",
        type: 'POST', //POST mas seguro que GET.
        dataType: 'text',
        data: {'mensaje': ($("#mensaje").val()), 'usuario_id': usuario_id}, // Parametros.
        success: function() { // Una vez que la funcion terminó (asincronía).
            alert('Mensaje Enviado!');
        },
    });
}
</script>