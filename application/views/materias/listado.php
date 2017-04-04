<?php
// Todo esto proviene del anterior desafio.
echo "<table class='w3-table-all w3-hoverable'> 
<tr class='w3-green'>
<th>Materia</th>
<th>Descripcion</th>
<th>Carga Horaria</th>
<th>Opciones</th>
</tr>";
foreach ($materias as $row)
{
    echo "<tr>";
    echo "<td>" . $row['nombre'] . "</td>";
    echo "<td>" . $row['descripcion'] . "</td>";
    echo "<td>" . $row['carga_horaria'] . "</td>";
    echo "<td>" . '<button type="submit" class="delete" id="'. $row['id'] . '"onClick="eliminar(this.id);"> Eliminar </button>';
    echo '<button type="submit" class="modify" id="'. $row['id'] . '" onClick="modificar(this.id);"> Modificar </button>';
    echo "</tr>";
}
?>