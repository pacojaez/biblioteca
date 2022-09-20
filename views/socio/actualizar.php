<?php
Basic::getHead('TODOS LOS SOCIOS');
Basic::getHeader();
?>
<h2 class="mx-auto">Actualizar el SOCIO <?= $socio->id ?></h2>
<?php
include ('../views/components/toast.php');
?>
<div class="container m-5">
<form class="row g-3" method="post" action="/socio/update/<?= $socio->id ?>" onsubmit="alertToast();"> 
  <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" class="form-control" id="dni" name="dni" placeholder="<?= $socio->dni ?>" />
  </div>
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="<?= $socio->nombre ?>" >
  </div>
  <div class="col-12">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="<?= $socio->apellidos ?>" >
  </div>
  <div class="col-md-4">
    <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
	<input type="date" class="form-control" id="nacimiento" name="nacimiento" value="<?= $socio->nacimiento ?>" >
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">EMail</label>
    <input type="email" class="form-control" id="email" name="email" placeholder="<?= $socio->email ?>" >
  </div>
  <div class="col-md-6">
    <label for="direccion" class="form-label">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" placeholder="<?= $socio->direccion ?>" >
  </div>
  <div class="col-md-4">
    <label for="poblacion" class="form-label">Población</label>
	<input type="text" class="form-control" id="poblacion" name="poblacion" placeholder="<?= $socio->poblacion ?>" >
  </div>
  <div class="col-md-2">
    <label for="provincia" class="form-label">Provincia</label>
    <input type="text" class="form-control" id="provincia" name="provincia" placeholder="<?= $socio->provincia ?>" >
  </div>
  <div class="col-md-2">
    <label for="cp" class="form-label">Código Postal</label>
    <input type="text" class="form-control" id="cp" name="cp" placeholder="<?= $socio->cp ?>" >
  </div>
  <div class="col-md-2">
    <label for="telefono" class="form-label">Telefóno</label>
    <input type="text" class="form-control" id="telefono" name="telefono" placeholder="<?= $socio->telefono ?>" >
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="actualizar" value="actualizar">ACTUALIZAR</button>
  </div>
</form>

</div>
<?php
Basic::getFooter();
?>