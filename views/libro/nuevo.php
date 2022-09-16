<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2 class="mx-auto">Nuevo Libro</h2>
<div class="container m-5">
<form class="row g-3" method="post" action="/libro/store">
  <div class="col-md-6">
    <label for="titulo" class="form-label">TÍTULO</label>
    <input type="text" class="form-control" id="titulo" name="titulo">
  </div>
  <div class="col-12">
    <label for="autor" class="form-label">AUTOR</label>
    <input type="text" class="form-control" id="autor" name="autor">
  </div>
  <div class="col-md-4">
    <label for="editorial" class="form-label">EDITORIAL</label>
	<input type="text" class="form-control" id="editorial" name="editorial">
  </div>
  <div class="col-12">
    <label for="edadrecomendada" class="form-label">Edad Recomendada</label>
    <input type="text" class="form-control" id="edadrecomendada" name="edadrecomendada">
  </div>
  <div class="col-md-6">
    <label for="ediciones" class="form-label">EDICIONES</label>
    <input type="text" class="form-control" id="ediciones" name="ediciones">
  </div>
  <div class="col-md-6">
    <label for="isbn" class="form-label">ISBN</label>
    <input type="text" class="form-control" id="isbn" name="isbn">
  </div>
  <div class="col-md-6">
    <label for="idioma" class="form-label">IDIOMA</label>
    <input type="text" class="form-control" id="idioma" name="idioma">
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