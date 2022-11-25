<?php

$request = $_SERVER['REQUEST_URI'];

if ($request == '/' || $request == '') {
    require __DIR__ . '/home_view/index.php';
} elseif ($request == "answers") {
    # code...
}
switch ($request) {
    case '/' :
        require __DIR__ . '/home_view/index.php';
        break;
    case '' :
        require __DIR__ . '/home_view/index.php';
        break;
    case '/about' :
        require __DIR__ . '/views/about.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/error.php';
        break;
}