
<?php
// CONTROLADOR BlogController
class EjemplarController{

// operación por defecto
public function index(){

    $this->list(); // listado de Ejemplars
}

 // lista los Ejemplars
 public function list(){

    // solamente el administrador
    // if(!Login::isAdmin())
    //     throw new Exception('No tienes permiso para hacer esto');

    $ejemplares = Ejemplar::get();
    include 'views/ejemplar/listar.php';
}

// lista los Ejemplars
public function prueba(){
    // solamente el administrador
    //if(!Login::isAdmin())
    //    throw new Exception('No tienes permiso para hacer esto');
    //$Ejemplars = Ejemplar::get();
    include 'views/ejemplar/prueba.php';
}





// muestra el formulario de nueva Ejemplar
public function create(){
    if(!Login::isAdmin() || Login::hasPrivilege(300))
       throw new Exception('No tienes permiso para hacer esto');
    include '../views/ejemplar/nuevo.php';
}

// guarda el nuevo Ejemplar
public function store(){

    if(!Login::isAdmin() || Login::hasPrivilege(300))
       throw new Exception('No tienes permiso para hacer esto');

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['guardar']))
        throw new Exception('No se recibieron datos');

    $ejemplar = new Ejemplar(); //crear el nuevo Ejemplar

    $ejemplar->idlibro = $_POST['idlibro'];
    $ejemplar->anyo =$_POST['anyo'];
    $ejemplar->edicion =$_POST['edicion'];
    $ejemplar->precio = $_POST['precio'];


    if(!$ejemplar->guardar())
        throw new Exception("No se pudo guardar $ejemplar->id");

    $mensaje="Guardado del Ejemplar $ejemplar->id correcto.";
    include '../views/exito.php'; //mostrar éxito
}


//ACTUALIZAR SE HACE EN DOS PASOS

// muestra el formulario de edición de un Ejemplar
public function edit(int $id = 0){

    // esta operación solamente la puede hacer el administrador
    // o bien el Ejemplar propietario de los datos que se muestran
    if(!Login::isAdmin() || Login::hasPrivilege(300))
       throw new Exception('No tienes permiso para hacer esto');

    // recuperar el Ejemplar
    if(!$Ejemplar = Ejemplar::getById($id))
        throw new Exception("No se indicó la Ejemplar.");
    // mostrar el formulario de edición
    include "views/blog/actualizar.php";
}


// aplica los cambios de un Ejemplar
public function update(){

    // esta operación solamente la puede hacer el administrador
    // o bien el Ejemplar propietario de los datos que se muestran
    if(!Login::isAdmin() || Login::hasPrivilege(300))
    throw new Exception('No tienes permiso para hacer esto');

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['actualizar']))
        throw new Exception('No se recibieron datos');

    $id = intval($_POST['id']); // recuperar el id vía POST

    // recuperar la Ejemplar
    // recuperar el Ejemplar
    if(!$Ejemplar =Ejemplar::getById($id))
        throw new Exception("No existe la Ejemplar $id.");

    $Ejemplar->Ejemplar = DB::escape($_POST['Ejemplar']);
    $Ejemplar->title = DB::escape($_POST['title']);
    $Ejemplar->subtitle = DB::escape($_POST['subtitle']);
    $Ejemplar->meta_description = DB::escape($_POST['meta_description']);
    $Ejemplar->tags = DB::escape($_POST['tags']);
    $Ejemplar->imagen = DB::escape($_POST['imagen']);
    $Ejemplar->is_draft = empty($_POST['is_draft'])? 0 : 1;
    $Ejemplar->id_Ejemplar = intval($_POST['id_Ejemplar']);
    $Ejemplar->updated_at = date('Y-m-d h:i:s');

    // intenta realizar la actualización de datos
    if($Ejemplar->actualizar()===false)
        throw new Exception("No se pudo actualizar la Ejemplar: $Ejemplar->title");

    // prepara un mensaje
    $GLOBALS['mensaje'] = "Actualización de la Ejemplar: $Ejemplar->title correcta.";
    $mensaje = 'Actualización correcta';
    // repite la operación edit, así mantiene la vista de edición.
    //$this->edit($Ejemplar->id);
    include 'views/exito.php'; //mostrar éxito
}




// muestra el formulario de confirmación de eliminación
public function delete(int $id = 0){

     // esta operación solamente la puede hacer el administrador
    // o bien el Ejemplar propietario de los datos que se muestran
    if(!Login::isAdmin() || Login::hasPrivilege(300))
       throw new Exception('No tienes permiso para hacer esto');

    // recupera el Ejemplar para mostrar sus datos en la vista
    if(!$Ejemplar = Ejemplar::getById($id))
        throw new Exception("No existe el Ejemplar $id.");

    // carga la vista de confirmación de borrado
    include 'views/Ejemplar/borrar.php';
}

//elimina el Ejemplar
public function destroy(){

    if(!Login::isAdmin() || Login::hasPrivilege(300))
       throw new Exception('No tienes permiso para hacer esto');

    //recuperar el identificador vía POST
    $id = empty($_POST['id'])? 0 : intval($_POST['id']);

    // esta operación solamente la puede hacer el administrador
    // o bien el Ejemplar propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // borra el Ejemplar de la BDD
    if(!Ejemplar::borrar($id)){
        throw new Exception("No se pudo dar de baja el Ejemplar $id");

    // hace logout (solamente si es el mismo Ejemplar el que se está dando de baja)
    // y no cuando es el administrador el que da de baja un Ejemplar cualquiera
        // if(!Login::isAdmin() || Login::isAdmin() && Login::get()->id == $id){
        // (new LoginController())->logout();

    // si es el administrador el que da de baja un Ejemplar cualquiera, se muestra éxito
    }else{
        $mensaje = "El Ejemplar ha sido dado de baja correctamente.";
        include '../views/exito.php'; //mostrar éxito
    }
}
}