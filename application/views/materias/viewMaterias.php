<?php 
?>

<html>   
    <head>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <script src="<?php echo JS_URL;?>jquery.redirect.js"></script>
<script>
var decision; // Decision corresponde a la opcion del listbox seleccionada.
function showMaterias(ID_Carrera) { // Esta es la funcion principal que muestra las materias a medida que el listbox cambia de opcion.  
decision=carreras.value;
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones. 
        url: "<?php echo site_url()."/Materiac/listar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        dataType: 'text',
        data: {'ID_Carrera': ID_Carrera}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
        },
    });
}
function goCursadas(){
$.redirect("<?php echo site_url()."/Cursadac/indexadmin"; ?>","POST");
}
</script>
    </head>
     <body>
          <button type="submit" class="w3-button w3-hover-purple" id="goCursadas" onClick="goCursadas();">Ir a Cursadas</button>
        <form>
            <div class="form-group">
                <!-- Seleccionador de carrera para mostrar información de acuerdo a la opción elegida -->
                <label for="carreras" id="txtCarreras">Selecciona una carrera:</label>
                <select name="carreras" id="carreras" class="form-control" onchange="showMaterias(this.value);">
                    <option class="carrera" value="" hidden></option>
                    <option class="carrera" value="1">Arquitectura</option>
                    <option class="carrera" value="2">Ingenieria Mecanica</option>
                    <option class="carrera" value="3">Ingenieria Informatica</option>
                    <option class="carrera" value="4">Ingenieria Electronica</option>
                    <option class="carrera" value="5">Ingenieria Industrial</option>
                    <option class="carrera" value="6">Ingenieria Civil</option>
                    <option class="carrera" value="7">Desarrollo Web</option>
                    <option class="carrera" value="8">Sonido y Grabacion</option>
                </select>
            </div>
        </form>

        <!-- Botón para agregar materias -->
        <button type="submit" id="agregar" class="w3-button w3-hover-blue" onClick="agregar();">Agregar Materia</button>
        
        <!-- Tabla que se modifica con la interacción -->
        <div id="txtHint" class="table-responsive"></div>

    </body>
</html> 

<script>
    function agregar(){ // Se pasa a la pagina donde se agregan las materias. 
        $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Materiac/agregar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
        },
    });
}

function agregarmateria(i, n, d, c){ // Se recopilan los datos de la pagina anterior y se mandan a la consulta de SQL.
/*
i = id_carrera
n = nombre(materia)
d = descripcion;
c = carga_horaria;
*/
if(n == ""){ // Validación antes de UPDATE en SQL.
    alert("El nombre de la materia no puede estar vacío")
    return;
}
else{
    $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Materiac/agregar2"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'i': i, 'n': n, 'd': d, 'c': c}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            document.getElementById("carreras").value = i; // Para que cuando agregue la materia a la carrera, me lleve a ver las demas materias de la carrera.
            showMaterias(i); // El i, esta haciendo referencia a la id de carrera de la materia anterior.
        },
    });
}
}

function eliminar(ID_Materia) { // Esta funcion elimina la materia seleccionada.
var confirmacion=confirm("¿Realmente desea eliminarlo? "); //Msgbox para confirmar la acción.
if (confirmacion){
        $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Materiac/eliminar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'ID_Materia': ID_Materia}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            showMaterias(decision); // Esto es para que cuando se termine de actualizar vuelva la tabla.
        },
    });
}
}
function modificar(ID_Materia){ //Esta es la primera parte de la funcion modificar, exhibe por pantalla la materia a modificar y permite modificar.

$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Materiac/modificar"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'ID_Materia': ID_Materia}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            document.getElementById("id_Carrera").value = decision; // Al modificar le recuerdo al usuario cual era la carrera de la materia.
        },
    });
    }
function aceptar(id, i, n, d, c){ // Esta funcion recibe los datos de la anterior y manda la consulta con los datos actualizados.
/*
id = id_materia
i = id_carrera
n = nombre(materia)
d = descripcion;
c = carga_horaria;
*/
if(n == ""){ // Validación antes de UPDATE en SQL.
    alert("El nombre de la materia no pueden estar vacíos")
    return;
}
else{
    $.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Materiac/modificar2"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'id': id, 'i': i, 'n': n, 'd': d, 'c': c}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
            document.getElementById("txtHint").innerHTML = responseText; // Lo que devuelve la función se plasma en el inner.
            document.getElementById("carreras").value = i; // Al modificar le recuerdo al usuario cual era la carrera de la materia.
            showMaterias(i); // Esto es para que cuando se termine de actualizar vuelva la tabla.
        },
    });
}

    }
function validarLetras(event){ // La validación funciona en IE, Firefox, Chrome y además permite acentos, diéresis y enie.
        // valido que sea solo letra lo que ingresa
        if(event.charCode == 0){ // Firefox Backspace charcode 0.
            return;
        }
        if (event.charCode > 32 && (event.charCode < 64 || event.charCode > 90) && (event.charCode < 97 || event.charCode > 122 ) && (event.charCode <= 192 || event.charCode >= 255)){
            return false;
        }
    }
    </script>