
<?php
// CONTROLADOR BlogController
class LibroController{

// operación por defecto
public function index(){

    $this->list(); // listado de libros
}

 // lista los libros
 public function list(){

    // solamente el administrador
    // if(!Login::isAdmin())
    //     throw new Exception('No tienes permiso para hacer esto');
    
    $libros = Libro::get();
    include '../views/libro/listar.php';
}

// lista los libros
public function prueba(){
    // solamente el administrador
    //if(!Login::isAdmin())
    //    throw new Exception('No tienes permiso para hacer esto');
    //$libros = Libro::get();
    
    include '../views/libro/prueba.php';
}



// muestra un libro
public function show(int $id = 0){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    //if(! (Login::isAdmin() || Login::get()->id == $id))
    //    throw new Exception('No tienes los permisos necesarios.');
    if(!$id)
    throw new Exception("No se pudo indicó el id.");
    // recuperar el libro

    $libro = Libro::getById($id);

    if(!$libro)
       throw new Exception("No se pudo recuperar el libro.");

    $ejemplares = $libro->hasMany('Ejemplar');

    // $temas = $libro->getTemas();
    $temas = $libro->manyToMany('tema');

    include '../views/libro/detalles.php';
}

// muestra el formulario de nueva libro
public function create(){
    include 'views/libro/nuevo.php';
}

// guarda el nuevo libro
public function store(){

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['guardar']))
        throw new Exception('No se recibieron datos');

    $libro = new libro(); //crear el nuevo libro

    $libro->libro = DB::escape($_POST['libro']);
    $libro->clave = md5($_POST['clave']); // encriptar la clave
    $libro->nombre = DB::escape($_POST['nombre']);
    $libro->apellido1 = DB::escape($_POST['apellido1']);
    $libro->apellido2 = DB::escape($_POST['apellido2']);
    $libro->privilegio = empty($_POST['privilegio'])? 0 : intval($_POST['privilegio']);
    $libro->administrador = empty($_POST['administrador'])? 0 : 1;
    $libro->email = DB::escape($_POST['email']);

    if(!$libro->guardar())
        throw new Exception("No se pudo guardar $libro->libro");

    $mensaje="Guardado del libro $libro->libro correcto.";
    include 'views/exito.php'; //mostrar éxito
}


//ACTUALIZAR SE HACE EN DOS PASOS

// muestra el formulario de edición de un libro
public function edit(int $id = 0){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // recuperar el libro
    if(!$libro = Libro::getById($id))
        throw new Exception("No se indicó la libro.");
    // mostrar el formulario de edición
    include "views/blog/actualizar.php";
}


// aplica los cambios de un libro
public function update(){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['actualizar']))
        throw new Exception('No se recibieron datos');

    $id = intval($_POST['id']); // recuperar el id vía POST

    // recuperar la libro
    // recuperar el libro
    if(!$libro =Libro::getById($id))
        throw new Exception("No existe la libro $id.");

    $libro->libro = DB::escape($_POST['libro']);
    $libro->title = DB::escape($_POST['title']);
    $libro->subtitle = DB::escape($_POST['subtitle']);
    $libro->meta_description = DB::escape($_POST['meta_description']);
    $libro->tags = DB::escape($_POST['tags']);
    $libro->imagen = DB::escape($_POST['imagen']);
    $libro->is_draft = empty($_POST['is_draft'])? 0 : 1;
    $libro->id_libro = intval($_POST['id_libro']);
    $libro->updated_at = date('Y-m-d h:i:s');

    // intenta realizar la actualización de datos
    if($libro->actualizar()===false)
        throw new Exception("No se pudo actualizar la libro: $libro->title");

    // prepara un mensaje
    $GLOBALS['mensaje'] = "Actualización de la libro: $libro->title correcta.";
    $mensaje = 'Actualización correcta';
    // repite la operación edit, así mantiene la vista de edición.
    //$this->edit($libro->id);
    include 'views/exito.php'; //mostrar éxito
}




// muestra el formulario de confirmación de eliminación
public function delete(int $id = 0){

     // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // recupera el libro para mostrar sus datos en la vista
    if(!$libro = libro::getById($id))
        throw new Exception("No existe el libro $id.");

    // carga la vista de confirmación de borrado
    include 'views/libro/borrar.php';
}

//elimina el libro
public function destroy(){

    //recuperar el identificador vía POST
    $id = empty($_POST['id'])? 0 : intval($_POST['id']);

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // borra el libro de la BDD
    if(!libro::borrar($id)){
        throw new Exception("No se pudo dar de baja el libro $id");

    // hace logout (solamente si es el mismo libro el que se está dando de baja)
    // y no cuando es el administrador el que da de baja un libro cualquiera
        // if(!Login::isAdmin() || Login::isAdmin() && Login::get()->id == $id){
        // (new LoginController())->logout();

    // si es el administrador el que da de baja un libro cualquiera, se muestra éxito
    }else{
        $mensaje = "El libro ha sido dado de baja correctamente.";
        include 'views/exito.php'; //mostrar éxito
    }
}


// funcion de busqueda por parametros
    public function search(){
        
        if( empty($_POST['search'])){
            $this->list();
            return;
        }

        $campo = $_POST['campo'];
        $valor = $_POST['valor'];
        $orden = $_POST['orden'];
        $sentido = $_POST['sentido'] ? $_POST['sentido'] : 'ASC';

        $libros = Libro::getFiltered( $campo, $valor, $orden, $sentido );

        require_once '../views/libro/listar.php';

    }

    // metodo para generar una vista con los libros de un tema

    public function tema( int $id ){
        $tema = Tema::getById($id);
        $libros = $tema->manyToMany('libro');
        include '../views/libro/listar.php';

    }
}