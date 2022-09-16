<?php

class Socio extends Model {

    // metodo para recuperar los prestamos de un socio ordenados por fecha de devolucion si no estan devueltos
    public static function getPrestamosNoDevueltos(int $id){
       
            // $consulta = "SELECT * FROM prestamos
            // WHERE idsocio=$id AND devolucion IS NULL ORDER BY limite ASC;";

            $consulta = "SELECT p.*, l.titulo FROM prestamos p  
                            INNER JOIN ejemplares e ON e.id = p.idejemplar
                            INNER JOIN libros l ON l.id = e.idlibro 
                            WHERE p.idsocio=$id 
                            AND devolucion IS NULL 
                            ORDER BY limite 
                            ASC;";
            
            return DB::selectAll($consulta, 'Prestamo');
            // $fet = DB::selectAll($consulta, 'Prestamo');
            // var_dump($fet); die();
        
    }

    
    // metodo para recuperar los prestamos de un socio ordenados por fecha de devolucion si no estan devueltos
    public static function getHistoricoPrestamosDevueltos(int $id){
        
    // $consulta = "SELECT * FROM prestamos
    // WHERE idsocio=$id AND devolucion IS NOT NULL ORDER BY devolucion DESC;";
    $consulta ="SELECT p.*, l.titulo FROM prestamos p  
                            INNER JOIN ejemplares e ON e.id = p.idejemplar
                            INNER JOIN libros l ON l.id = e.idlibro 
                            WHERE p.idsocio=$id 
                            AND devolucion IS NOT NULL 
                            ORDER BY limite 
                            ASC;";
    
    return DB::selectAll($consulta, 'Prestamo');

}
}
