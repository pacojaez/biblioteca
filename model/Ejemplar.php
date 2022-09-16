<?php

class Ejemplar extends Model {

    public string $table = 'ejemplares';
    

    // metodo para recuperar si un ejemplar está o no en préstamo
    // devolviendo el titulo del libro y el socio que tiene ese ejemplar
    public function getEstadoEjemplar( int $id)  {

        $ejemplar = Ejemplar::getById($id);

        $libro = $ejemplar->belongsTo('libro');

        $prestamo = $ejemplar->hasMany('prestamo');

        // $socio = $prestamo->belongsTo('socio');

        // var_dump($prestamo);die();
    }
}