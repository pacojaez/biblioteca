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
        <div class="card-body">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#añadirPrestamo">
                AÑADIR PRÉSTAMO
            </button>
            <!-- Modal añadir prestamo-->
            <div class="modal fade" id="añadirPrestamo" tabindex="-1" aria-labelledby="añadirPrestamoLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="añadirPrestamoLabel">NUEVO PRÉSTAMO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action='/prestamo/crear' method='post' onsubmit="alertToast();">
                                <input type='hidden' class='form-control' name='idsocio' value="<?= $socio->id ?>">
                                <label for="limite" class="form-label">Fecha límite devolución</label>
                                <input type='date' class='form-control' name='limite' value="limite">
                                <label for="idejemplar" class="form-label">ID del Ejemplar</label>
                                <input type='text' class='form-control' name='idejemplar' value="idejemplar" >
                                <button type="submit" class="btn btn-primary" name="guardar" value="guardar">Añadir Prestamo</button>
                            </form>
                        </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
            <a href="/socio/edit/<?=$socio->id ?>">
                <button type="button" class="btn btn-secondary">
                    ACTUALIZAR SOCIO
                </button>
            </a>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrarSocio">
                    BORRAR SOCIO
                </button>
                <!-- Modal borrar socio -->
                <div class="modal fade" id="borrarSocio" tabindex="-1" aria-labelledby="borrarSocioLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="borrarSocio">BORRAR SOCIO</h5>
                                
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                            <h4 class="modal-subtitle" id="borrarSocioLabel">Esta acción es irreversible. ¿Estás Seguro? </h4>
                                <form action='/socio/destroy/<?=$socio->id ?>' method='post' onsubmit="alertToast();">
                                    <input type='hidden' class='form-control' name='idsocio' value="<?= $socio->id ?>">
                                    <button type="submit" class="btn btn-danger" name="eliminar" value="eliminar">BORRADO DEFINITIVO DEL SOCIO</button>
                                </form>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            
                        </div>
                    </div>
                </div>

                <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#prestamoModal">
                    AÑADIR PRESTAMO
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="prestamoModal" tabindex="-1" aria-labelledby="prestamoModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="prestamoModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                        </div>
                    </div>
        </div>
    </div>
    <?php
    if ($prestamos) {
        echo "<h2 class='card-subtitle h2'>PRESTAMOS SIN DEVOLVER ($totalSinDevolver)</h2>";
        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach ($prestamos as $prestamo) {

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
                            <form action='/prestamo/actualizarPrestamo/$prestamo->id' method='post' onsubmit='alertToast();'>
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
                    <div class='accordion-body text-light'>Fecha Prestamo: $prestamo->prestamo </div>
                    <div class='accordion-body text-light'>Límite: $prestamo->limite  </div>
                    <button type='button' class='btn btn-primary m-auto' data-bs-toggle='modal' data-bs-target='#actualizarPrestamo$prestamo->id'>
                        DEVOLVER PRESTAMO
                    </button>
                </div>
            </div>";
        }
        echo "</div'>";
    } else {
        echo "<h3>Este socio no tiene prestamos sin devolver</h3>";
    }
    ?>

    <?php
    if ($historicoPrestamos) {
        echo "<h2 class='card-subtitle h2'>HISTÓRICO DE PRESTAMOS ($totalPrestamos)</h2>";
        echo "<div class='accordion accordion-flush' id='accordionFlushExample'>";
        foreach ($historicoPrestamos as $prestamo) {
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
                            <form action='/prestamo/destroy/$prestamo->id' method='post' onsubmit='alertToast();'>
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
    } else {
        echo "<h3>Este socio no tiene histórico de prestamos</h3>";
    }
    ?>
</div>
</div>
</div>
<?php
Basic::getFooter();
?>