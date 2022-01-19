<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Prodotti</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php
    $productMgr = new ProductManager();
    $manufacturerMgr = new ManufacturerManager();

    $products = $productMgr->getProductOrderByStock();

    $man = array();

    foreach($products as $product){
        $manufacture = $manufacturerMgr->get($product['manufacturer_id']);
        array_push($man,$manufacture);
    }

    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/product/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('product.html', [
        'ROOT_URL' => ROOT_URL,
        'products' => $products,
        'manufacture' => $man
        
    ]);
?>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>