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

$imgs = $imgMgr->getAll();
$categories = $categoryMgr->getAll();
$categoryItems = $categoryItemMgr->getAll();
$reviews = $reviewMgr->getAll();
$creme = $productCategoryMgr->getByCategory("creme");
$cremeNumber = $productCategoryMgr->getNumberOf("creme");
$most = $productCategoryMgr->getMostPurchased();

$loader = new \Twig\Loader\FilesystemLoader('../templates');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('index.html', [
    'username' => $_SESSION['name'],
    'ROOT_URL' => ROOT_URL,
    'products' => $products,
    'imgs' => $imgs,
    'categories' => $categories,
    'categoryItems' => $categoryItems,
    'reviews' => $reviews,
    'creme' => $creme,
    'cremeNumber' => $cremeNumber[0]['number'],
    'most' => $most
]);

include ROOT_PATH . 'public/template-parts/footer.php';