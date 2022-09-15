<?php

class PrestamoController{


    public function actualizarPrestamo (int $id):void{
        
        if(empty($_POST['devolver']))
        throw new Exception('No se recibieron datos');

        $id = intval($_POST['id']); // recuperar el id vía POST

        if(!$prestamo =Prestamo::getById($id))
            throw new Exception("No existe el Prestamo # $id.");
        
        $prestamo->devolucion = date('Y-m-d h:i:s');

        // intenta realizar la actualización de datos
        if($prestamo->actualizar()===false)
        throw new Exception("No se pudo actualizar el prestamo: $prestamo->id");

        // prepara un mensaje
        $GLOBALS['mensaje'] = "Actualización del prestamo: $prestamo->id correcta.";
        $mensaje = 'Actualización correcta';
        // repite la operación edit, así mantiene la vista de edición.
        //$this->edit($Ejemplar->id);
        include '../views/exito.php'; //mostrar éxito

    }
}