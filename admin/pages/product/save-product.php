<?php include "../../../inc/init.php"; ?>
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

$id = (int)$_POST["id"];

$selezionati = $_POST['selezionato'];

$productMgr = new ProductManager();
$productMgr->updateProduct($id, $name, $description, $small_description, $price, $stock);

$imgMgr = new ImgManager();
$imgs = $imgMgr->getAllImgForAdmin($id);

if (isset($_POST['add'])) {
    $number = count($imgs) + 1;

    $imgMgr->addImg($id);
    $imgID = $imgMgr->getLast();
    $imgMgr->updateImg($imgID['id'], $id, $number);
}

// upload immagine
if (isset($_FILES)) {

    if (isset($_POST['edit'])) {
        $imgID = $_POST['edit'];

        foreach ($imgs as $img) {
            if ($img['id'] == $imgID) {
                $link = $img['link'];
            }
        }

        echo $link;
        echo "<br>";

        $tmp = $_FILES['image']['tmp_name'];
        var_dump($_FILES['image']);
        echo "<br>";
        
        if (is_uploaded_file($tmp)) {
            $uploadDir = ROOT_PATH . $link; //aggiungo il folder di destinazione
            echo $uploadDir;
            echo "<br>";
            if (move_uploaded_file($tmp, $uploadDir)) {
                // OK
                echo $uploadDir;
            } else {
                echo "Non è stato possibile caricare l'immagine<br/>";
            }
        }
    }
}

$categoryItemMgr = new CategoryItemManager();

$categoryItemMgr->deleteProduct($id);

foreach ($selezionati as $s) {
    $categoryItemMgr->addCategoryProduct($s,$id);
}

//header("Location: " . ROOT_URL . "admin/pages/product/edit-product.php?product=" . $id);

?>