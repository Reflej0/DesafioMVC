<?php

echo "<table class='w3-table-all'>
<tr class='w3-blue'>
<th>Usuario</th>
<th>Materia</th>
<th>Nota</th>
<th>Fecha</th>
<th>Opciones</th>
</tr>";
foreach ($cursadas as $row){
echo "<tr>";
    echo "<td>" . $alumno;
    echo "<td>" . $row['nombre'];
    echo "<td>" . '<input type="text" class="form-control" id="nota" name="nota" placeholder="'. $row['nota'] . '" onKeyPress="return validarNumeros(event);" onpaste="return false"/>';
    echo "<td>" . $row['fecha'];
    echo "<td>" . '<button type="submit" id="'. $row['id'] . '" onClick="aceptar(this.id, nota.value);"> Aceptar </button>';
    echo "</tr>";
}