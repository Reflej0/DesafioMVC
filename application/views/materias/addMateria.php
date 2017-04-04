<html>
<head>
</head>
<body>
<table class='w3-table-all'>
<tr class='w3-yellow'>
<th>Carrera</th>
<th>Materia</th>
<th>Descripcion</th>
<th>Carga Horaria</th>
<th></th>
</tr>
<td><select name="id_Carrera" class="letter" id="id_Carrera"/>
<option value="1">Arquitectura</option>
<option value="2">Ingenieria Mecanica</option>
<option value="3">Ingenieria Informatica</option>
<option value="4">Ingenieria Electronica</option>
<option value="5">Ingenieria Industrial</option>
<option value="6">Ingenieria Civil</option>
<option value="7">Desarrollo Web</option>
<option value="8">Sonido y Grabacion</option>
<td><input type="text" class="form-control" id="nombre" name="nombre" onKeyPress="return validarLetras(event);"/>
<td><input type="text" class="form-control" id="descripcion" name="descripcion" onKeyPress="return validarLetras(event);"/>
<td><select name="carga_horaria" id="carga_horaria"/>
<option value="2">2</option>
<option value="4">4</option>
<option value="6">6</option>
<option value="8">8</option>
<option value="10">10</option>
<td><button type="submit" class="modify" id="agregar_mate" onClick="agregarmateria(id_Carrera.value, nombre.value,descripcion.value, carga_horaria.value);"> Agregar </button> 
</body>
</html>
