
<?php
// CONTROLADOR BlogController
class TemaController{

    // muestra el formulario de nuevo usuario
    public function create(){
        if(! (Login::isAdmin() || Login::hasPrivilege(300)))
            throw new Exception('No tienes los permisos necesarios');

        include '../views/tema/nuevo.php';
    }


    // guarda el nuevo tema
public function store(){

    if(! (Login::isAdmin() || Login::hasPrivilege(300)))
       throw new Exception('No tienes permiso para hacer esto');

    // comprueba que llegue el formulario con los datos
    if(empty($_POST['guardar']))
        throw new Exception('No se recibieron datos');

    $tema = new tema(); //crear el nuevo tema

    $tema->tema = DB::escape($_POST['tema']);
    $tema->descripcion = DB::escape($_POST['descripcion']); 

    if(!$tema->guardar())
        throw new Exception("No se pudo guardar $tema->tema");

    $mensaje="Guardado del tema $tema->tema correcto.";
    include '../views/exito.php'; //mostrar éxito
}

}