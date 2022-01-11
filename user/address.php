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
$shipIMgr = new ShipmentInformationManager();
$addressMgr = new AddressManager();
$regionMgr =  new RegionManager();
$provinceMgr = new ProvincesManager();
$cityMgr = new CityManager();

$indirizzi = $shipIMgr->getIndirizzi($_SESSION['userid']);

$addresses = $addressMgr->getAll();
$regions = $regionMgr->getAll();
$provinces = $provinceMgr->getAll();
$cities = $cityMgr->getAll();
?>

<span id="flagRegion" hidden>0</span>
<span id="flagProvince" hidden>0</span>
<span id="flagCity" hidden>0</span>

<span id="addresses" hidden><?php echo json_encode($addresses) ?></span>
<span id="regions" hidden><?php echo json_encode($regions) ?></span>
<span id="provinces" hidden><?php echo json_encode($provinces) ?></span>
<span id="cities" hidden><?php echo json_encode($cities) ?></span>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <?php if ($indirizzi) : ?>
            <?php foreach ($indirizzi as $indirizzo) : ?>
                <div class="col-3">
                    <div class="card mb-3">
                        <h3 class="card-header text-center">Indirizzo <?php if ($indirizzo['principal'] == 1) echo " predefinito" ?> </h3>
                        <li class="list-group-item"> <?php echo $indirizzo['address'] . "<br>" . $indirizzo['city_name'] . ", " . $indirizzo['code'] . "<br>" . $indirizzo['provinces_name'] . "<br>";  ?></li>
                        <div class="card-body text-center">
                            <form method="POST" action="./address-action.php">
                                <input class="form-control" id="shipmentID" name="shipmentID" type="text" hidden value="<?php echo $indirizzo['id_shipment']; ?>">
                                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="modifica" data-bs-whatever=<?php echo $indirizzo['id_shipment']; ?>>Modifica</button>
                                <button class="btn btn-outline-danger btn-sm" name="delete" type="submit" value="<?php echo $indirizzo['id_shipment']; ?>">Elimina</button>
                                <div class="row"><br></div>
                                <?php if ($indirizzo['principal'] == 0) : ?>
                                    <button class="btn btn-outline-success btn-sm" name="principal" type="submit" value=1>Rendi indirizzo predefinito</button>
                                <?php else : ?>
                                    <button class="btn btn-outline-success btn-sm" name="principal" type="submit" value=0>Rimuovi indirizzo predefinito</button>
                                <?php endif; ?>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>Nessun indirizzo presente...</p>
        <?php endif; ?>
    </div>
</div>
<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="./address-action.php" method="POST">
        <div class="row">
            <div class="col-2">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="aggiungi">
                    Aggiungi nuovo indirizzo
                </button>
            </div>
        </div>
    </form>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

<!-- Finestra di dialogo per l'aggiunta di un nuovo indirizzzo -->
<!-- Modal -->
<form method="POST" action="./address-action.php">
    <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary"><strong id="modalTitle">Inserisci un nuovo indirizzo</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="./address-action.php">
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
                    <button type="submit" id="modalBtn" class="btn btn-primary" name="add">Invia</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>
            </div>
        </div>
    </div>
</form>