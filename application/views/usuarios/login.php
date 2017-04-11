<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>buttons.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>w3.css" type="text/css" media="all">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
<script src="<?php echo JS_URL;?>jquery.redirect.js"></script>
<link rel="icon" type="image/x-icon" href="css/favicon.ico">
</head>
<style>
/* Full-width input fields */
input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

/* Set a style for all buttons */
button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}

button:hover {
    opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
    width: auto;
    padding: 10px 18px;
    background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
    text-align: center;
    margin: 24px 0 12px 0;
    position: relative;
}

img.avatar {
    width: 40%;
    border-radius: 50%;
}

.container {
    padding: 16px;
}

span.psw {
    float: right;
    padding-top: 16px;
}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
    padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
    background-color: #fefefe;
    margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
    border: 1px solid #888;
    width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
    position: absolute;
    right: 25px;
    top: 0;
    color: #000;
    font-size: 35px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: red;
    cursor: pointer;
}

/* Add Zoom Animation */
.animate {
    -webkit-animation: animatezoom 0.6s;
    animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
    from {-webkit-transform: scale(0)} 
    to {-webkit-transform: scale(1)}
}
    
@keyframes animatezoom {
    from {transform: scale(0)} 
    to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
    span.psw {
       display: block;
       float: none;
    }
    .cancelbtn {
       width: 100%;
    }
}
</style>
<body>

<center><h2>Ingreso al Sistema de Materias</h2></center>

<div id="id01" style="width:auto;">

      <label><b>Usuario</b></label>
      <input type="text" placeholder="Ingrese su usuario" id="uname" required>

      <label><b>Contraseña</b></label>
      <input type="password" placeholder="Ingrese su contraseña" id="psw" required>
        
      <button type="button" onclick="Ingresar()">Ingresar</button>
</div>
</body>
</html>
<script type="text/javascript">
function Ingresar(){
var Usuario = document.getElementById("uname").value;
var Contra = document.getElementById("psw").value;
if(Usuario == "" || Contra == ""){
    alert("Los campos de inicio de sesión no pueden estar vacios")
    return;
}
$.ajax({ // Llamada a Ajax mas ordenada que la de anteriores versiones.
        url: "<?php echo site_url()."/Usuarioc/login"; ?>",
        type: 'POST', //POST mas seguro que GET.
        data: {'Usuario': Usuario, 'Contra': Contra}, // Parametros.
        success: function(responseText) { // Una vez que la funcion terminó (asincronía).
        	if(!(responseText=="Administrador") && !(parseInt(responseText)>0)){
                alert("Usuario y/o contraseña no válidos, asegurese de estar activo");
            }
            if(responseText=="Administrador"){
                 $.redirect("<?php echo site_url()."/Cursadac/indexadmin"; ?>","POST");  
                 //$.redirect("<?php echo site_url()."/Materiac/index"; ?>","POST");   
            }
            if(parseInt(responseText)>0){ //Si no es administrador me importa su ID para realizar la busqueda de Cursadas.
                 $.redirect("<?php echo site_url()."/Cursadac/index"; ?>",{usuario_id: responseText}, "POST");    
            }
        },
    });
}
</script>