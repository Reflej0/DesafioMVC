<html>
<head>
</head>
<body>
<table class='w3-table-all'>
<tr class='w3-yellow'>
<th>Usuario</th>
<th>Materia</th>
<th>Nota</th>
<th>Opciones</th>
</tr>
<td><select name="id_Usuario" class="letter" id="id_Usuario"/>
<option class="carrera" value="" hidden></option>
<?php 
foreach($usuarios as $row){
    echo "<option class='usuarios' value=" . $row['id'] . "'>" . $row['usuario'] . "</option>" ;
}
?>
</select>
    
<td><select name="id_Materia" class="letter" id="id_Materia"/>
<option class="usuario" value="" hidden></option>
<?php 
foreach($materias as $row){
    echo "<option class='usuarios' value=" . $row['id'] . "'>" . $row['nombre'] . "</option>" ;
}
?>
</select>
<td><input type="text" class="form-control" id="nota" name="nota" onKeyPress="return validarNumeros(event);"/>
<td><button type="submit" class="modify" id="agregar_mate" onClick="agregarcursada(id_Usuario.value,id_Materia.value,nota.value);"> Agregar </button> 
</body>
</html>
