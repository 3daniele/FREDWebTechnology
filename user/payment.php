<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>
<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/js/payment.js"></script>
<title>Informazioni pagamento</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<?php 

$userID = $_SESSION['userid'];
$paymentsMgr = new PaymentsManager();
$payments = $paymentsMgr->getPayments($userID);

?>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <?php if ($payments) : ?>
            <?php foreach ($payments as $payment) : ?>
                <div class="col-3">
                    <div class="card mb-3">
                        <h3 class="card-header text-center">Metodo <?php if ($payment['principal'] == 1) echo " predefinito" ?></h3>
                        <li class="list-group-item"> Numero di carta: <?php echo $payment['credit_card_number'] ?></li>
                        <li class="list-group-item"> Scadenza: <?php echo $payment['expiration1'] . "/" . $payment['expiration2']?></li>
                        <li class="list-group-item"> Cvv: <?php echo $payment['cvv'] ?></li>
                        <div class="card-body text-center">
                            <form method="POST" action="./payment-action.php">
                                <input class="form-control" id="paymentID" name="paymentID" type="text" hidden value="<?php echo $payment['id']; ?>">
                                <?php if ($payment['principal'] == 0) : ?>
                                    <button class="btn btn-outline-success btn-sm" name="principal" type="submit" value=1>Rendi metodo predefinito</button>
                                <?php else : ?>
                                    <button class="btn btn-outline-success btn-sm" name="principal" type="submit" value=0>Rimuovi metodo predefinito</button>
                                <?php endif; ?>                                
                                <button class="btn btn-outline-danger btn-sm" name="delete" type="submit" value="<?php echo $payment['id']; ?>">Elimina</button>                                
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Nessun metodo di pagamento presente...</p>
        <?php endif; ?>
    </div>
</div>
<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="./payment-action.php" method="POST">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="aggiungi">
                    Aggiungi nuovo metodo
                </button>
            </div>
        </div>
    </form>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

<!-- Finestra di dialogo per l'aggiunta di un nuovo indirizzzo -->
<!-- Modal -->
<form method="POST" action="./payment-action.php">
    <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary"><strong id="modalTitle">Inserisci un nuovo metodo di pagamento</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./payment-action.php">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Numero di carta:</label><br>
                                        <input class="form-control" id="credit_card_number" name="credit_card_number" type="text" placeholder="1234xxx">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-5">
                                        <label class="form-label">Scadenza:</label><br>
                                        <input class="form-control" id="expiration" name="expiration" type="text" placeholder="05/22">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-3">
                                        <label class="form-label" for="disabledInput">Cvv:</label><br>
                                        <input class="form-control" id="cvv" name="cvv" type="text" placeholder="123">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="modalBtn" class="btn btn-primary" name="add">Invia</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</form>