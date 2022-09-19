<?php
Basic::getHead('TODOS LOS USUARIOS');
Basic::getHeader();
?>

<div class="container-fluid">
    <div class="card mx-auto" style="width: 36rem;">
        <div class="card-body">
            <h2 class="card-title h2"><?php echo "$usuario->nombre $usuario->apellidos"; ?></h2>
            <h4 class="card-subtitle mb-2 text-muted h4">PRIVILEGIO: <?php echo "$usuario->privilegio" ?></h4>
            <p class="card-text">ADMIN: <?php echo "$usuario->administrador " ?>
        </div>
        <div class="card-body">
            <!-- Button actualizar usuario -->
            <a href="/usuario/edit/<?=$usuario->id ?>">
                <button type="button" class="btn btn-secondary">
                    ACTUALIZAR USUARIO
                </button>
            </a>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#borrarSocio">
                ELIMINAR USUARIO
            </button>
            <!-- Modal -->
            <div class="modal fade" id="borrarSocio" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="borrarSocioLabel">BORRAR USUARIO</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <h4 class="modal-subtitle" id="borrarSocioLabel">Esta acción es irreversible. ¿Estás Seguro? </h4>
                                <form action='/usuario/destroy/<?=$usuario->id ?>' method='post'>
                                    <input type='hidden' class='form-control' name='id' value="<?= $usuario->id ?>">
                                    <button type="submit" class="btn btn-danger" name="eliminar" value="eliminar">BORRADO DEFINITIVO DEL USUARIO</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
    </div>
</div>
<?php
Basic::getFooter();
?>