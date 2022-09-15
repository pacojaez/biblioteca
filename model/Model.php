<?php
     
// Clase padre para todos los modelos
// implementa las operaciones genéricas del CRUD y el __toString()

/* Clase de la que pueden heredar los modelos
 *
 * Automatiza las tareas del CRUD, permitiendo que los modelos estén vacíos
 *
 * autor: Robert Sallent
 * última revisión: 03/09/2022
 *
 */

class Model{

    protected string $table = '';

    // metodo para hacer la consulta sobre la tabla determinada
    // la Entidad debe tener la propiedad protected $table para vincularla a una tabla
    // si no existe la propiedad $table en la clase la Entidad se vinculará al plural de la Entidad (Libro->tablas libros)
    public static function getTable(){
        $atributes = ((get_class_vars(get_called_class()))) ? (get_class_vars(get_called_class())) : [];
            return ($atributes['table'])? $atributes['table'] : strtolower(get_called_class()).'s';

    }
  
    // método para recuperar un array con todos los objetos.
    public static function get():array{
        // calcula el nombre de la tabla (Libro --> libros)
        // ojo, que el modelo Ejemplar deberá llamarse Ejemplare
        // $tabla = strtolower(get_called_class()).'s';
        $tabla = self::getTable(); // nombre de la tabla
        
        // prepara la consulta y la ejecuta
        $consulta = "SELECT * FROM $tabla";
        return (DB_CLASS)::selectAll($consulta, get_called_class()); 
    }

    // método para recuperar un objeto a partir de su ID (null si no lo encuentra)
    public static function getById(int $id){
        // calcula el nombre de la tabla (Libro --> libros)
        // $tabla = strtolower(get_called_class()).'s';  
        $tabla = self::getTable(); // nombre de la tabla
        
        $consulta = "SELECT * FROM $tabla WHERE id=$id";
        return (DB_CLASS)::select($consulta, get_called_class());
    }
    
    // método para guardar un nuevo objeto en la BDD    
    public function guardar(){
        // $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        $tabla = self::getTable(); // nombre de la tabla
        
        // prepara la consulta de inserción (esta es más compleja)
        $consulta="INSERT INTO $tabla (";
        
        // nombres de los campos
        foreach($this as $propiedad=>$valor){
            if($propiedad == 'table')
                continue;
            $consulta .= "$propiedad, "; 
        } 
                  
        
        $consulta = rtrim($consulta, ', '); // quita la última coma
        $consulta .= ") VALUES (";
        
        // valores
        foreach($this as $valor){
            if($valor == self::getTable())
            continue;
            // pone comillas en el SQL solo para los string
            // también controla los valores nulos
            switch(gettype($valor)){
                case "string" : $consulta .= "'$valor', "; break;
                case "NULL"   : $consulta .= "NULL, "; break;
                default       : $consulta .= "$valor, ";
            }  
        }
             

        $consulta = rtrim($consulta, ', '); // quita la última coma
        $consulta .= ");";
        
        $this->id = (DB_CLASS)::insert($consulta); // guarda el nuevo objeto 
           
        // retorna el id del nuevo objeto (o false si falló la inserción)
        return $this->id;      
    } 
    
    // método que actualiza un objeto en la base de datos
    public function actualizar(){ 
        // $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        $tabla = self::getTable(); // nombre de la tabla
        
        // prepara la consulta 
        $consulta="UPDATE $tabla SET ";
        
        // pone comillas en el SQL solo para los string
        foreach($this as $propiedad=>$valor)
            switch(gettype($valor)){
                case "string" : $consulta .= "$propiedad='$valor', "; break;
                case "NULL"   : $consulta .= "$propiedad=NULL, "; break;
                default       : $consulta .= "$propiedad=$valor, "; 
            }
                    
        $consulta = rtrim($consulta, ', '); // quita la última coma
        $consulta .= " WHERE id=$this->id";

        // lanza la consulta y retorna el número de filas afectadas
        // o false si hubo algún problema
        return (DB_CLASS)::update($consulta); 
    }
    
    // recuperar objetos con un filtro avanzado
    public static function getFiltered(string $campo='id', string $valor='',
        string $orden='id', string $sentido='ASC'):array{
        
            // $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
            $tabla = self::getTable(); // nombre de la tabla
            
            $consulta="SELECT *
               FROM $tabla
               WHERE $campo LIKE '%$valor%'
               ORDER BY $orden $sentido";
            
            return (DB_CLASS)::selectAll($consulta, get_called_class());
    }
    
    // método que borra un objeto de la base de datos
    public static function borrar(int $id){
        // $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla  
        $tabla = self::getTable(); // nombre de la tabla
        $consulta="DELETE FROM $tabla WHERE id=$id";  
        return (DB_CLASS)::delete($consulta);
    }
    
    // método que realiza consultas de totales
    public static function total(
        string $operacion = 'COUNT',
        string $campo = '*'
    ){
        // $tabla = strtolower(get_called_class()).'s'; // nombre de la tabla
        $tabla = self::getTable(); // nombre de la tabla
        return (DB_CLASS)::total($tabla, $operacion, $campo);
    }
    
    
    
    // método que recupera objetos relacionados en relación 1 a N
    
    // por ejemplo para recuperar préstamos de un socio sería 
    // $socio->hasMany('Prestamo', 'id', 'idsocio')
    
    // - si la clave primaria se llama 'id', no hace falta indicarla 
    // - si la clave foranea respeta el nombre 'id' + entidad, no hace falta indicarla
    // el ejemplo anterior también funcionará como $socio->hasMany('Prestamo');
    
    public function hasMany(
        string $relatedClass,   // clase relacionada
        string $primary = 'id', // campo por el que se relacionan las tablas
        string $foreign = null  // nombre de la clave foránea (si no respeta el convenio)
    ):array{
        
        // $tabla = strtolower($relatedClass).'s';                 // nombre de la tabla
        

        // forma de relacionar las tablas de la entidad
        // con la propiedad $table del Modelo si existe
        $atributes = (get_class_vars($relatedClass)) ? (get_class_vars($relatedClass)) : [];
            $tabla = ($atributes['table'])? $atributes['table'] : strtolower($relatedClass).'s';

        $foreign = $foreign ?? 'id'.strtolower(get_called_class());  // cálculo de la clave foranea
        
        $consulta="SELECT * FROM $tabla WHERE $foreign = ".$this->$primary;
               
        return (DB_CLASS)::selectAll($consulta, $relatedClass);
    }
    
    // método que recupera objetos relacionados en relación N a 1
    
    // por ejemplo para recuperar el socio de un préstamo sería 
    // $prestamo->belongsTo('Socio', 'id', 'idsocio')
    
    // - si la clave primaria se llama 'id', no hace falta indicarla
    // - si la clave foranea respeta el nombre 'id' + entidad, no hace falta indicarla 
    // el ejemplo anterior también funciona como $prestamo->belongsTo('Socio');
    
    public function belongsTo(
        string $relatedClass, 
        string $primary = 'id', 
        string $foreign = null
    ){
        // $tabla = strtolower($relatedClass).'s';                 // nombre de la tabla
    
        // forma de relacionar las tablas de la entidad
        // con la propiedad $table del Modelo si existe
        $atributes = (get_class_vars($relatedClass)) ? (get_class_vars($relatedClass)) : [];
            $tabla = ($atributes['table'])? $atributes['table'] : strtolower($relatedClass).'s';

        $foreign = $foreign ?? 'id'.strtolower($relatedClass);  // cálculo de la clave foranea
        // var_dump($foreign);die();
        $consulta="SELECT * FROM $tabla WHERE $primary = ".$this->$foreign;
        
        return (DB_CLASS)::select($consulta, $relatedClass);
    }


    // metodo que recupera objetos en relaciones N-N

    // por ejemplo para recuperar los temas de un libro sería 
    // $temas_libro = $libro->manyToMany('tema');
    
    // - si la clave primaria se llama 'id', no hace falta indicarla
    // - si la clave foranea respeta el nombre 'id' + entidad, no hace falta indicarla
    
    // TODO preparar el metodo para recibir claves primaria y foranea por parametro

    public function manyToMany(string $relatedClass, string $primary = 'id', string $foreignKey = ''){

        $atributes = (get_class_vars($relatedClass)) ? (get_class_vars($relatedClass)) : [];
        $tabla_1 = ($atributes['table'])? $atributes['table'] : strtolower($relatedClass).'s';

        $tabla_2 = self::getTable();
        $relacion = $tabla_1."_".$tabla_2;
        $relacion_inversa = $tabla_2."_".$tabla_1;

        $tabla_1_singular = rtrim($tabla_1, "s");
        $tabla_2_singular = rtrim($tabla_2, "s");

        $verificar_si_tabla_existe = (DB_CLASS)::query("SHOW TABLES LIKE '$relacion';");
        
        // var_dump($verificar_si_tabla_existe->fetchAll());die();
        
        if(  $verificar_si_tabla_existe->fetchAll() !== [] ){

            $consulta = "SELECT t.* FROM $tabla_1 t
            INNER JOIN $relacion tl 
            ON t.id = tl.id$tabla_1_singular 
            WHERE tl.id$tabla_2_singular=$this->id";

            return (DB_CLASS)::selectAll($consulta, $relatedClass);
        }else{
            $consulta = "SELECT t.* FROM $tabla_1 t
            INNER JOIN $relacion_inversa tl 
            ON t.id = tl.id$tabla_1_singular 
            WHERE tl.id$tabla_2_singular=$this->id";

            return (DB_CLASS)::selectAll($consulta, $relatedClass);

        }

        // return (DB_CLASS)::selectAll($consulta, $relatedClass);

    }

    // public function getTemas(  ): ?array {
    //     $consulta = "SELECT t.* FROM temas t
    //                     INNER JOIN temas_libros tl 
    //                     ON t.id = tl.idtema 
    //                     WHERE tl.idlibro=$this->id";

    //     return DB::selectAll($consulta, 'Tema');
    // }
    
    
    // el método __toString(), lo usaremos principalmente en test
    public function __toString():string{
        $texto = '';
       
        foreach($this as $propiedad=>$valor)
            $texto .= "$propiedad: <b>$valor</b>, ";
        
        return rtrim($texto, ', '); // quita la última coma
    }
}


