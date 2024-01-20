<?php

if (!defined('IN_ENGINE')) {
    die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
}

?>

<div class="container container-fluid" style="margin-top: 2rem; margin-bottom: 2rem;">
    <h2>Создать товар</h2>
    <form action="#" method="GET" class="add-product-form">
        <div class="mb-3">
            <label for="product-articul" class="form-label">Артикул</label>
            <input type="text" class="form-control" name="articul" required id="product-articul"/>
        </div>
        <div class="mb-3">
            <label for="product-name" class="form-label">Название</label>
            <input type="text" class="form-control" name="name" required id="product-name"/>
        </div>
        <button type="submit" class="btn btn-primary">
            <span class="text">Добавить</span>
            <span class="spinner-border" role="status" aria-hidden="true"></span>
        </button>
        <input type="hidden" name="action" value="add"/>
        <input type="hidden" name="check" value="php"/>
    </form>
</div>
