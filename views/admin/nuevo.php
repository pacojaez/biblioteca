<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Nuevo usuario</h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/usuario/store">
<div class="col-md-6">
    <label for="usuario" class="form-label">Nick Name</label>
    <input type="text" class="form-control" id="usuario" name="usuario">
  </div>
  <div class="col-md-6">
    <label for="nombre" class="form-label">Nombre</label>
    <input type="text" class="form-control" id="nombre" name="nombre">
  </div>
  <div class="col-12">
    <label for="apellidos" class="form-label">Apellidos</label>
    <input type="text" class="form-control" id="apellidos" name="apellidos">
  </div>
  <div class="col-12">
    <label for="inputAddress2" class="form-label">EMail</label>
    <input type="email" class="form-control" id="email" name="email">
  </div>
  <div class="col-md-6">
    <label for="clave" class="form-label">Clave</label>
    <input type="password" class="form-control" id="clave" name="clave">
  </div>
  <div class="col-md-4">
    <label for="privilegio" class="form-label">Privilegio</label>
	<input type="number" class="form-control" id="privilegio" name="privilegio">
  </div>
  <div class="form-check">
    <input class="form-check-input" type="checkbox" name="administrador" value="" id="administrador">
    <label class="form-check-label" for="administrador">
      ADMINISTRADOR
    </label>
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