<?php

ini_set('display_errors', 1);

if (isset($_SERVER['REDIRECT_URL'])){
    $request = $_SERVER['REDIRECT_URL'];
} else {
    $request = '';
}


switch ($request) {
    case '' :
        require __DIR__ . '/controller/main.php';
        break;

    case '/technical' :
        require __DIR__ . '/controller/technical.php';
        break;
    default:
        $meta_title = '404!';
        require __DIR__ . '/controller/404.php';
        break;
}
?>