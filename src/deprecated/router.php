<?php
// deprecated ********************||||||||*****{}[[≈ıˆ˜†‡•±—¿]]
$routes = [];
$rootFolder = basename(__DIR__); // for this to work, router.php needs to be directly in root directory
// if ($request == '/' || $request == '') {
//     require __DIR__ . '/home_view/index.php';
// } elseif ($request == "answers") {
//     # code...
// }
// switch ($request) {
//     case '/' :
//         require __DIR__ . '/home_view/index.php';
//         break;
//     case '' :
//         require __DIR__ . '/home_view/index.php';
//         break;
//     case '/about' :
//         require __DIR__ . '/views/about.php';
//         break;
//     default:
//         http_response_code(404);
//         require __DIR__ . '/error.php';
//         break;
// }
route("/", function () {
    
})

function route(string $path, callable $callback) {
    global $routes;
    $routes[$path] = $callback;
}

// run();

function run() {
    global $routes;
    $uri = $_SERVER['REQUEST_URI'];
    foreach ($routes as $path => $callback) {
        if ($path !== $uri) {continue;}
        $callback();
    }
}