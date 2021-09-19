<?php include "../inc/init.php" ?>

<?php include ROOT_PATH . "public/template-parts/title.php" ?>

<title>Shop</title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php
$productMgr = new ProductManager();
$productCategoryMgr = new ProductCategoryManager();
if (isset($_GET["search"])) {
    $search = $_GET["search"];
    $searchCategory = $productCategoryMgr->search($search);

    if ($searchCategory[0]['id'] != 0) {
        $products = $searchCategory;
    }
} else {
    $products = $productMgr->getAll();
}

?>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <?php if ($products) : ?>
            <?php foreach ($products as $product) : ?>
                <div class="col-3">
                    <div class="card mb-3">
                        <h3 class="card-header text-center">


                            <?php if (gettype($product) == "array") {
                                $product = new Product($product['id'], $product['name'], $product['description'], $product['price'], $product['manufacturer_id'], $product['category']);
                            } ?>

                            <?php echo $product->name; ?>
                        </h3>
                        <img src="<?php
                                    $imgMgr = new ImgManager();
                                    $img = $imgMgr->get_thumbnail($product->id);
                                    foreach ($img as $i) {
                                        echo ROOT_URL . $i['link'];
                                    } ?>" class="d-block user-select-none" height="304px" width="304px" alt="<?php echo $product->name; ?>">

                        </img>
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
                            <li class="list-group-item"><span class="valutazione">
                                    <?php
                                    $reviewMgr = new ReviewManager();
                                    $stars = $reviewMgr->getAvg($product->id);
                                    $media = $stars[0]['media'];

                                    $intere = (int) $media;

                                    $m = $media - $intere;

                                    if ($m > 0.4) {
                                        $mezze = 1;
                                    } else {
                                        $mezze = 0;
                                    }

                                    $vuote = (5 - $intere) - $mezze;

                                    for ($i = 0; $i < $intere; $i++) {
                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star-fill\" viewBox=\"0 0 16 16\">
                                              <path d=\"M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z\"/>
                                              </svg>";
                                    }
                                    if ($mezze == 1) {
                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star-half\" viewBox=\"0 0 16 16\">
                                              <path d=\"M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z\"/>
                                              </svg>";
                                    }
                                    for ($i = 0; $i < $vuote; $i++) {
                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star\" viewBox=\"0 0 16 16\">
                                              <path d=\"M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z\"/>
                                              </svg>";
                                    }
                                    ?>
                                </span></li>

                            <li class="list-group-item"> <?php echo $product->price . " €" ?></li>
                        </ul>
                        <div class="card-body text-center">
                            <form method="POST" action="./cart-action.php">
                                <a href=<?php echo ROOT_URL . 'shop/single-product.php?product=' . $product->id; ?> class="btn btn-outline-primary btn-sm" style="margin-right: 18px">Dettagli</a>
                                <button class="btn btn-outline-success btn-sm" name="product_id" type="submit" value=<?php echo $product->id; ?>>Aggiungi al carrello</button>
                            </form>
                        </div>
                    </div>


                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Nessun prodotto disponibile...</p>
        <?php endif; ?>
    </div>
</div>

</div>
<?php
include ROOT_PATH . 'public/template-parts/footer.php';
?>
