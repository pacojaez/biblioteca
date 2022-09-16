<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>


<div class="container-fluid">
<div class="card mx-auto" style="width: 36rem;">
  <div class="card-body">
    <h2 class="card-title h2"><?php echo "$socio->nombre $socio->apellidos"; ?></h2>
    <h4 class="card-subtitle mb-2 text-muted h4">DNI: <?php echo "$socio->dni" ?></h4>
    <p class="card-text">Población: <?php echo "$socio->poblacion " ?> 
  </div>
  <?php
    if($prestamos){
        echo "<h2 class='card-subtitle h2'>PRESTAMOS SIN DEVOLVER ($totalSinDevolver)</h2>";
        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach($prestamos as $prestamo){
              
            echo "<div class='accordion-item'>
                <h2 class='accordion-header' id='flush-heading$prestamo->id'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$prestamo->id' aria-expanded='false' aria-controls='flush-collapse$prestamo->id'>
                        Prestamo #id: $prestamo->id
                        <br>
                        Libro: $prestamo->titulo
                        <br>
                        Vencimiento: $prestamo->limite 
                    </button>

                    <!-- Modal devolver PRESTAMO -->
                    <div class='modal fade' id='actualizarPrestamo$prestamo->id' tabindex='-1' aria-labelledby='actualizarPrestamoLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                            <h5 class='modal-title' id='actualizarPrestamoLabel$prestamo->id'>Vas devolver el prestamo # $prestamo->id del socio $socio->id </h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                            <form action='/prestamo/actualizarPrestamo/$prestamo->id' method='post'>
                                <input type='hidden' class='form-control' name='id' value='$prestamo->id' >
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='submit' name='devolver' value='devolver' class='btn btn-primary mx-auto' data-bs-toggle='modal' data-bs-target='#actualizarPrestamo$prestamo->id'>DEVOLV PRESTAMO</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </h2>
                <div id='flush-collapse$prestamo->id' class='accordion-collapse collapse bg-secondary bg-gradient' aria-labelledby='flush-heading$prestamo->id' data-bs-parent='#accordionFlushExample'>
                    <div class='accordion-body text-light'>Fecha Prestamo: $prestamo->prestamo Límite: $prestamo->limite  </div>
                    <button type='button' class='btn btn-primary m-auto' data-bs-toggle='modal' data-bs-target='#actualizarPrestamo$prestamo->id'>
                        DEVOLVER PRESTAMO
                    </button>
                </div>
            </div>";
            }
            echo "</div'>";
        }else{
            echo "<h3>Este socio no tiene prestamos sin devolver</h3>";
        }
    ?>

<?php
    if($historicoPrestamos){
        echo "<h2 class='card-subtitle h2'>HISTÓRICO DE PRESTAMOS ($totalPrestamos)</h2>";
        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach($historicoPrestamos as $prestamo){   
            echo "<div class='accordion-item'>
                <h2 class='accordion-header' id='flush-heading$prestamo->id'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse$prestamo->id' aria-expanded='false' aria-controls='flush-collapse$prestamo->id'>
                        Prestamo #id= $prestamo->id
                        <br>
                        Libro: $prestamo->titulo
                        <br>
                        Vencimiento: $prestamo->limite 
                    </button>

                    <!-- Modal borrar PRESTAMO -->
                    <div class='modal fade' id='destroyEjemplar$prestamo->id' tabindex='-1' aria-labelledby='actualizarPrestamoLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                            <h5 class='modal-title' id='destroyEjemplarLabel$prestamo->id'>Vas a borrar el prestamo # $prestamo->id del socio $socio->id </h5>
                            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                            <h5 class='modal-title' id='destroyEjemplarLabel$prestamo->id'>Esta acción es irreversible, ¿estás seguro? </h5>
                            <form action='/prestamo/destroy/$prestamo->id' method='post'>
                                <input type='hidden' class='form-control' name='id' value='$prestamo->id' >
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Cerrar</button>
                                <button type='submit' class='btn btn-danger mx-auto' data-bs-toggle='modal' data-bs-target='#actualizarPrestamo$prestamo->id'>CANCELAR PRESTAMO</button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                    </h2>
                <div id='flush-collapse$prestamo->id' class='accordion-collapse collapse bg-secondary bg-gradient' aria-labelledby='flush-heading$prestamo->id' data-bs-parent='#accordionFlushExample'>
                    <div class='accordion-body text-light'>Fecha Prestamo: $prestamo->prestamo Límite: $prestamo->limite </div>
                    <div class='accordion-body text-light'>Devolución: $prestamo->devolucion </div>
                    <button type='button' class='btn btn-danger mx-auto' data-bs-toggle='modal' data-bs-target='#destroyEjemplar$prestamo->id'>
                        ELIMINAR PRESTAMO
                    </button>
                </div>
            </div>";
            }
            echo "</div'>";
        }else{
            echo "<h3>Este socio no tiene histórico de prestamos</h3>";
        }
    ?>
</div>
</div>
</div>
<?php
Basic::getFooter();
?>