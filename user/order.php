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
                        <div>
                            <h3 class="card-header text-center">Ordine effettuato il <?php echo $ordine['date_order'] ?> </h3>
                        </div>
                        <br>
                        <div class="row">
                           
                            <div class="col-lg-1 col-1"></div>
                                <div class="col-lg-8 col-2"> <strong class="text-primary"> Stato ordine: <?php echo $ordine['status'] . "<br>" ?> </strong> </div>
                                <div class="col-lg-2 col-9">
                                    <form method="POST" action="./address-action.php">
                                        <input class="form-control" id="shipmentID" name="shipmentID" type="text" hidden value="<?php echo $indirizzo['id_shipment']; ?>">
                                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="modifica" data-bs-whatever=<?php echo $indirizzo['id_shipment']; ?>>Dettagli ordine</button>

                                    </form>
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
                                                        <h6 class="my-0 text-primary"><strong><?php echo $product->name ?></strong></h6>
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
                            <div class="row">
                                <div class="col-lg-9 col-3"> </div>
                                <div class="col-lg-3 col-9">
                                    <strong class="text-primary"> Totale ordine :
                                        <?php echo number_format($sum, 2);

                                        ?>€
                                    </strong>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <p>Nessun ordine presente...</p>
            <?php endif; ?>
                </div>
    </div>

    <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>