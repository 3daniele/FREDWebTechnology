<?php include "../../inc/init.php";?>
<?php
    $name = $_POST["name"];
    
    $description = (string)$_POST["description"];
    
    $small_description = (string)$_POST["small_description"];
    
    $price = $_POST["price"];
    
    $stock = (int)$_POST["stock"];
    
    $id = (int)$_POST["id"];

    $productMgr = new ProductManager();
    $productMgr->updateProduct($id,$name,$description,$small_description,$price,$stock);

    header("Location: ".ROOT_URL."admin/pages/edit-product.php?product=".$id);
    
?>