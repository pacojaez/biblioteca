<?php

class Libro extends Model {

    // protected string $table = '';

    public static function table(){
        return parent::getTable();
    }

    // ESTA FUNCIÓN LA SUSTITUYO EN LA CLASS MODEL POR EL MÉTODO manyToMany(string $relatedClass, string $primary = 'id', string $foreignKey = '')
    public function getEjemplares(  ): ?array {
        $consulta = "SELECT * FROM ejemplares WHERE idlibro=$this->id";
        return DB::selectAll($consulta, 'Ejemplar');
    }

    // ESTA FUNCIÓN LA SUSTITUYO EN LA CLASS MODEL POR EL MÉTODO hasMany(string $relatedClass,  string $primary = 'id', string $foreign = null ):array
    public function getTemas(  ): ?array {
        $consulta = "SELECT t.* FROM temas t
                        INNER JOIN temas_libros tl 
                        ON t.id = tl.idtema 
                        WHERE tl.idlibro=$this->id";
        return DB::selectAll($consulta, 'Tema');
    }

}