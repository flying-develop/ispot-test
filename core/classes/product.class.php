<?php

if (!defined('IN_ENGINE')) {
    die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
}

class Product
{

    public static function rows() : array
    {
        $database = new Database();
        return $database->products();
    }

    public static function add(): array
    {
        $database = new Database();
        return $database->newProduct([
            'articul' => $_POST['articul'] ?? null,
            'name' => $_POST['name'] ?? null,
        ]);
    }

    public static function del(): array
    {
        $database = new Database();
        return $database->deleteProduct($_POST['id'] ?? 0);
    }

}