<?php

class SocioController {

    // lista los socios
    public function list(){

        // solamente el administrador
        // if(!Login::isAdmin())
        //     throw new Exception('No tienes permiso para hacer esto');

        $socios = Socio::get();
        include '../views/socio/listar.php';
    }


    // muestra un socio
    public function show(int $id = 0){

    // esta operación solamente la puede hacer el administrador
    // o bien el libro propietario de los datos que se muestran
    //if(! (Login::isAdmin() || Login::get()->id == $id))
    //    throw new Exception('No tienes los permisos necesarios.');
    if(!$id)
    throw new Exception("No se pudo indicó el id.");
    // recuperar el libro

    $socio = Socio::getById($id);

    if(!$socio)
       throw new Exception("No se pudo recuperar el socio.");

    // $prestamos = $socio->hasMany('Prestamo');
    $prestamos = Socio::getPrestamosNoDevueltos($socio->id);
    $totalSinDevolver = count($prestamos);
    $historicoPrestamos = Socio::getHistoricoPrestamosDevueltos($socio->id);
    $totalPrestamos =count($historicoPrestamos);
    include '../views/socio/detalles.php';
    }


    // crear un nuevo socio

    public function create ():void{
        include '../views/socio/nuevo.php';
    }

    // guardar un nuevo socio
    public function store ():void{
        /**
         * método para extraer los parámetros por GET con un prefijo
         */
        extract($_POST, EXTR_PREFIX_ALL, "p");

        isset($p_funcion) ? $p_funcion : 'No existe parametro por POST';

        if(empty($p_guardar))
            throw new Exception('No se recibieron datos');

        $socio = new Socio(); //crear el nuevo socio

        $socio->nombre = DB::escape($p_nombre);
        $socio->dni = DB::escape($p_dni);
        $socio->apellidos = DB::escape($p_apellidos);
        $socio->nacimiento = DB::escape($p_nacimiento);
        $socio->email = DB::escape($p_email);
        $socio->direccion = DB::escape($p_direccion);
        $socio->poblacion = DB::escape($p_poblacion);
        $socio->provincia = DB::escape($p_provincia);
        $socio->cp = DB::escape($p_cp);
        $socio->telefono = DB::escape($p_telefono);

        if(!$socio->guardar())
            throw new Exception("No se pudo guardar $socio->socio");

        $mensaje="Guardado del socio $socio->id correcto.";
        include '../views/exito.php'; //mostrar éxito
    }


    // muestra el formulario de edición de un socio
    public function edit(int $id = 0){

        // esta operación solamente la puede hacer el administrador
        // o bien el socio propietario de los datos que se muestran
        // if(! (Login::isAdmin() || Login::get()->id == $id))
        //     throw new Exception('No tienes los permisos necesarios');

        // recuperar el socio
        if(!$socio = Socio::getById($id))
            throw new Exception("No se indicó el socio.");

        // mostrar el formulario de edición
        include '../views/socio/actualizar.php';
    }

    // aplica los cambios de un socio
    public function update( int $id ){

        // esta operación solamente la puede hacer el administrador
        // o bien el socio propietario de los datos que se muestran
        // if(! (Login::isAdmin() || Login::get()->id == $id))
        //     throw new Exception('No tienes los permisos necesarios');

        /**
         * método para extraer los parámetros por GET con un prefijo
         */
        extract($_POST, EXTR_PREFIX_ALL, "p");

        isset($p_funcion) ? $p_funcion : 'No existe parametro por POST';

        if(empty($p_actualizar))
            throw new Exception('No se recibieron datos');

        // recuperar el socio
        if(!$socio = Socio::getById($id))
            throw new Exception("No existe el socio $id.");
        
        unset($_POST['actualizar']);
       
        $datosActualizar = array_filter($_POST);
// var_dump($socio);
        foreach ( $datosActualizar as $key=>$valor){
            $socio->$key = $valor;            
        }
// var_dump($socio);die();
            // $socio->nombre = DB::escape($p_nombre);
            // $socio->dni = DB::escape($p_dni);
            // $socio->apellidos = DB::escape($p_apellidos);
            // $socio->nacimiento = DB::escape($p_nacimiento);
            // $socio->email = DB::escape($p_email);
            // $socio->direccion = DB::escape($p_direccion);
            // $socio->poblacion = DB::escape($p_poblacion);
            // $socio->provincia = DB::escape($p_provincia);
            // $socio->cp = DB::escape($p_cp);
            // $socio->telefono = DB::escape($p_telefono);

            // var_dump();die();

        // intenta realizar la actualización de datos
        if($socio->actualizar()===false)
            throw new Exception("No se pudo actualizar $socio->nombre $socio->apellidos");

        // prepara un mensaje
        $GLOBALS['mensaje'] = "Actualización del socio $socio->nombre $socio->apellidos correcta.";

        // repite la operación edit, así mantiene la vista de edición.
        // $this->edit($socio->id);
        $mensaje="Actualización del socio $socio->id correcta.";
        include '../views/exito.php'; //mostrar éxito
    }

    //eliminar un socio
    public function destroy(int $id ){
        // $id = empty($_POST['id'])? 0 : intval($_POST['id']);

    // esta operación solamente la puede hacer el administrador
    // o bien el Ejemplar propietario de los datos que se muestran
    // if(! (Login::isAdmin() || Login::get()->id == $id))
    //     throw new Exception('No tienes los permisos necesarios');

    // borra el socio de la BDD
    if(!Socio::borrar($id)){
        throw new Exception("No se pudo dar de baja el socio $id");

    // hace logout (solamente si es el mismo Ejemplar el que se está dando de baja)
    // y no cuando es el administrador el que da de baja un Ejemplar cualquiera
        // if(!Login::isAdmin() || Login::isAdmin() && Login::get()->id == $id){
        // (new LoginController())->logout();

    // si es el administrador el que da de baja un Ejemplar cualquiera, se muestra éxito
    }else{
        $mensaje = "El socio ha sido dado de baja correctamente.";
        include '../views/exito.php'; //mostrar éxito
    }
    }

    
}