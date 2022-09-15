<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>
<h2>Nuevo usuario</h2>
		
		<form class="datos" method="post" action="/socio/store">
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
		</form>
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