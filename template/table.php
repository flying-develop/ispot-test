<?php

if (!defined('IN_ENGINE')) {
    die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
}

?>

<div class="container container-fluid" style="margin-bottom: 2rem;">
    <h2>Товары</h2>
    <table class="table table-hover products">
        <thead>
            <tr>
                <th scope="col" class="articul">Артикул</th>
                <th scope="col" class="name">Название</th>
                <th scope="col" class="action"></th>
            </tr>
        </thead>
        <tbody>
            <?php if ($data ?? []): ?>
                <?php foreach ($data as $row): ?>
                    <tr data-id="<?php echo $row['id']; ?>">
                        <td class="articul"><?php echo $row['articul']; ?></td>
                        <td class="name"><?php echo $row['name']; ?></td>
                        <td class="action">
                            <button type="button" class="btn btn-secondary del-product" title="Удалить товар">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"></path>
                                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>