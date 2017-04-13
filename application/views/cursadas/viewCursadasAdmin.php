<html>   
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="<?php echo LAYOUT_URL;?>buttons.css" type="text/css" media="all">
        <link rel="stylesheet" href="<?php echo LAYOUT_URL;?>w3.css" type="text/css" media="all">
        <script src="<?php echo JS_URL;?>jquery.redirect.js"></script>
<script>
var decision; // Decision corresponde a la opcion del listbox seleccionada.
function showUsuarios() { // Esta es la funcion principal que muestra las materias a medida que el listbox cambia de opcion. 
decision=usuarios.value;
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones. 
        url: "<?php echo site_url()."/Cursadac/getCursadasUsuario"; ?>",
        type: 'POST', //POST mas seguro que GET.
        dataType: 'text',
        data: {'Usuario': ($("#usuarios").val())}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
        },
    });
}
function goMaterias(){
$.redirect("<?php echo site_url()."/Materiac/index"; ?>","POST");
}
</script>
    </head>
    <body>
          <button type="submit" class="w3-button w3-hover-purple" id="goMaterias" onClick="goMaterias();">Ir a Materias</button>
        <form>
            <div class="form-group">
                <!-- Seleccionador de alumnos para mostrar información de acuerdo a la opción elegida -->
                <label for="usuarios" id="txtUsuarios">Selecciona un Alumno:</label>
                <select name="usuarios" id="usuarios" class="form-control" onchange="showUsuarios(this.value);">
                    <option class="carrera" value="" hidden></option>
                    <?php 
                    foreach($usuarios as $row){
                        echo "<option class='usuarios' value=" . $row['id'] . "'>" . $row['usuario'] . "</option>" ;
                    }
                    ?>
                </select>
            </div>
        </form>

        <!-- Botón para agregar materias -->
        <button type="submit" id="agregar" class="w3-button w3-hover-blue" onClick="agregar();">Agregar Cursada</button>
        
        <!-- Tabla que se modifica con la interacción -->
        <div id="txtHint" class="table-responsive"></div>

    </body>
</html> 

<script>
    
function agregar(){ // Se pasa a la pagina donde se agregan las cursadas.
        $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Cursadac/agregar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
        },
    });
}

function agregarcursada(i, m, n){ // Se recopilan los datos de la pagina anterior y se mandan a la consulta de SQL.
/*
i = id_usuario
m = id_materia
n = nota
*/
if(n>10 || n<=0){
    alert("Valor de nota no aceptado")
    return;
}
if(i == "" || m == "" || n == "" ){ // Validación antes de UPDATE en SQL.
    alert("No pueden existir campos en blancos.")
    return;
}
else{
    $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Cursadac/agregar2"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'i': i, 'm': m, 'n': n}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            document.getElementById("usuarios").value = i; // Para que cuando agregue la cursada, me lleve a ver las demas cursadas del usuario.
            showUsuarios(i); // El i, esta haciendo referencia al id de usuario agregado.
        },
    });
}
}

function eliminar(ID_Cursada) { // Esta funcion elimina la cursada seleccionada.
var confirmacion=confirm("¿Realmente desea eliminarlo? "); //Msgbox para confirmar la acción.
if (confirmacion){
        $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Cursadac/eliminar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'ID_Cursada': ID_Cursada}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            showUsuarios(decision); // Esto es para que cuando se termine de actualizar vuelva la tabla.
        },
    });
}
}

function modificar(ID_Cursada){ //Esta es la primera parte de la funcion modificar, exhibe por pantalla la cursada a modificar y permite modificar.
var valorlistboxusuarios = document.getElementById("usuarios"); //Esto lo necesito para no hacer otro JOIN mas adelante.
var Alumno = valorlistboxusuarios.options[valorlistboxusuarios.selectedIndex].text; //Esto lo necesito para no hacer otro JOIN mas adelante.
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Cursadac/modificar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'ID_Cursada': ID_Cursada, 'Alumno': Alumno }, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
        },
    });
    }
    
function aceptar(id, n){ // Esta funcion recibe los datos de la anterior y manda la consulta con los datos actualizados.
/*
id = id_cursada
n = nota
*/
if(n>10 || n<=0){
    alert("Valor de nota no aceptado")
    return;
}
if(n == ""){ // Validación antes de UPDATE en SQL.
    alert("La nota de la cursada no puede estar vacia")
    return;
}
else{
    $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Cursadac/modificar2"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'id': id, 'n': n}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            document.getElementById("usuarios").value = decision; // Al modificar le recuerdo al usuario cual era la carrera de la materia.
            showUsuarios(decision); // Esto es para que cuando se termine de actualizar vuelva la tabla.
        },
    });
}

    }

function validarNumeros(event){ // La validación funciona en IE, Firefox, Chrome y además permite acentos, diéresis y enie.
        // valido que sea solo letra lo que ingresa
        if(event.charCode == 0){ // Firefox Backspace charcode 0.
            return;
        }
        if (event.charCode > 57 || event.charCode < 48){
            return false;
        }
    }
</script>

<?php //Con esta funcion imprimo los mensajes de los usuarios.
foreach($mensajes as $row){
    echo '<script languaje="JavaScript">
      alert("Alumno:'.$row['usuario'].'\nMensaje:'.$row['contenido'].'");
</script>';
}
?>