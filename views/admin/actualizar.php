<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Actualizar el usuario <?= $usuario->id ?></h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/usuario/update/<?= $usuario->id ?>" >
<div class="col-md-6">
    <label for="usuario" class="form-label">NickName</label>
    <input type="text" class="form-control" id="usuario" name="usuario" placeholder="<?= $usuario->usuario ?>" >
  </div>
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="<?= $usuario->nombre ?>" >
  </div>
  <div class="col-12">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="<?= $usuario->apellidos ?>" >
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">EMail</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="<?= $usuario->email ?>" >
  </div>
  <div class="col-md-6">
    <label for="clave" class="form-label">CLAVE</label>
    <input type="password" class="form-control" id="clave" name="clave" >
  </div>
  <div class="col-md-4">
    <label for="privilegio" class="form-label">PRIVILEGIO</label>
	<input type="text" class="form-control" id="privilegio" name="privilegio" placeholder="<?= $usuario->privilegio ?>" >
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="administrador" value="" id="administrador">
    <label class="form-check-label" for="administrador">
      ADMINISTRADOR
    </label>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="actualizar" value="actualizar">ACTUALIZAR</button>
  </div>
</form>
<form action='/usuario/destroy/<?=$usuario->id ?>' method='post'>
    <input type='hidden' class='form-control' name='id' value="<?= $usuario->id ?>">
    <button type="submit" class="btn btn-danger" name="eliminar" value="eliminar">BORRADO DEFINITIVO DEL USUARIO</button>
  </form>

</div>
<?php
Basic::getFooter();
?>