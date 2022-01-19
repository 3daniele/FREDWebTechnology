<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Recensioni</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php 
    $reviewMgr = new ReviewManager();
    $productMgr = new ProductManager();
    $userMgr = new UserManager();

    $reviews = $reviewMgr->getAllOrder();

    $products = array();
    $utenti = array();

    foreach($reviews as $review){
        $product = $productMgr->getName($review['product_id']);
        array_push($products, $product[0]['name']);

        $users = $userMgr->getName($review['user_id']);
        $user = $userMgr->getSurname($review['user_id']);
        $stampa = $users[0]['name'].", ".$user[0]['surname'];
        array_push($utenti, $stampa);
    }

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/review/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('review.html', [
    'ROOT_URL' => ROOT_URL,
    'reviews' => $reviews,
    'products' => $products,
    'users' => $utenti
    
]);
?>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>