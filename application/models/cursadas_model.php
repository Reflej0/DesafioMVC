<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class cursadas_model extends CI_Model{ // Las funciones del modelo son bastantes claras, por eso no se explica mucho.
function getcursadas($usuario_id){ //Este metodo obtiene las cursadas de un determinado alumno activo.
    //Tecnica Query Binding.
    $sql = "SELECT M.nombre, C.nota, C.fecha, C.id FROM cursadas C LEFT JOIN  materias M ON C.materia_id = M.id WHERE C.usuario_id = ?";
    $datos = $this->db->query($sql, array($usuario_id));
    return $datos->result_array();
}
function add($ID_Usuario, $ID_Materia, $Nota){
        $datos = array(
   'usuario_id' => $ID_Usuario ,
   'materia_id' => $ID_Materia ,
   'nota' => $Nota,
);
        $this->db->insert('cursadas', $datos); 
    }
function delete($id){
     $this->db->delete('cursadas', array('id' => $id));
}
function cursada($cursada_id){
    //Tecnica Query Binding.
        $sql = "SELECT M.nombre, C.nota, C.fecha, C.id FROM cursadas C LEFT JOIN  materias M ON C.materia_id = M.id WHERE C.id = ?";
        $datos = $this->db->query($sql, array($cursada_id));
        return $datos->result_array();
    }
function modify($id, $nota){
        $datos = array(
   'nota' => $nota
);
       $this->db->update('cursadas', $datos, array('id' => $id));
    }
}
