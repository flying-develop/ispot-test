<?php

if (!defined('IN_ENGINE')) {
    die('<b>Error.</b> Script ' . $_SERVER['PHP_SELF'] . ' cannot be runned directly');
}

mb_internal_encoding('UTF-8');

require __DIR__ . '/config.php';
require __DIR__ . '/classes/db.class.php';
require __DIR__ . '/classes/product.class.php';