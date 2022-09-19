<?php

class Prestamo extends Model {

    // VERIFICA SI EL EJEMPALR ESTÁ DISPONIBLE PARA EL PRÉSTAMO (idjemplar, devolucion= NULL)

    public static function verificarDisponibilidadPrestamo( int $ejemplarid ){

        $consulta = "SELECT * FROM prestamos
                        WHERE idejemplar = $ejemplarid
                        AND devolucion IS NULL;";

        return DB::selectAll($consulta, 'Prestamo');

    }
    
}