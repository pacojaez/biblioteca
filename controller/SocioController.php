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
       
    }

    
}