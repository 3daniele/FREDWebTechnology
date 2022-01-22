<?php include "../../../inc/init.php";?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>
<?php
    $name = $_POST["name"];
    
    $description = (string)$_POST["description"];
    
    $small_description = (string)$_POST["small_description"];
    
    $price = $_POST["price"];
    
    $stock = (int)$_POST["stock"];
    
    $manufacturer = (int) $_POST["select"];

    $productMgr = new ProductManager();
    $productMgr->newProduct($name,$description,$small_description,$price,$stock,$manufacturer);

    $id = $productMgr->getLast();

    $categoryMgr = new CategoryItemManager();

    $category = $_POST["selezionato"];

    foreach($category as $cat){
        $categoryMgr->addCategoryProduct($cat,$id[0]['id']);
    }

    header("Location: ".ROOT_URL."admin/pages/product/edit-product.php?product=".$id[0]['id']);
    
?>