<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class materias_model extends CI_Model{ // Las funciones del modelo son bastantes claras, por eso no se explica mucho.
    function listar($carrera_id){
        $datos = $this->db->get_where('materias', array('carrera_id' => $carrera_id)); //Consulta CodeIgniter.
        return $datos->result_array(); //Retorno el resultado de la consulta como un result_array mas facil de manejar.
    }
    function getall(){ // Esta funcion se necesita en la opcion de agregar cursadas.
        $datos = $this->db->get('materias'); //Consulta CodeIgniter.
        return $datos->result_array();
    }
    function materia($materia_id){ // Esta funcion obtiene los datos de la materia en funcion de su id.
        $datos = $this->db->get_where('materias', array('id' => $materia_id));
        return $datos->result_array();
    }
    function add($carrera_id, $nombre, $descripcion, $carga_horaria){
        $datos = array(
   'carrera_id' => $carrera_id ,
   'nombre' => $nombre ,
   'descripcion' => $descripcion,
   'carga_horaria' => $carga_horaria,
);
        $this->db->insert('materias', $datos); 
    }
    function delete($id){
        $this->db->delete('materias', array('id' => $id));
    }
    function modify($id, $carrera_id, $nombre, $descripcion, $carga_horaria){
        $datos = array(
   'carrera_id' => $carrera_id ,
   'nombre' => $nombre ,
   'descripcion' => $descripcion,
   'carga_horaria' => $carga_horaria,
);
       $this->db->update('materias', $datos, array('id' => $id));
    }
}

?>