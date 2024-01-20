<?php

    $directAccess = true;

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $action = $_POST['action'] ?? null;

        if (in_array($action, ['add', 'del'])) {

            $directAccess = false;

            $check = $_POST['check'] ?? 'php';
            if ($check != 'js') {
                exit(json_encode([
                    'status' => 'error',
                    'error' => 'Ошибка, попробуйте позднее'
                ]));
            }

            define("IN_ENGINE", true);
            include __DIR__ . '/../core/engine.php';

            if ($action == 'add') {
                exit(json_encode(Product::add()));
            }

            if ($action == 'del') {
                exit(json_encode(Product::del()));
            }

        }

    }

    if ($directAccess) {
        die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
    }
