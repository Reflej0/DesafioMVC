<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();     // Con esto habilito el archivo "Cursadac.php" para acceder a variables de sesión
if (!($_SERVER['REQUEST_METHOD'] === 'POST')) { //Validación para que no puedan acceder al archivo .php de una. Funciona en Chrome.
    header('Location: http://localhost/desafioMVC', FALSE);
    die();
    
}
else{ // Si paso la primera validacion del POST, ahora le toca pasar la validacion de usuarios.
    if (!isset($_SESSION["usuario"]) && !isset($_SESSION["password"]) && $_SESSION["administrador"]!=1) {
    header('Location: http://localhost/desafioMVC', FALSE);
    die();
}
}
class Cursadac extends CI_Controller{
    function __construct() {
        parent::__construct();
        $this->load->model('cursadas_model', 'cursadas');
        $this->load->model('usuarios_model', 'usuarios'); //Tambien requiero a usuarios.
        $this->load->model('materias_model', 'materias'); //Tambien requiero a materias.
    }
    
    public function index(){ // El index esta disponible para los Usuarios(Alumnos) que desean ver el historial de sus materias.
    $Usuario= $_POST['usuario_id']; //Obtengo los parametros de la llamada a traves Ajax.
    $cursadas=$this->cursadas->getcursadas($Usuario); // Invoco a la funcion listar del modelo y almaceno el resultado en la variable materias.
    $data['cursadas']=$cursadas; // Defino que argumentos voy a pasar a la vista.
    $this->load->view('cursadas/viewCursadas.php', $data); // Voy a la vista.s
    }
    public function indexadmin(){ // Cuando un administrador accede al ABM de cursadas.
    $usuarios= $this->usuarios->getalumnos(); // Obtengo todos los alumnos activos.
    $data['usuarios'] = $usuarios; // Los preparo para llevar a la vista.
    $this->load->view('cursadas/viewCursadasAdmin', $data); // Voy a la vista y le paso los alumnos.
    
    }
    public function getCursadasUsuario(){ // Esta funcion es llamada desde la vista, donde el usuario ya esta validado de que esta activo.
    $Usuario= $_POST['Usuario']; //Obtengo los parametros de la llamada a traves Ajax.
    $cursadas=$this->cursadas->getcursadas($Usuario); // Invoco a la funcion listar del modelo y almaceno el resultado en la variable materias.
    $data['cursadas']=$cursadas; // Defino que argumentos voy a pasar a la vista.
    $this->load->view('cursadas/listadoadmin.php', $data); // Voy a la vista.s
    }
    public function eliminar(){ // Esta funcion elimina la cursada.
        $ID_Cursada = $_POST['ID_Cursada']; // El parametro que viene de la vista.
        $this->cursadas->delete($ID_Cursada); // Invoco a la funcion eliminar del modelo y no devuelve nada obviamente, solo lo elimina.
    }
    public function modificar(){ // Funcion que modifica las cursadas, paso1.
       $ID_Cursada = $_POST['ID_Cursada']; // El parametro que viene de la vista.
       $Alumno = $_POST['Alumno'];
       $cursadas=$this->cursadas->cursada($ID_Cursada); // Invoco a la funcion cursada que me devuelve los datos de la cursada, esto sirve para que la viste donde modifico la cursada tenga los datos.
       $data['cursadas']=$cursadas;  // Defino que argumentos voy a pasar a la vista.
       $data['alumno']=$Alumno;
       $this->load->view('cursadas/modifyCursadas.php', $data); //Voy a la vista donde se editan los parametros de la cursadas.
   }
   public function modificar2(){ // Funcion que modifica las cursadas, paso2.
       $ID_Cursada = $_POST['id'];
       $nota = $_POST['n'];
       $this->cursadas->modify($ID_Cursada, $nota); // Invoco a la funcion modify del modelo que realiza la accion y no devuelve nada obvio.
   }
    public function agregar(){ // Funcion que presenta el view para agregar las cursadas.
        $usuarios= $this->usuarios->getalumnos();
        $materias= $this->materias->getall();
        $data['materias'] = $materias;
        $data['usuarios'] = $usuarios;
        $this->load->view('cursadas/addCursada', $data);
    }
    public function agregar2(){ // Funcion que presenta el view para agregar las cursadas.
        $ID_Usuario = $_POST['i'];
        $ID_Materia = $_POST['m'];
        $nota = $_POST['n'];
        $this->cursadas->add($ID_Usuario, $ID_Materia, $nota); // Invoco a la funcion add del modelo que realiza la accion y no devuelve nada obvio.
    }
    public function EnviarMail(){ // La gran parte del controlador deberia estar en el modelo.
        $mail = $_POST['mail'];
        $datos = $_POST['datos'];
        $this->cursadas->enviarmail($mail, $datos);
    }
}