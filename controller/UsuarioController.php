<?php

// CONTROLADOR UsuarioController
class UsuarioController{

    // operación por defecto
    public function index(){
        $this->list(); // listado de usuarios
    }

    // lista los usuarios
    public function list(){

        // solamente el administrador
        // if(!Login::isAdmin())
        //     throw new Exception('No tienes permiso para hacer esto');

        $usuarios = Usuario::get();
        include '../views/admin/listar.php';
    }



    // muestra un usuario
    public function show(int $id = 0){

        // esta operación solamente la puede hacer el administrador
        // o bien el usuario propietario de los datos que se muestran
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // recuperar el usuario
        if(!$usuario = Usuario::getById($id))
            throw new Exception("No se pudo recuperar el usuario.");

        include '../views/admin/detalles.php';
    }




    // muestra el formulario de nuevo usuario
    public function create(){
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        include '../views/admin/nuevo.php';
    }

    // guarda el nuevo usuario
    public function store(){

        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // comprueba que llegue el formulario con los datos
        if(empty($_POST['guardar']))
            throw new Exception('No se recibieron datos');

        $usuario = new Usuario(); //crear el nuevo usuario

        $usuario->usuario = DB::escape($_POST['usuario']);
        $usuario->clave = md5($_POST['clave']); // encriptar la clave
        $usuario->nombre = DB::escape($_POST['nombre']);
        $usuario->apellidos = DB::escape($_POST['apellidos']);
        $usuario->privilegio = empty($_POST['privilegio'])? 0 : intval($_POST['privilegio']);
        $usuario->administrador = empty($_POST['administrador'])? 0 : 1;
        $usuario->email = DB::escape($_POST['email']);

        if(!$usuario->guardar())
            throw new Exception("No se pudo guardar $usuario->usuario");

        $mensaje="Guardado del usuario $usuario->usuario correcto.";
        $GLOBALS['mensaje'] = "Guardado del usuario $usuario->usuario correcto.";
        include '../views/exito.php'; //mostrar éxito
    }


    //ACTUALIZAR SE HACE EN DOS PASOS

    // muestra el formulario de edición de un usuario
    public function edit(int $id = 0){
       
        // esta operación solamente la puede hacer el administrador
        // o bien el usuario propietario de los datos que se muestran
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // recuperar el usuario
        if(!$usuario = Usuario::getById($id))
            throw new Exception("No se indicó el usuario.");

        // mostrar el formulario de edición
        include '../views/admin/actualizar.php';
    }


    // aplica los cambios de un usuario
    public function update(int $id ){

        // esta operación solamente la puede hacer el administrador
        // o bien el usuario propietario de los datos que se muestran
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // comprueba que llegue el formulario con los datos
        // if(empty($_POST['actualizar']))
        //     throw new Exception('No se recibieron datos');

        // $id = intval($_POST['id']); // recuperar el id vía POST

        // // recuperar el usuario
        // if(!$usuario = Usuario::getById($id))
        //     throw new Exception("No existe el usuario $id.");

        // $usuario->usuario = DB::escape($_POST['usuario']);
        // $usuario->nombre = DB::escape($_POST['nombre']);
        // $usuario->apellidos = DB::escape($_POST['apellidos']);
        // $usuario->privilegio = empty($_POST['privilegio'])? 0 : intval($_POST['privilegio']);
        // $usuario->administrador = empty($_POST['administrador'])? 0 : 1;
        // $usuario->email = DB::escape($_POST['email']);

        // //la clave solamente cambia si se indica una nueva
        // if(!empty($_POST['clave']))
        //     $usuario->clave = md5($_POST['clave']);

        /**
         * método para extraer los parámetros por GET con un prefijo
         */
        extract($_POST, EXTR_PREFIX_ALL, "p");
       
        // isset($p_funcion) ? $p_funcion : 'No existe parametro por POST';

        if(empty($p_actualizar))
                    throw new Exception('No se recibieron datos');
            
            if(!$usuario = Usuario::getById($id))
                throw new Exception("No existe el usuario $id.");

            unset($_POST['actualizar']);

            $datosActualizar = array_filter($_POST);

                foreach ( $datosActualizar as $key=>$valor){
                    $usuario->$key = $valor;            
                }

        // intenta realizar la actualización de datos
        // if($usuario->actualizar()===false)
        //     throw new Exception("No se pudo actualizar $usuario->usuario");

        // // prepara un mensaje
        // $GLOBALS['mensaje'] = "Actualización del usuario $usuario->usuario correcta.";

        // // repite la operación edit, así mantiene la vista de edición.
        // $this->edit($usuario->id);

        try{
            $usuario->actualizar();
                // prepara un mensaje
            $GLOBALS['mensaje'] = "Actualizado correctamente el usuario $usuario->usuario con id: $usuario->id.";
            
        }catch(Throwable $e){
            $GLOBALS['mensaje'] = "No se pudo actualizar el usuario: $usuario->usuario";  
            
        }finally{
            $this->edit($id);
        }
    }




    // muestra el formulario de confirmación de eliminación
    public function delete(int $id = 0){

         // esta operación solamente la puede hacer el administrador
        // o bien el usuario propietario de los datos que se muestran
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // recupera el usuario para mostrar sus datos en la vista
        if(!$usuario = Usuario::getById($id))
            throw new Exception("No existe el usuario $id.");

        // carga la vista de confirmación de borrado
        include 'views/admin/borrar.php';
    }

    //elimina el usuario
    public function destroy(){

        //recuperar el identificador vía POST
        $id = empty($_POST['id'])? 0 : intval($_POST['id']);

        // esta operación solamente la puede hacer el administrador
        // o bien el usuario propietario de los datos que se muestran
        if(! (Login::isAdmin()))
            throw new Exception('No tienes los permisos necesarios');

        // borra el usuario de la BDD
        if(!Usuario::borrar($id))
            throw new Exception("No se pudo dar de baja el usuario $id");

            $GLOBALS['mensaje'] = "No se pudo dar de baja el usuario con id $id.";

        // hace logout (solamente si es el mismo usuario el que se está dando de baja)
        // y no cuando es el administrador el que da de baja un usuario cualquiera
            if(!Login::isAdmin() || Login::isAdmin() && Login::get()->id == $id){
            (new LoginController())->logout();

        // si es el administrador el que da de baja un usuario cualquiera, se muestra éxito
        }else{
            $mensaje = "El usuario ha sido dado de baja correctamente.";
            $GLOBALS['mensaje'] = "Borrado del usuario con id $id.";
            include '../views/exito.php'; //mostrar éxito
        }
    }
}
