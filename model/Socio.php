<?php

class Socio extends Model {

    // metodo para recuperar los prestamos de un socio ordenados por fecha de devolucion si no estan devueltos
    public static function getPrestamosNoDevueltos(int $id){
       
            // $consulta = "SELECT * FROM prestamos WHERE idsocio=$id AND devolucion=NULL ORDER BY prestamo ASC;";
            $consulta = "SELECT * FROM prestamos
            WHERE idsocio=$id AND devolucion IS NULL ORDER BY limite ASC;";
            
            return DB::selectAll($consulta, 'Prestamo');
        
    }

    
    // metodo para recuperar los prestamos de un socio ordenados por fecha de devolucion si no estan devueltos
    public static function getHistoricoPrestamosDevueltos(int $id){
        
    // $consulta = "SELECT * FROM prestamos WHERE idsocio=$id AND devolucion=NULL ORDER BY prestamo ASC;";
    $consulta = "SELECT * FROM prestamos
    WHERE idsocio=$id AND devolucion IS NOT NULL ORDER BY devolucion DESC;";
    
    return DB::selectAll($consulta, 'Prestamo');

}
}
