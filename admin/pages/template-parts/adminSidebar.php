<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>
<?php
$request = $_SERVER['REQUEST_URI'];

if (substr($_SERVER['REQUEST_URI'], 0, 37) == "/FREDWebTechnology/admin/pages/order/"){
    $request = substr($_SERVER['REQUEST_URI'], 0, 37);
}

if (substr($_SERVER['REQUEST_URI'], 0, 39) == "/FREDWebTechnology/admin/pages/product/"){
    $request = substr($_SERVER['REQUEST_URI'], 0, 39);
}

if (substr($_SERVER['REQUEST_URI'], 0, 39) == "/FREDWebTechnology/admin/pages/support/"){
    $request = substr($_SERVER['REQUEST_URI'], 0, 39);
}

if (substr($_SERVER['REQUEST_URI'], 0, 39) == "/FREDWebTechnology/admin/pages/message/"){
    $request = substr($_SERVER['REQUEST_URI'], 0, 39);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/public/template-parts/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('sidebarAdmin.html', [
    'ROOT_URL' => ROOT_URL,
    'request' => $request
     
]);
?>