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
                        WHERE tl.idlibro=$this->id;";
        return DB::selectAll($consulta, 'Tema');
    }

    //funcion para añadir un tema a un libro
    public function addTema( int $idlibro, int $idtema ){
        $consulta = "INSERT INTO temas_libros (idlibro, idtema)
                      VALUES( $idlibro, $idtema);";
        return DB::insertPivot($consulta);
    }

    // recupera los últimos 4 libros para añadir enlaces en el footer
    public static function getFourLastAdded(){

        $consulta = "SELECT id, titulo FROM libros 
                        ORDER BY id DESC
                        limit 4;";

        return DB::selectAll($consulta, 'Libro');
    }

}