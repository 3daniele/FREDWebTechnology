<?php
include "../inc/init.php";

if (!defined('ROOT_URL')) {
    die;
}
$orderMgr = new OrdersManager();
$orderAMgr = new OrderAddressManager();

$orderID = $_GET["order"];

$ordine = $orderMgr->getOrderByID($orderID);
$address = $orderAMgr->getAddressByOrder($orderID);

if ($orderID == null || !isset($_SESSION["email"]) || $_SESSION["userid"] != $ordine['user_id']) {
    header("Location: " . ROOT_URL);
}

?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Dettaglio Ordine</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-12">
            <div class="card mb-3">
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
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-3 col-4">
                                <strong class="text-primary"> Stato ordine: </strong>
                            </div>
                            <div class="col-lg-2 col-4">
                                <?php echo $ordine['status'] . "<br>"  ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <?php
                    $date = substr($ordine['stimate_delivery'], 0, 10);
                    $yy = substr($date, 0, 4);
                    $mm = substr($date, 5, 2);
                    $dd = substr($date, 8, 10);
                    ?>
                    <div class="col-lg-1 col-1"></div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-3 col-4">
                                <strong class="text-primary"> In arrivo entro il: </strong>
                            </div>
                            <div class="col-lg-2 col-4">
                                <?php echo $dd . "-" . $mm . "-" . $yy . "<br>"; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-1 col-1"></div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-3 col-4">
                                <strong class="text-primary">Indizzo consegna: </strong>
                            </div>
                            <div class="col-lg-2 col-4">
                                <h6 class="my-0 "><?php echo $address['address']; ?></h6>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3 col-4"></div>
                            <div class="col-lg-4 col-7">
                                <h6 class="my-0 "><?php echo $address['city_name'] . ', ' . $address['provinces_name'] . ' ' . $address['code']; ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-lg-1 col-1"></div>
                    <div class="col-9">
                        <div class="row">
                            <div class="col-lg-3 col-4">
                                <strong class="text-primary"> Numero di spedizione: </strong>
                            </div>
                            <div class="col-lg-2 col-4">
                                <?php echo $ordine['tracking_information'];  ?>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>