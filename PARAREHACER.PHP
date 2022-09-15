<div class='mb-3'>
        <label for='exampleInputEmail1' class='form-label'>Campo</label>
        <select class='form-select' aria-label='Default select example'>
            <option value='titulo' <?= !empty($campo) && $campo == 'titulo' ? 'selected' : '' ?>>Título</option>
            <option value='isbn' <?= !empty($campo) && $campo == 'isbn' ? 'selected' : '' ?>>ISBN</option>
            <option value='editorial' <?= !empty($campo) && $campo == 'editorial' ? 'selected' : '' ?>>Editorial</option>
            <option value='autor' <?= !empty($campo) && $campo == 'autor' ? 'selected' : '' ?>>Autor</option>
        </select>
        <label for='exampleInputEmail1' class='form-label'>Email address</label>
        <input type='text' class='form-control' id='valor' name='valor' aria-describedby='valorHelp'>
        <div id='valorHelp' class='form-text'>Escribe tu búsqueda.</div>
    </div>