<?php 
include "../../inc/init.php";

include ROOT_PATH . "public/template-parts/title.php"; 

include ROOT_PATH . "public/template-parts/header.php"; 

$imgMgr = new ImgManager();
$productMgr = new ProductManager();
$wishlistMgr = new WishlistManager();

$elements = $wishlistMgr->countElementByUser($_SESSION["userid"]);
$count = $elements[0]['countid'];

if (isset($_SESSION['email'])) {
    $user = $_SESSION['name'];
}

$items = $wishlistMgr->getByUserId($_SESSION["userid"]);

for ($i = 0; $i < count($items); $i++) {
    $products[] = $productMgr->get($items[$i]['product_id']);
    $imgs[] = $imgMgr->get_thumbnail($products[$i]->id);
}
             
$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/shop');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('wishlist.html', [
    'ROOT_URL' => ROOT_URL,
    'user' => $user,
    'count' => $count,
    'products' => $products,
    'imgs' => $imgs
]);
                        
include ROOT_PATH . "public/template-parts/footer.php"; 