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


    public function crear ():void{
        
         /**
         * método para extraer los parámetros por GET con un prefijo
         */
        extract($_POST, EXTR_PREFIX_ALL, "p");

        isset($p_funcion) ? $p_funcion : 'No existe parametro por POST';

        if(empty($p_guardar))
            throw new Exception('No se recibieron datos');

            // // verificar si el ejemplar está disponible para el préstamo (devolución=NULL)
            $verificado = Prestamo::verificarDisponibilidadPrestamo(Prestamo::getById($p_idejemplar)->id);
            
            if($verificado){
                $socio = Socio::getById($verificado[0]->idsocio);
                $limite = Prestamo::getById($p_idejemplar)->limite;
                $GLOBALS['mensaje'] = "Este ejemplar no se puede prestar. Lo tiene el socio $verificado[0]  ";
                $mensaje = "EJEMPLAR NO DISPONIBLE PARA EL PRÉSTAMO <br>DATOS DEL PRÉSTAMO:<br> SOCIO: $socio->nombre $socio->apellidos ID: $socio->id.<br> Fecha límite de devolución $limite";
                include '../views/error.php'; //mostrar érror
                return;
            }
                
            $prestamo = new Prestamo(); //crear el nuevo usuario

            $prestamo->idsocio = DB::escape($p_idsocio);
            $prestamo->idejemplar = DB::escape($p_idejemplar);
            $prestamo->limite = DB::escape($p_limite);
            $prestamo->prestamo = date('Y-m-d h-i-s');

             // intenta realizar la actualización de datos
            if($prestamo->guardar() === false)
                throw new Exception("No se pudo actualizar el prestamo: $prestamo->id");

        // prepara un mensaje
        $GLOBALS['mensaje'] = "Actualización del prestamo: $prestamo->id correcta.";
        $mensaje = 'Guardado correcto';
        // repite la operación edit, así mantiene la vista de edición.
        //$this->edit($Ejemplar->id);
        include '../views/exito.php'; //mostrar éxito

    }
}