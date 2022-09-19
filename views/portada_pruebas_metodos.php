<?php
require_once '../config/config.php';
require_once '../libraries/autoload.php';
?>
<!DOCTYPE html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<title>Portada - <?=APP_TITLE?></title>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<link rel="stylesheet" type="text/css" href="css/estilo.css">
	</head>
	<body>
		<h1 class="h1">Portada - <?=APP_TITLE?></h1>
		<?php include '../views/components/menu.php';?>
		<h2>Bienvenido a nuestra aplicación</h2>
		<p>Esta es una aplicación de prueba para comprender el MVC.</p>


		<h2 class="ha">LISTADO DE LIBROS</h2>

<form method="post" action="/libro/search">
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Email address</label>
        <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Example textarea</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
</form>

<form>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Campo</label>
        <select class="form-select" aria-label="Default select example">
            <option value="titulo" <?= !empty($campo) && $campo == 'titulo' ? 'selected' : '' ?>>Título</option>
            <option value="isbn" <?= !empty($campo) && $campo == 'isbn' ? 'selected' : '' ?>>ISBN</option>
            <option value="editorial" <?= !empty($campo) && $campo == 'editorial' ? 'selected' : '' ?>>Editorial</option>
            <option value="autor" <?= !empty($campo) && $campo == 'autor' ? 'selected' : '' ?>>Autor</option>
        </select>
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="valor" name="valor" aria-describedby="valorHelp">
        <div id="valorHelp" class="form-text">Escribe tu búsqueda.</div>
    </div>
    <div class="mb-3">
        <label for="exampleInputEmail1" class="form-label">Campo</label>
        <select class="form-select" aria-label="Default select example" name="orden">
            <option value="titulo" <?= !empty($campo) && $campo == 'titulo' ? 'selected' : '' ?>>Título</option>
            <option value="isbn" <?= !empty($campo) && $campo == 'isbn' ? 'selected' : '' ?>>ISBN</option>
            <option value="editorial" <?= !empty($campo) && $campo == 'editorial' ? 'selected' : '' ?>>Editorial</option>
            <option value="autor" <?= !empty($campo) && $campo == 'autor' ? 'selected' : '' ?>>Autor</option>
        </select>
        <label for="exampleInputEmail1" class="form-label">Email address</label>
        <input type="text" class="form-control" id="valor" name="valor" aria-describedby="valorHelp">
        <div id="valorHelp" class="form-text">Escribe tu búsqueda.</div>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sentido" id="sentidoAsc" value="ASC" <?= !empty($sentido) && $sentido == 'ASC' ? 'checked' : '' ?>>
        <label class="form-check-label" for="sentido">
            Ascendente
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="sentido" id="sentidoDesc" <?= !empty($sentido) && $sentido == 'DESC' ? 'checked' : '' ?>>
        <label class="form-check-label" for="flexRadioDefault2">
            Descendente
        </label>
    </div>
    <button type="search" value="buscar" class="btn btn-primary">Search</button>
</form>
<a href="/libro" class="href">
    <button type="button" class="btn btn-primary">Quitar Filtros</button>
</a>


<!-- pruebas-->
<?php

echo "<h2>recuperando los temas de un libro concreto</h2>";
echo '<h3>$temas_libro = $libro->manyToMany("tema");</h3>';
$libro = Libro::getById(1);
$temas_libro = $libro->manyToMany('tema');

echo "<div class='container'>";
echo "<div class='card' style='width: 36rem;'>
<ul class='list-group list-group-flush'>";

    echo "<li class='list-group-item h1'>".$libro->titulo."</li>"; 
    echo "<li class='list-group-item'>AUTOR: ".$libro->autor."</li>";
    echo "<li class='list-group-item'>EDITORIAL: ".$libro->editorial."</li>";
    echo "<li class='list-group-item'>ISBN: ".$libro->isbn."</li>";
    echo "<li class='list-group-item'></li>";
    echo "<br>";

foreach ($temas_libro as $tema){

    echo "<li class='list-group-item h1'>TEMA: ".$tema->tema."</li>"; 
    
    echo "<li class='list-group-item'>Descripcion: ".$tema->descripcion."</li>";
    echo "<br>";
}
echo "</ul>
</div>";  
echo "</div>";
?>

<?php

echo "<h2>recuperando los libros de un tema concreto</h2>";
echo '<h3>$libros_tema = Tema::getById(1)->manyToMany("libro");</h3>';
$tema = Tema::getById(5);
$libros_tema = Tema::getById(1)->manyToMany("libro");

echo "<div class='container'>";
echo "<div class='card' style='width: 36rem;'>
<ul class='list-group list-group-flush'>";

    echo "<li class='list-group-item h1'>".$tema->tema."</li>"; 
    echo "<li class='list-group-item'>Descripción: ".$tema->descripcion."</li>";
    echo "<br>";

    echo "<h4> LIBROS DE ESTE TEMA:</h4>";
    echo "<br>";

foreach ($libros_tema as $libro){

    echo "<li class='list-group-item h3'>".$libro->titulo."</li>"; 
    echo "<li class='list-group-item h3'>AUTOR: ".$libro->autor."</li>";
    echo "<br>";
}
echo "</ul>
</div>";  
echo "</div>";
?>

<?php

echo "<h2>recuperando todos los libros</h2>";
echo '<h3>$libros = Libro::get();</h3>';
$libros = Libro::get();

echo "<div class='container'>";
echo "<div class='card' style='width: 36rem;'>
<ul class='list-group list-group-flush'>";

foreach ($libros as $libro){

    echo "<li class='list-group-item h1'>".$libro->titulo."</li>"; 
    
    echo "<li class='list-group-item'>AUTOR: ".$libro->autor."</li>";
    echo "<li class='list-group-item'>EDITORIAL: ".$libro->editorial."</li>";
    echo "<li class='list-group-item'>ISBN: ".$libro->isbn."</li>";
    echo "<li class='list-group-item'></li>";
    echo "<br>";
}
echo "</ul>
</div>";  
echo "</div>";
?>

<?php

$socio = Prestamo::getById(100)->belongsTo('Socio');
// echo "<h2>recuperando socio con el prestamo 100</h2>";
// echo $socio;

// $libro = Libro::getById($ejemplar->idlibro);
// echo "<h2>recuperando libro con el prestamo 100</h2>";
// echo $libro;

echo "<h2>recuperando los prestamos del socio 100</h2>";
echo '<h3>$prestamos = $socio->hasMany("Prestamo")</h3>';
$prestamos = $socio->hasMany('Prestamo');
foreach ($prestamos as $prestamo_socio){
    // $ejemplar = Ejemplar::getById($prestamo_socio->idejemplar);
    // $libro = Libro::getById($ejemplar->idlibro);
    // echo $libro->titulo;
    echo "<hr>";
    echo $prestamo_socio;
    echo "<br>";
}
?>

<!--FIN PRUEBAS-->
	</body>
</html>

