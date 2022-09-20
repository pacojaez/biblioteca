
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
    $temasLibro = $libro->manyToMany('tema');

    include '../views/libro/detalles.php';
}

// muestra el formulario de nueva libro
public function create(){

    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    include '../views/libro/nuevo.php';
}

// guarda el nuevo libro
public function store(){

    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['guardar']))
        throw new Exception('No se recibieron datos');

    $libro = new libro(); //crear el nuevo libro

    $libro->titulo = DB::escape($_POST['titulo']);
    $libro->autor = DB::escape($_POST['autor']); // encriptar la clave
    $libro->edadrecomendada = DB::escape($_POST['edadrecomendada']);
    $libro->ediciones = DB::escape($_POST['ediciones']);
    $libro->isbn = DB::escape($_POST['isbn']);
    $libro->editorial = DB::escape($_POST['editorial']);
    $libro->idioma = DB::escape($_POST['idioma']);

    if(!$libro->guardar())
        throw new Exception("No se pudo guardar $libro->titulo");

    $mensaje="Guardado del libro $libro->titulo correcto.";
    $GLOBALS['mensaje'] = "El libro $libro->titulo se ha guardado de forma correcta.";
    include '../views/exito.php'; //mostrar éxito
}


//ACTUALIZAR SE HACE EN DOS PASOS

// muestra el formulario de edición de un libro
public function edit(int $id = 0){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
        throw new Exception('No tienes permiso para hacer esto');

    // recuperar el libro
    if(!$libro = Libro::getById($id))
        throw new Exception("No se indicó la libro.");
    // mostrar el formulario de edición
    include "../views/libro/actualizar.php";
}


// aplica los cambios de un libro
public function update( int $id ){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    /**
         * método para extraer los parámetros por GET con un prefijo
         */
    extract($_POST, EXTR_PREFIX_ALL, "p");

    
    isset($p_funcion) ? $p_funcion : 'No existe parametro por POST';

   if(empty($p_actualizar))
            throw new Exception('No se recibieron datos');
    
    if(!$libro = Libro::getById($id))
        throw new Exception("No existe el libro $id.");

    unset($_POST['actualizar']);

    $datosActualizar = array_filter($_POST);

        foreach ( $datosActualizar as $key=>$valor){
            $libro->$key = $valor;            
        }
    // recuperar la libro
    // recuperar el libro
    // if(!$libro =Libro::getById($id))
    //     throw new Exception("No existe la libro $id.");

    // $libro->titulo = DB::escape($_POST['t']);
    // $libro->title = DB::escape($_POST['title']);
    // $libro->subtitle = DB::escape($_POST['subtitle']);
    // $libro->meta_description = DB::escape($_POST['meta_description']);
    // $libro->tags = DB::escape($_POST['tags']);
    // $libro->imagen = DB::escape($_POST['imagen']);
    // $libro->is_draft = empty($_POST['is_draft'])? 0 : 1;
    // $libro->id_libro = intval($_POST['id_libro']);
    // $libro->updated_at = date('Y-m-d h:i:s');

    // intenta realizar la actualización de datos
    if($libro->actualizar()===false)
        throw new Exception("No se pudo actualizar la libro: $libro->titulo");

    // prepara un mensaje
    $GLOBALS['mensaje'] = "Actualización de la libro: $libro->titulo correcta.";
    $mensaje = 'Actualización correcta';
    // repite la operación edit, así mantiene la vista de edición.
    //$this->edit($libro->id);
    include '../views/exito.php'; //mostrar éxito
}

public function addTema( int $idlibro  ){
   
    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
    throw new Exception('No tienes permiso para hacer esto');

    if(!$libro = Libro::getById($idlibro))
        throw new Exception("No existe el libro $idlibro.");
    
    /**
    * método para extraer los parámetros por GET con un prefijo
    */
    extract($_POST, EXTR_PREFIX_ALL, "p");

    isset($p_idtema) ? $p_idtema : 'No existe el tema con ese id';

    $tema= Tema::getById($p_idtema);
    // var_dump($libro->addTema( $idlibro, $p_idtema )); die();
    
    try{
        $libro->addTema( $idlibro, $p_idtema);
            // prepara un mensaje
        $GLOBALS['mensaje'] = "Añadido correctamente el Tema $tema->tema al libro: $libro->titulo.";
        
    }catch(Throwable $e){
        $GLOBALS['mensaje'] = "No se pudo actualizar el libro: $libro->titulo";  
        
    }finally{
        $this->show($idlibro);
    }


}


// muestra el formulario de confirmación de eliminación
public function delete(int $id = 0){

     // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    // recupera el libro para mostrar sus datos en la vista
    if(!$libro = libro::getById($id))
        throw new Exception("No existe el libro $id.");

    // carga la vista de confirmación de borrado
    include 'views/libro/borrar.php';
}

//elimina el libro
public function destroy(){

    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    //recuperar el identificador vía POST
    $id = empty($_POST['idlibro'])? 0 : intval($_POST['idlibro']);

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // borra el libro de la BDD
    if(!Libro::borrar($id)){
        throw new Exception("No se pudo dar de baja el libro $id");

    // hace logout (solamente si es el mismo libro el que se está dando de baja)
    // y no cuando es el administrador el que da de baja un libro cualquiera
        // if(!Login::isAdmin() || Login::isAdmin() && Login::get()->id == $id){
        // (new LoginController())->logout();

    // si es el administrador el que da de baja un libro cualquiera, se muestra éxito
    }else{
        $GLOBALS['mensaje'] = "El libro libro con id $id se ha borrado del sistema.";
        $mensaje = "El libro ha sido dado de baja correctamente.";
        include '../views/exito.php'; //mostrar éxito
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