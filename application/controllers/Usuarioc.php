<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();
class Usuarioc extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('usuarios_model', 'usuarios');
    }
    public function index(){ // ESTO ES LO PRIMERO DE LO PRIMERO QUE OCURRE CUANDO INGRESAMOS.
        $this->load->view('usuarios/login');
        
    }
    public function login(){
        $Usuario = $_POST['Usuario'];
        $Contra = md5($_POST['Contra']); // La base de datos maneja MD5.
        $_SESSION["usuario"] = $Usuario;     // Guardo el nombre del usuario ingresado en sesión.
        $_SESSION["password"] = $Contra;     // Guardo la contraseña del usuario ingresado en sesion.
        $this->usuarios->login($Usuario, $Contra);
    }
}

