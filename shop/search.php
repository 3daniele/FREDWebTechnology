<?php
include "../inc/init.php";

if($_SERVER['REQUEST_URI'] == "/FREDWebTechnology/shop/search.php?search="){
    header("Location: ".ROOT_URL);
}else{
    
    include ROOT_PATH . "public/template-parts/title.php";
    
    echo "<title>Ricerca</title>";
    
    include ROOT_PATH . 'public/template-parts/header.php';
    
    include ROOT_PATH . 'shop/searchBar.php';
    
    if (isset($_GET["search"])) {
        $_SESSION['search'] = $_GET["search"];
    
    }
    
    $categorie = array();
    
    if (isset($_POST["selezionato"])) {
        $all = $_POST["selezionato"];
        foreach ($all as $i)
            array_push($categorie, $i);
    }
    
    $search = $_SESSION['search'];
    
    $categoryMgr = new CategoryManager();
    
    $category = $categoryMgr->getAll();
    
    $productCategoryMgr = new ProductCategoryManager();
    $products = $productCategoryMgr->search($search); //ricerca tramite nome cercato
    
    $provvisori = array();
    foreach ($categorie as $cat) {
        array_push($provvisori, $productCategoryMgr->search($cat));
    }
    
    
    foreach ($provvisori as $p) {
        foreach ($p as $a) {
            if (!in_array($a, $products)) {
                array_push($products, $a);
            }
        }
    }
    
    
    $imgMgr = new ImgManager();
    $img = array();
    
    $loader = new \Twig\Loader\FilesystemLoader('../templates/shop');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('search.html', [
        'ROOT_URL' => ROOT_URL,
        'search' => $search,
        'product' => $products,
        'selected' => $categorie,
        'category' => $category,
        //'provvisori' => $provvisori,
        'redirect' => ROOT_URL . "shop/single-product.php?product=",
        'REQUEST_URI' => $_SERVER['REQUEST_URI']
    ]);
    
    include ROOT_PATH . 'public/template-parts/footer.php';
    
}
