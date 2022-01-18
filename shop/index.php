<?php 

include "../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . 'public/template-parts/header.php'; 

$productMgr = new ProductManager();
$productCategoryMgr = new ProductCategoryManager();
$categoryItemMgr = new CategoryItemManager();
$categoryMgr = new CategoryManager();
$imgMgr = new ImgManager();
$reviewMgr = new ReviewManager();
$wishlistMgr = new WishlistManager();


if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $searchCategory = $productCategoryMgr->search($search);

    if ($searchCategory[0]['id'] != 0) {
        $products = $searchCategory;
    }
} else {
    $products = $productMgr->getAll();
}

$lavanda = $productCategoryMgr->getByCategory("lavanda");
$lavandaNumber = $productCategoryMgr->getNumberOf("lavanda");
$most = $productCategoryMgr->getMostPurchased();
$cura = $productCategoryMgr->getByCategory("Cura della persona");
$curaNumber = $productCategoryMgr->getNumberOf("Cura della persona");
$idee = $productCategoryMgr->getByCategory("Idee regalo");
$ideeNumber = $productCategoryMgr->getNumberOf("Idee regalo");
$redirect = ROOT_URL . 'shop/single-product.php?product=';

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('index.html', [
    'ROOT_URL' => ROOT_URL,
    'products' => $products,
    'lavanda' => $lavanda,
    'lavandaNumber' => $lavandaNumber[0]['number'],
    'most' => $most,
    'cura' => $cura,
    'curaNumber' => $curaNumber[0]['number'],
    'idee' => $idee,
    'ideeNumber' => $ideeNumber[0]['number'],
    'redirect' => $redirect
]);

include ROOT_PATH . 'public/template-parts/footer.php';