<?php
Basic::getHead('TODOS LOS USUARIOS');
Basic::getHeader();
?>
<!-- content -->
<div class="container">
<h2 class="h2 mx-auto">LISTADO DE USUARIOS</h2>
</div>
<div class="container">
  <a href="/usuario/create"><button class="btn btn-primary mb-3">AÑADIR USUARIO</button></a>
</div>
<div class="container">
<table class="table table-striped" id="sociosTable">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">USUARIO</th>
      <th scope="col">Email</th>
      
      <th scope="col">Privilegio</th>
      <th scope="col">Administrador</th>
      <th scope="col">Creado</th>
      <th scope="col"></th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($usuarios as $usuario){
        echo "     
            <tr>
                <th scope='row'>$usuario->id</th>
                <td><a href='/usuario/show/$usuario->id'>$usuario->nombre $usuario->apellidos</a></td>
                <td>$usuario->email </td>
                <td>$usuario->privilegio</td>
                <td>$usuario->administrador</td>
                <td>$usuario->created_at</td>
                <td>
                  <a href='/usuario/show/$usuario->id'><button type='button' class='btn btn-primary'>VER</button></a>
                  <a href='/usuario/edit/$usuario->id'><button type='button' class='btn btn-warning'>EDITAR</button></a>
                </td>
                </a>
            </tr>   
        ";
    }
    ?>
    
  </tbody>
</table>
</div>
<script>
  $(document).ready(function () {
    $('#sociosTable').DataTable();
});
</script>
<?php
Basic::getFooter();
?>