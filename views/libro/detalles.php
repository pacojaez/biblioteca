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
  
    <?php
    if($ejemplares){

        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";

            foreach($ejemplares as $ejemplar){   
                echo "<div class='accordion-item'>
                <h2 class='accordion-header' id='flush-heading$ejemplar->id'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$ejemplar->id' aria-expanded='false' aria-controls='flush-collapse$ejemplar->id'>
                    Ejemplar #id= $ejemplar->id
                </button>
                </h2>
                <div id='flush-collapse$ejemplar->id' class='accordion-collapse collapse' aria-labelledby='flush-heading$ejemplar->id' data-bs-parent='#accordionFlushExample'>
                    <div class='accordion-body'>Precio: <code>$ejemplar->precio €</code> Año: $ejemplar->anyo Edición: $ejemplar->edicion </div>
                </div>
            </div>";
            }
            echo "</div'>";
        }else{
            echo "No tenemos ejemplares de este Libro";
        }
    ?>

<!--AÑADIR EJEMPALRES DEL LIBRO-->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mx-auto" data-bs-toggle="modal" data-bs-target="#exampleModal">
AÑADIR EJEMPLAR
</button>
<!-- Modal -->
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
<a href="/ejemplar/create/<?= $libro->id?>"></a>

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