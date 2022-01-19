<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["product"] == null || $_SESSION["admin"] == 1 || !isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL . "admin/index.php");
}

$productid = $_GET["product"];
?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>

<?php $productmgr = new ProductManager();
$product = $productmgr->get($productid);

if ($product->name == "") {
    header("Location: " . ROOT_URL);
}

?>



<title>Modifica:<?php echo " " . $product->name; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php 

    $imgMgr = new ImgManager();
    $categoryItemMgr = new CategoryItemManager();
    $categoryMgr = new CategoryManager();

    $categories = $categoryItemMgr->get_category_id_by_product($product->id);

    $categorie = array();

    foreach ($categories as $category) {
        $results = $categoryMgr->getCategory($category['category_id']);
        foreach ($results as $result) {
            $string = $result['name'];
            array_push($categorie, $string); 
        }
    }

    $imgs = $imgMgr->getAllImgForAdmin($product->id);


    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/product/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('edit-product.html', [
        'ROOT_URL' => ROOT_URL,
        'product' => $product,
        'imgs' => $imgs,
        'category' => $categorie
        
    ]);
?>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>