<?php

echo "<table class='w3-table-all'>
<tr class='w3-blue'>
<th>Carrera</th>
<th>Materia</th>
<th>Descripcion</th>
<th>Carga Horaria</th>
<th>Opciones</th>
</tr>";
foreach ($materias as $row){
echo "<tr>";
    echo "<td>" . '<select name="id_Carrera" class="letter" id="id_Carrera"/>';
    echo        '<option value="1">Arquitectura</option>
                <option value="2">Ingenieria Mecanica</option>
                <option value="3">Ingenieria Informatica</option>
                <option value="4">Ingenieria Electronica</option>
                <option value="5">Ingenieria Industrial</option>
                <option value="6">Ingenieria Civil</option>
                <option value="7">Desarrollo Web</option>
                <option value="8">Sonido y Grabacion</option>';
    echo "<td>" . '<input type="text" class="form-control" id="nombre" name="nombre" placeholder="'. $row['nombre'] . '" onKeyPress="return validarLetras(event);"/>';
    echo "<td>" . '<input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="'. $row['descripcion'] . '" onKeyPress="return validarLetras(event);"/>';
    echo "<td>" . '<select name="carga_horaria" class="form-control" id="carga_horaria" name="carga_horaria"/>';
    echo    '<option value="2">2</option>
        <option value="4">4</option>
        <option value="6">6</option>
        <option value="8">8</option>
        <option value="10">10</option>';
    echo "<td>" . '<button type="submit" id="'. $row['id'] . '" onClick="aceptar(this.id, id_Carrera.value, nombre.value,descripcion.value, carga_horaria.value);"> Aceptar </button>';
    
    echo "</tr>";
}