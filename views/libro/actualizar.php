<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Actualizar el libro <?= $libro->id ?></h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/libro/update/<?= $libro->id ?>">
  <div class="col-md-6">
    <label for="titulo" class="form-label">TÍTULO</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="<?= $libro->titulo ?>" />
  </div>
  <div class="col-md-6">
    <label for="autor" class="form-label">Autor</label>
    <input type="text" class="form-control" id="autor" name="autor" placeholder="<?= $libro->autor ?>" >
  </div>
  <div class="col-12">
    <label for="editorial" class="form-label">Editorial</label>
    <input type="text" class="form-control" id="editorial" name="editorial" placeholder="<?= $libro->editorial ?>" >
  </div>
  <div class="col-md-4">
    <label for="idioma" class="form-label">Idioma</label>
	<input type="date" class="form-control" id="idioma" name="idioma" value="<?= $libro->idioma ?>" >
  </div>
  <div class="col-12">
    <label for="ediciones" class="form-label">EMail</label>
    <input type="text" class="form-control" id="ediciones" name="ediciones" placeholder="<?= $libro->ediciones ?>" >
  </div>
  <div class="col-md-6">
    <label for="edadrecomendada" class="form-label">Edad Recomendada</label>
    <input type="text" class="form-control" id="edadrecomendada" name="edadrecomendada" placeholder="<?= $libro->edadrecomendada ?>" >
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="actualizar" value="actualizar">ACTUALIZAR</button>
  </div>
</form>

</div>
<?php
Basic::getFooter();
?>