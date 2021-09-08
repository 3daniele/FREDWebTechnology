<?php include "../../inc/init.php"; ?>
<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Preferiti</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<div class="container" id="main-area" style="margin-top: 70px;">
    <?php if (isset($_SESSION["email"])) : ?>
        <div class="row">
            <h2 class="text-primary"><?php echo "Benvenuto " . $_SESSION["name"]; ?></h2>
            <hr>
        </div>
    <?php else : ?>
        <?php header("Location: " . ROOT_URL); ?>
    <?php endif; ?>
    <div class="row">
        <div class="col-12">

            <?php
            $imgMgr = new ImgManager();
            $productMgr = new ProductManager();
            $wishlistMgr = new WishlistManager();
            $element = $wishlistMgr->countElementByUser($_SESSION["userid"]);

            if ($element[0]["countid"] > 0) :
            ?>

                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Preferiti</span>
                </h4>
                <ul class="list-group mb-3">
                    <?php

                    $items = $wishlistMgr->getByUserId($_SESSION["userid"]);
                    foreach ($items as $item) :
                        $product = $productMgr->get($item['product_id']);
                        $img = $imgMgr->get_thumbnail($product->id);
                    ?>

                        <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                            <div class="row w-100">
                                <div class="col-lg-3 col-6">
                                    <h6 class="my-0 text-primary"><strong><?php echo $product->name ?></strong></h6>
                                </div>

                                <div class="col-lg-2 col-6">
                                    <img src=<?php echo ROOT_URL . $img[0]['link']; ?> alt="immagine" width=100px></img>
                                </div>

                                <div class="col-lg-3 col-6">
                                    <span class="text-muted" maxlength="15"><?php echo substr($product->description, 0, 200)." " ?><a href="<?php echo ROOT_URL; ?>shop/single-product.php?product=<?php echo $product->id; ?>"> continua</a></span>
                                </div>

                                <div class="col-lg-2 col-6">
                                    <span class="text-muted"><?php echo $product->price ?> €</span>
                                </div>
                                <div class="col-lg-2 col-6">
                                    <form method="POST">
                                        <button class="btn btn-outline-success btn-sm" name="product_id" type="submit" value=<?php echo $product->id; ?>>Aggiungi al carrello</button><br><br>
                                        <button class="btn btn-outline-danger btn-sm" name="rimuovi" type="submit" value=<?php echo $product->id; ?>>Rimuovi</button>
                                    </form>
                                </div>

                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>



            <?php else : ?>
                <p class="lead">Nessun elemento nella lista...</p>
                <a href="<?php echo ROOT_URL . 'shop?page=products-list'; ?>" class="btn btn-primary btn-lg mb-5 mt-3">Vai allo Shopping &raquo;</a>
            <?php endif; ?>

        </div>


        <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

        <!-- AGGIUNTA AL CARRELLO E RIMOZIONE DALLA LISTA -->
        <?php
        if (!defined('ROOT_URL')) {
            die;
        }

        if (isset($_POST['product_id'])) {

            $productID = $_POST['product_id'];

            // addToCart Logic
            $cartMgr = new CartManager();

            if (isset($_SESSION['userid'])) {
                $cartID = $cartMgr->findCart($_SESSION['userid']);
            } else {
                $cartID = $cartMgr->getCurrentCartId();
            }
            // aggiungi al carrello "cartID" il prodotto "productID"
            $cartMgr->addToCart($productID, $cartID);
        }

        if (isset($_POST['rimuovi'])){
            $productID = $_POST['rimuovi'];

            $wishlistMgr->deleteByProductId($productID, $_SESSION["userid"]);

            header("Location: ". ROOT_URL . "shop/pages/wishlist.php");
        }

        $id = htmlspecialchars(trim($_GET['product_id']));


        ?>