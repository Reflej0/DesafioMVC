<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class usuarios_model extends CI_Model{ // Las funciones del modelo son bastantes claras, por eso no se explica mucho.
    
    function login($Usuario, $Contra){ // La funcion utilizada para comprobar si todos los parametros del usuario son correctos para logear.
        //Tecnica Query Binding.
        $sql = "SELECT * FROM usuarios WHERE usuario = ?"; // Armo la llamada.
        $datos = $this->db->query($sql, array($Usuario)); //La ejecuto.
        foreach($datos->result_array() as $row){
            if($row['usuario'] == $Usuario && $row['contrasena'] == $Contra && $row['tipo']==0 && $row['estado']==1){ //Criterio para determinar el acceso a los administradores.
	echo "Administrador";
	$_SESSION["administrador"] = $row['tipo'];
}
            if($row['usuario'] == $Usuario && $row['contrasena'] == $Contra && $row['tipo']==1 && $row['estado']==1){ //Criterio para determinar el acceso a los usuarios.
	echo $row['id']; // Si es invitado recibo su ID para tratarla despues, esto me simplifica un par de cosas despues.
	$_SESSION["administrador"] = $row['tipo'];
}
        }
    }
/* Se puede observar la validacion, solo deja entrar a los que tengan correcta su combinacion de usuario y contrasena
y ademas chequea que tipo de usuario son (Administrador o no) y si estan activos.
 */
/*
UPDATE usuarios SET contrasena = MD5(contrasena) Esto es si agrego registros manualmente a la base de datos.
*/
    function getalumnos(){ // Esta funcion me devuelve los alumnos activos. Se invoca generalmente desde el controlador de cursadas, pero como la funcion es relacionada a usuarios pertenece a este modelo.
        $datos = $this->db->query("SELECT id, usuario from usuarios where tipo = 1 and estado = 1");
        return $datos->result_array();
    }
}