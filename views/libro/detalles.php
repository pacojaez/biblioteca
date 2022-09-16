<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>

<div class="container-fluid">
<div class="card mx-auto" style="width: 36rem;">
  <div class="card-body">
    <h2 class="card-title h2"><?php echo "$libro->titulo"; ?></h2>
    <h4 class="card-subtitle mb-2 text-muted h4">AUTOR: <?php echo "$libro->autor" ?></h4>
    <p class="card-text">ISBN: <?php echo "$libro->isbn " ?>
    <p class="card-text">IDIOMA: <?php echo "$libro->idioma" ?></p>
    <p class="card-text">Nº de ediciones: <?php echo "$libro->ediciones" ?></p>
    <p class="card-text">Edad recomendada: <?php echo "$libro->edadrecomendada" ?></p>
  </div>

<!--AÑADIR EJEMPLARES DEL LIBRO-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
AÑADIR EJEMPLAR
</button>

<!-- Modal AÑADIR EJEMPLAR -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/ejemplar/store" method="post">
            <input type="hidden" class="form-control" name="idlibro" value='<?php echo "$libro->id"; ?>' >

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">AÑO</span>
                <input type="number" class="form-control" name="anyo">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">EDICIÓN</span>
                <input type="number" class="form-control" name="edicion">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">PRECIO</span>
                <input type="number" class="form-control" name="precio">
            </div>        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Guardar</button>
        </div>
      </form>
    </div>
  </div>
</div>



  
    <?php
    if($ejemplares){
        echo "<h2 class='card-subtitle h2'>EJEMPLARES DEL LIBRO</h2>";
        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
            foreach($ejemplares as $ejemplar){

                $ejemplar->getEstadoEjemplar($ejemplar->id);

                echo "<div class='accordion-item'>
                <h2 class='accordion-header' id='flush-heading$ejemplar->id'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$ejemplar->id' aria-expanded='false' aria-controls='flush-collapse$ejemplar->id'>
                        Ejemplar #id= $ejemplar->id
                    </button>          
                    <!-- Modal borrar EJEMPLAR -->
                    <div class='modal fade' id='destroyEjemplar$ejemplar->id' tabindex='-1' aria-labelledby='destroyEjemplarLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                            <h5 class='modal-title' id='destroyEjemplarLabel$ejemplar->id'>Vas a borrar el ejemplar # $ejemplar->id del libro $libro->titulo </h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                            <h5 class='modal-title' id='destroyEjemplarLabel$ejemplar->id'>Esta acción es irreversible, ¿estás seguro? </h5>
                            <form action='/ejemplar/destroy/$ejemplar->id' method='post'>
                                <input type='hidden' class='form-control' name='id' value='$ejemplar->id' >
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='submit' class='btn btn-danger mx-auto' data-bs-toggle='modal' data-bs-target='#destroyEjemplar$ejemplar->id'>BORRAR EJEMPLAR</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </h2>
                <div id='flush-collapse$ejemplar->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$ejemplar->id' data-bs-parent='#accordionFlushExample'>
                    <div class='accordion-body'>Precio: <code>$ejemplar->precio €</code> Año: $ejemplar->anyo Edición: $ejemplar->edicion </div>
                    <button type='button' class='btn btn-danger mx-auto' data-bs-toggle='modal' data-bs-target='#destroyEjemplar$ejemplar->id'>
                        BORRAR EJEMPLAR
                    </button>
                </div>
            </div>";
            }
            echo "</div'>";
        }else{
            echo "<h3>No tenemos ejemplares de este Libro</h3>";
        }
    ?>



<h2 class="h2">Temas del libro <?php echo "$libro->titulo" ?></h2>

<?php
    if($temas){

        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";

            foreach($temas as $tema){   
                echo "<div class='accordion-item'>
                <h2 class='accordion-header' id='flush-heading$tema->id'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$tema->id' aria-expanded='false' aria-controls='flush-collapse$ejemplar->id'>
                    $tema->tema
                </button>
                </h2>
                <div id='flush-collapse$tema->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$tema->id' data-bs-parent='#accordionFlushExample'>
                    <div class='accordion-body'>Descripción: $tema->descripcion </div>
                </div>
            </div>";
            }
            echo "</div'>";
        }else{
            echo "No tenemos Temas de este Libro";
        }
    ?>
</div>
</div>
</div>


<?php
Basic::getFooter();
?>