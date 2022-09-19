<?php

class Tema extends Model {

    public static function getFourLastAdded(){

        $consulta = "SELECT * FROM temas 
                        ORDER BY id DESC
                        limit 4;";

        return DB::selectAll($consulta, 'Tema');
    }
}