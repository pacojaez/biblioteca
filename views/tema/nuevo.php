<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Nuevo tema</h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/tema/store">
  <div class="col-md-6">
    <label for="tema" class="form-label">TEMA</label>
    <input type="text" class="form-control" id="tema" name="tema" required>
  </div>
  <div class="col-md-6">
    <label for="descripcion" class="form-label">DESCRIPCIÓN</label>
    <input type="text" class="form-control" id="descripcion" name="descripcion" required>
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="guardar" value="guardar">CREAR</button>
	<button type="reset" class="btn btn-secondary">BORRAR</button>
  </div>
</form>

</div>
<?php
Basic::getFooter();
?>