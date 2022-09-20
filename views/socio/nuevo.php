<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Nuevo usuario</h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/socio/store" onsubmit="alertToast();">
  <div class="col-md-6">
    <label for="dni" class="form-label">DNI</label>
    <input type="text" class="form-control" id="dni" name="dni" required>
  </div>
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre" required>
  </div>
  <div class="col-12">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos" required>
  </div>
  <div class="col-md-4">
    <label for="nacimiento" class="form-label">Fecha Nacimiento</label>
	<input type="date" class="form-control" id="nacimiento" name="nacimiento" required>
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">EMail</label>
    <input type="email" class="form-control" id="email" name="email" required>
  </div>
  <div class="col-md-6">
    <label for="direccion" class="form-label">Dirección</label>
    <input type="text" class="form-control" id="direccion" name="direccion" required>
  </div>
  <div class="col-md-4">
    <label for="poblacion" class="form-label">Población</label>
	<input type="text" class="form-control" id="poblacion" name="poblacion" required>
  </div>
  <div class="col-md-2">
    <label for="provincia" class="form-label">Provincia</label>
    <input type="text" class="form-control" id="provincia" name="provincia" required>
  </div>
  <div class="col-md-2">
    <label for="cp" class="form-label">Código Postal</label>
    <input type="text" class="form-control" id="cp" name="cp" required>
  </div>
  <div class="col-md-2">
    <label for="telefono" class="form-label">Telefóno</label>
    <input type="text" class="form-control" id="telefono" name="telefono">
  </div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary" name="guardar" value="guardar">CREAR</button>
	<button type="reset" class="btn btn-secondary">BORRAR</button>

  </div>
</form>

</div>

		
		<!-- <form class="datos" method="post" action="/socio/store">
			<label>SOCIO</label>
			<input type="text" name="socio">
			<br>
			
			
			<label>Nombre</label>
			<input type="text" name="nombre">
			<br>
			<label>Primer apellido</label>
			<input type="text" name="apellidos">
			<br>
			
			<label>Email</label>
			<input type="email" name="email">
			<br>

            <label>Telefono</label>
			<input type="telefono" name="telefono">
			<br>

            <label>Direccion</label>
			<input type="direccion" name="direccion">
			<br>

            <label>Población</label>
			<input type="poblacion" name="poblacion">
			<br>

            <label>Provincia</label>
			<input type="provincia" name="provincia">
			<br>
			
			<input type="submit" name="guardar" value="Guardar">
		</form> -->
		<br>
		
		<div class="centrado">
			<a href="/">Volver a la portada</a>
    		<?php if(Login::isAdmin()){?>
    			- <a href="/usuario/list">Lista de usuarios</a>
    		<?php }?>
		</div>
		<br>
<?php
Basic::getFooter();
?>