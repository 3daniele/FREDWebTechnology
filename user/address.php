<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>
<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/js/address.js"></script>
<title>Indirizzi</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<?php
$shipIMg = new ShipmentInformationManager();
$regionMgr =  new RegionManager();
$provinceMgr = new ProvincesManager();
$cityMgr = new CityManager();
$indirizzi = $shipIMg->getIndirizzi($_SESSION['userid']);

$regions = $regionMgr->getAll();
$provinces = $provinceMgr->getAll();
$cities = $cityMgr->getAll();
?>

<span id="flagRegion" hidden>0</span>
<span id="flagProvince" hidden>0</span>

<span id="regions" hidden><?php echo json_encode($regions) ?></span>
<span id="provinces" hidden><?php echo json_encode($provinces) ?></span>
<span id="cities" hidden><?php echo json_encode($cities) ?></span>


<?php 

if (isset($_POST['add'])) {
    $userID = $_SESSION['userid'];
    $regionID = (int) $_POST['regione'];
    $provinceID = $_POST['provincia'];
    $cityID = $_POST['comune'];
    $code = $_POST['cap'];
    $address = $_POST['address'];

    $shipID = $shipIMg->addShipmentInformation($userID, $regionID, $provinceID, $cityID, $code, $address);
}

?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="" method="POST">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Aggiungi nuovo indirizzo
                </button>
            </div>
        </div>
    </form>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

<!-- Finestra di dialogo per la scrittura della recensione -->
<!-- Modal -->
<form method="POST">
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary"><strong>Inserisci un nuovo indirizzo</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Regione:</label><br>
                                        <select class="form-select" id="regione" name="regione">
                                            <option selected>Seleziona la regione</option>
                                            <?php foreach ($regions as $region) : ?>
                                                <option value=<?php echo $region->id ?>><?php echo $region->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="disabledInput">Provincia:</label><br>
                                        <select class="form-select" id="provincia" name="provincia" disabled>
                                            <option selected>Seleziona la provincia</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Comune:</label><br>
                                        <select class="form-select" id="comune" name="comune" disabled>
                                            <option selected>Seleziona il comune</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="disabledInput">CAP:</label><br>
                                        <input class="form-control" id="cap" name="cap" type="text" maxlength="5" placeholder="CAP" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="disabledInput">Via/Piazza e numero civico:</label><br>
                                        <input class="form-control" id="address" name="address" type="text" placeholder="Via..." disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" name="add">Invia</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</form>
