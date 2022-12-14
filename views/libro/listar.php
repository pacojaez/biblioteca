<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>

<!-- content -->
<div class="container">
<h2 class="h2 mx-auto">LISTADO DE LIBROS</h2>

<?php if(Login::isAdmin() || Login::hasPrivilege(300)){?>
<a href="/libro/create"><button class="btn btn-primary">CREAR NUEVO LIBRO</button></a>
<?php }?>

<?php if(Login::isAdmin() || Login::hasPrivilege(300)){?>
<a href="/tema/create"><button class="btn btn-secondary">CREAR NUEVO TEMA</button></a>
<?php }?>

</div>
<div class="container">
<table class="table table-striped" id="librosTable">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Titulo</th>
      <th scope="col">Autor</th>
      <th scope="col">ISBN</th>
      <th scope="col">Editorial</th>
      <th scope="col">Ediciones</th>
      <th scope="col">Edad Recomendada</th>
      <th scope="col">Idioma</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($libros as $libro){
        echo "     
            <tr>
                <th scope='row'>$libro->id</th>
                <td><a href='/libro/show/$libro->id'>$libro->titulo</a></td>
                <td>$libro->autor</td>
                <td>$libro->isbn</td>
                <td>$libro->editorial</td>
                <td>$libro->ediciones</td>
                <td>$libro->edadrecomendada</td>
                <td>$libro->idioma</td>
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
    $('#librosTable').DataTable();
});
</script>


<?php
Basic::getFooter();
?>