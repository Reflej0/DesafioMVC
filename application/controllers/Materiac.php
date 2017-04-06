<html>
<head>
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>buttons.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo LAYOUT_URL;?>w3.css" type="text/css" media="all">
</head>
</html>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
session_start();     // Con esto habilito el archivo "Materiac.php" para acceder a variables de sesión
if (!($_SERVER['REQUEST_METHOD'] === 'POST')) { //Validación para que no puedan acceder al archivo .php de una. Funciona en Chrome.
    header('Location: http://localhost/desafioMVC', FALSE);
    die();
    
}
else{ // Si paso la primera validacion del POST, ahora le toca pasar la validacion de usuarios.
    if (!isset($_SESSION["usuario"]) && !isset($_SESSION["password"]) && $_SESSION["administrador"]!=0) {
    header('Location: http://localhost/desafioMVC', FALSE);
    die();
}
}
class Materiac extends CI_Controller{ //Las funciones de esta clase solo estan disponibles para los administradores.
    function __construct() {
        parent::__construct();
        $this->load->model('materias_model', 'materias');
    }
    
    public function index(){ // La funcion principal.
        $this->load->view('materias/viewMaterias');
    }
    
    public function agregar(){ // Funcion que presenta el view para agregar las materias.
        $this->load->view('materias/addMateria');
    }
    public function agregar2(){ // Funcion que presenta el view para agregar las materias.
        $ID_Carrera = $_POST['i'];
        $nombre = $_POST['n'];
        $descripcion = $_POST['d'];
        $carga_horaria = $_POST['c']; // Recibo todos los parametros.
        $this->materias->add($ID_Carrera, $nombre, $descripcion, $carga_horaria); // Invoco a la funcion add del modelo que realiza la accion y no devuelve nada obvio.
    }
    
    public function listar() { // Funcion que lista las materias.
         $carrera_id = $_POST['ID_Carrera']; // El parametro que viene de la vista.
         $materias=$this->materias->listar($carrera_id); // Invoco a la funcion listar del modelo y almaceno el resultado en la variable materias.
         $data['materias']=$materias; // Defino que argumentos voy a pasar a la vista.
         $this->load->view('materias/listado.php', $data); // Voy a la vista.s
    }
   public function eliminar(){ // Funcion que elimina las materias.
        $ID_Materia = $_POST['ID_Materia']; // El parametro que viene de la vista.
        $this->materias->delete($ID_Materia); // Invoco a la funcion eliminar del modelo y no devuelve nada obviamente, solo lo elimina.
   }
   public function modificar(){ // Funcion que modifica las materias.
       $ID_Materia = $_POST['ID_Materia']; // El parametro que viene de la vista.
       $materias=$this->materias->materia($ID_Materia); // Invoco a la funcion materia que me devuelve los datos de la materia, esto sirve para que la viste donde modifico la materia tenga los datos.
       $data['materias']=$materias;  // Defino que argumentos voy a pasar a la vista.
       $this->load->view('materias/modifyMateria.php', $data); //Voy a la vista donde se editan los parametros de la materia.
   }
   public function modificar2(){ // Funcion que modifica las materias.
       $ID_Materia = $_POST['id'];
       $ID_Carrera = $_POST['i'];
       $nombre = $_POST['n'];
       $descripcion = $_POST['d'];
       $carga_horaria = $_POST['c']; // Recibo todos los parametros.
       $this->materias->modify($ID_Materia, $ID_Carrera, $nombre, $descripcion, $carga_horaria); // Invoco a la funcion modify del modelo que realiza la accion y no devuelve nada obvio.
   }
    
    

}
