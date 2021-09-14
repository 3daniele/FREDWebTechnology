<?php include "../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["product"] == null || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL . "admin/index.php");
}

$productid = $_GET["product"];
?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>
<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/js/review.js"></script>

<?php $productmgr = new ProductManager();
$product = $productmgr->get($productid);
if ($product->name == "") {
    header("Location: " . ROOT_URL);
}
?>



<title>Modifica:<?php echo " " . $product->name; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <form action="./save-product.php" method="POST">
        <input type="text" hidden="hidden" id="id" name="id" value="<?php echo $product->id; ?>" style="visibility: none;"></input>
        <div class="row border-bottom">
            <div class="col-4">
                <h2><strong class="text-primary">Modifica prodotto</strong></h2>
            </div>
            <div class="col-4"></div>
            <div class="col-3 text-end">
                <div class="row">
                    <div class="col-5"></div>
                    <div class="col-2 text-end"><input class="btn btn-success" type="submit" value="Salva"></input></div>
                    <div class="col-2 text-end"><input class="btn btn-danger" type="reset" value="Reset"></input></div>
                    <div class="col-3 text-end"><a class="btn btn-primary" href="<?php echo ROOT_URL . 'shop/single-product.php?product=' . $product->id; ?>">Visualizza</a></div>
                </div>
            </div>
            <div class="col-1"></div>

        </div>
        <div class="row">
            <br>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-7">
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Nome:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control" id="name" name="name" type="text" value="<?php echo $product->name; ?>"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Descrizione:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <textarea class="form-control" id="description" name="description" type="text-area" style="width: 100%; height: 250px; "><?php echo (string)$product->description; ?></textarea>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Descrizione breve:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <textarea class="form-control" id="small_description" name="small_description" type="text-area" style="width: 100%; height: 150px; "><?php echo (string)$product->small_description; ?></textarea>
                </div>
                <hr>
            </div>
            <div class="col-md-4 col-lg-4 px-md-4">
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Prezzo:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control text-end" id="price" name="price" type="Text" value="<?php echo $product->price; ?>"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Giacenza:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control text-end" id="stock" name="stock" type="Text" value="<?php echo $product->stock; ?>"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Foto:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <?php
                    $imgMgr = new ImgManager();
                    $imgs = $imgMgr->getAllImgForAdmin($product->id);
                    ?>
                </div>
                <div class="row">
                    <?php foreach ($imgs as $img) : ?>
                        <div class="row" style="margin-top: 5px;">
                            <div class="col-3">
                                <img src=<?php echo ROOT_URL . $img['link']; ?> alt="immagine" width=100px height=100px class="rounded-circle"></img>
                            </div>
                            <div class="col-9 text-end" style="margin-top: 35px;">
                                <?php echo $img['link']; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Categorie:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">

                            <?php
                            $categoryItemMgr = new CategoryItemManager();
                            $categoryMgr = new CategoryManager();
                            $categories = $categoryItemMgr->get_category_id_by_product($product->id);

                            foreach ($categories as $category) {
                                $results = $categoryMgr->getCategory($category['category_id']);
                                foreach ($results as $result) {
                                    echo "<span class=\"badge rounded-pill bg-info\">";
                                    echo $result['name'];
                                    echo "</span>";
                                    echo " ";
                                }
                            }





                            ?>

                        </li>
                    </ul>
                </div>
                <hr>
            </div>
        </div>
    </form>
</main>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>