<?php
Basic::getHead('TODOS LOS SOCIOS');
Basic::getHeader();
?>
<!-- content -->
<div class="container">
<h2 class="h2 mx-auto">LISTADO DE SOCIOS</h2>
</div>
<div class="container">
  <a href="/socio/create"><button class="btn btn-primary mb-3">AÑADIR SOCIO</button></a>
</div>
<div class="container">
<table class="table table-striped" id="sociosTable">
<thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">DNI</th>
      <th scope="col">SOCIO</th>
      <th scope="col">Email</th>
      <th scope="col">Teléfono</th>
      <th scope="col">Dirección</th>
      <th scope="col">Población</th>
      <th scope="col">Provincia</th>
      <th scope="col">Código Postal</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($socios as $socio){
        echo "     
            <tr>
                <th scope='row'>$socio->id</th>
                <td><a href='/socio/show/$socio->id'>$socio->dni</a></td>
                <td>$socio->nombre $socio->apellidos</td>
                <td>$socio->email</td>
                <td>$socio->telefono</td>
                <td>$socio->direccion</td>
                <td>$socio->poblacion</td>
                <td>$socio->provincia</td>
                <td>$socio->cp</td>
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