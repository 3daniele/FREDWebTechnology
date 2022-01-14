<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Ordini</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>
<?php
$orderMgr = new OrdersManager();
$orderAMgr = new OrderAddressManager();
$orderIMgr = new OrdersItemsManager();

$ordini = $orderMgr->getOrder($_SESSION['userid']);

?>
<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <?php if ($ordini) : ?>
            <?php foreach ($ordini as $ordine) : ?>
                <div class="col-12">
                    <div class="card mb-3">
                        <a href="<?php echo ROOT_URL . '/user/order-details.php?order=' . $ordine["id"]; ?>" class="btn text-start">
                            <div>
                                <?php
                                $date = substr($ordine['date_order'], 0, 10);
                                $yy = substr($date, 0, 4);
                                $mm = substr($date, 5, 2);
                                $dd = substr($date, 8, 10);
                                $somma = $orderMgr->getsum($ordine["id"]);

                                ?>
                                <h3 class="card-header text-center"><strong>Ordine effettuato il </strong> <strong><?php echo $dd . "-" . $mm . "-" . $yy; ?> </strong></h3>
                            </div>
                            <br>
                            <div class="row">

                                <div class="col-lg-1 col-1"></div>
                                <div class="col-lg-8 col-2"> <strong class="text-primary"> Stato ordine:</strong> <strong> <?php echo $ordine['status'] . "<br>"  ?></strong> </div>
                                <div class="col-lg-2 col-9">
                                    <strong class="text-primary"> Totale ordine : </strong> <strong><?php echo $somma[0]["totale"] . " €"  ?> </strong>
                                </div>
                            </div>
                            <br>
                            <div class="row">

                                <div class="col-1"></div>
                                <div class="col-9">
                                    <div class="col-12">
                                        <h4><strong class="text-primary">Prodotti:</strong></h4>
                                        <br>

                                        <ul class="list-group mb-3">
                                            <?php
                                            $imgMgr = new ImgManager();
                                            $productMgr = new ProductManager();
                                            $items = $orderIMgr->getItems($ordine['id']);

                                            foreach ($items as $item) :
                                                $product = $productMgr->get($item['product_id']);
                                                $img = $imgMgr->get_thumbnail($product->id);
                                            ?>

                                                <li class="list-group-item d-flex" style="border:none; margin-left: 0px;">

                                                    <div class="col-lg-3 col-6">
                                                        <img src=<?php echo ROOT_URL . $img[0]['link']; ?> alt="immagine" width=100px class="rounded-circle"></img>
                                                    </div>
                                                    <div class="col-lg-4 col-6">
                                                        <h6 class="my-0 "><strong><?php echo $product->name ?></strong></h6>
                                                    </div>

                                                    <div class="col-lg-2 col-6">
                                                        <strong class="text-primary">
                                                            <?php $sum = $sum + number_format($item['quantity'] * $product->price, 2);

                                                            ?>
                                                        </strong>
                                                    </div>

                                                </li>

                                            <?php endforeach; ?>

                                        </ul>
                                    </div>

                                </div>
                            </div>

                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Nessun ordine presente...</p>
        <?php endif; ?>
    </div>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>