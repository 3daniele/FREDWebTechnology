<?php
include "../../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Checkout</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php
$shipmentMgr = new ShipmentInformationManager();
$paymentsMgr = new PaymentsManager();
$cartMgr = new CartManager();
$cartItemMgr = new CartItemManager();
$ordersMgr = new OrdersManager();
$ordersItemMgr = new OrdersItemsManager();

$userID = $_SESSION['userid'];

$cartID = $cartMgr->findCart($userID);
$cartItems = $cartItemMgr->getItems($cartID);
$addresses = $shipmentMgr->getIndirizzi($userID);
$payments = $paymentsMgr->getPayments($userID);
?>

<!-- Checkout -->
<?php

if (isset($_POST['checkout'])) {
    $shipmentID = $_POST['shipmentID'];

    $orderID = $ordersMgr->addOrder($userID, $shipmentID);
   
    foreach ($cartItems as $item) {
        $productID = $item['product_id'];
        $quantity = $item['quantity'];

        $ordersItemMgr->addItem($orderID, $productID, $quantity);
        $cartItemMgr->removeItem($item['id']);
    } 
}

?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    <form method="POST">
        <div class="row">
            <div class="col-9">
                <div class="row">
                    <div class="col-3">
                        <h4><strong>1. Indirizzo di consegna:</strong></h4>
                    </div>
                    <div class="col-9">
                        <form method="POST">
                            <select class="form-select" name="shipmentID" aria-label="Default select example">
                                <?php foreach ($addresses as $address) : ?>
                                    <option <?php if ($address['principal'] == 1) {
                                                echo "selected";
                                            } ?> value=<?php echo $address['id_shipment']; ?>><?php echo $address['address'] . " " . $address['city_name'] . " " . $address['code'] . " " . $address['provinces_name'];  ?></option>
                                <?php endforeach ?>
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
                        <?php foreach ($payments as $payment) : ?>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id=<?php echo $payment['id'] ?>>
                                <label class="form-check-label" for="flexRadioDefault1">
                                    <?php echo "************" . substr($payment['credit_card_number'], 12, 16) ?>
                                </label>
                            </div>
                        <?php endforeach ?>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                PayPal
                            </label>
                        </div>
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


                                            <div class="col-lg-3 col-6 text-center">
                                                <span class="text-muted"><?php echo $item['quantity']; ?></span>
                                                <input type="hidden" name="productID" value="<?php echo $item['id'] ?>" />
                                            </div>
                                            <div class="col-lg-2 col-6">
                                                <strong class="text-primary">
                                                    <?php $sum = $sum + number_format($item['quantity'] * $product->price, 2);
                                                    echo number_format($item['quantity'] * $product->price, 2)
                                                    ?> €
                                                </strong>
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
                                <div class="col-3">
                                        <button name="checkout" type=submit class="btn btn-primary btn-block" style="width: 100%;">Acquista ora &raquo;</button>
                                </div>
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
    </form>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>