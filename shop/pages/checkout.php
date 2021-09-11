<?php
include "../../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Checkout</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    <div class="row">
        <div class="col-9">
            <div class="row">
                <div class="col-3">
                    <h4><strong>1. Indirizzo di consegna:</strong></h4>
                </div>
                <div class="col-9">
                    <form method="POST">
                        <select class="form-select" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-3">
                    <h4><strong>2. Modalità di pagamento:</strong></h4>
                </div>
                <div class="col-9">
                    <form method="POST">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                            <label class="form-check-label" for="flexRadioDefault1">
                                Default radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" checked>
                            <label class="form-check-label" for="flexRadioDefault2">
                                Default checked radio
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                PayPal
                            </label>
                        </div>
                    </form>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-2">
                    <h4><strong>3. Rivedi gli articoli:</strong></h4>
                </div>
                <div class="col-1"></div>
                <div class="col-9">
                    <div class="col-12">
                        <h4><strong class="text-primary">Prodotti:</strong></h4>
                        <br>
                        <?php
                        $cartMgr = new CartManager();
                        $cartItemMgr = new CartItemManager();

                        if (isset($_SESSION['userid'])) {
                            $cartID = $cartMgr->findCart($_SESSION['userid']);
                        } else {
                            $cartID = $cartMgr->getCart($_SESSION['client_id']);
                        }

                        $sum = 0;

                        if ($cartID) :
                            $quantity = $cartItemMgr->countTotalItem($cartID);
                        ?>

                            <ul class="list-group mb-3">
                                <?php
                                $imgMgr = new ImgManager();
                                $productMgr = new ProductManager();
                                $items = $cartItemMgr->getItems($cartID);
                                foreach ($items as $item) :
                                    $product = $productMgr->get($item['product_id']);
                                    $img = $imgMgr->get_thumbnail($product->id);
                                ?>

                                    <li class="list-group-item d-flex" style="border:none; margin-left: 0px;">

                                        <div class="col-lg-4 col-6">
                                            <h6 class="my-0 text-primary"><strong><?php echo $product->name ?></strong></h6>
                                        </div>

                                        <div class="col-lg-3 col-6">
                                            <img src=<?php echo ROOT_URL . $img[0]['link']; ?> alt="immagine" width=100px class="rounded-circle"></img>
                                        </div>


                                        <div class="col-lg-3 col-6">
                                            <form method="POST">
                                                <div class="cart-buttons btn-group" role="group">
                                                    <button name="minus" type="submit" class="btn btn-sm btn-primary" value=<?php echo $product->id ?>>-</button>
                                                    <span class="text-muted"><?php echo $item['quantity']; ?></span>
                                                    <button name="plus" type="submit" class="btn btn-sm btn-primary" value=<?php echo $product->id ?>>+</button>
                                                    <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                                                </div>
                                            </form>
                                        </div>
                                        <div class="col-lg-2 col-6">
                                            <strong class="text-primary"><?php $sum = $sum + number_format($item['quantity'] * $product->price, 2);
                                                                            echo number_format($item['quantity'] * $product->price, 2) ?>
                                                €</strong>
                                        </div>

                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </ul>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12">
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm p-4">

                            <div class="col-3"><button class="btn btn-primary btn-block" style="width: 100%;">Acquista ora &raquo;</button></div>
                            <div class="col-3">
                                <span class="text-primary text-end" style="width: 100%;">
                                        <h4><b>Totale: <?php echo number_format($sum, 2) . " €" ?></b></h4>
                                </span>
                            </div>

                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <?php include ROOT_PATH . "public/template-parts/sidebar.php"; ?>
    </div>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>