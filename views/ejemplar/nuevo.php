<?php
Basic::getHead('TODOS LOS LIBROS');
Basic::getHeader();
?>



<form action="/ejemplar/store" method="post" onsubmit="alertToast();">
    <input type="hidden" class="form-control" name="idlibro" value='<?php echo "$libro->id"; ?>' >

    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">AÑO</span>
        <input type="number" class="form-control" name="anyo">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">EDICIÓN</span>
        <input type="number" class="form-control" name="edicion">
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">PRECIO</span>
        <input type="number" class="form-control" name="precio">
    </div>
    <button type="submit" value="guardar"class="btn btn-primary">GUARDAR</button>
</form>

<?php
Basic::getFooter();
?>