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
?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="" method="POST">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Regione:</label><br>
                        <select class="form-select" id="regione">
                            <option selected>Seleziona la regione</option>
                            <?php foreach($regions as $region) : ?>
                                <option value=<?php echo $region->id ?>><?php echo $region->name ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="disabledInput">Provincia:</label><br>
                        <select class="form-select" id="provincia" disabled>
                            <option selected>Seleziona la provincia</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label">Comune:</label><br>
                        <select class="form-select" id="comune" disabled>
                            <option selected>Seleziona il comune</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-6">
                        <label class="form-label" for="disabledInput">Via /Piazza numero civico:</label><br>
                        <input class="form-control" id="disabledInput" type="text" value="bvgf" disabled>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="" method="POST">
        <div class="row">
            <?php   
            $shIMg = new ShipmentInformationManager();
            $regionMgr =  new RegionManager();
            $provinceMgr = new ProvincesManager();
            $cityMgr = new CityManager();
            $indirizzi = $shIMg->getIndirizzi($_SESSION['userid']);
            $count= 1;
            ?>
                <div class="col-12">
                    
                    <h4><label class="form-label">Indirizzo</label></h4>
                    <hr>
                    </div class="row">
                        <div class="col-12">
                            <div class="col-6">
                                <label class="form-label">Regione</label>
                                    <select id="regione">
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                    </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="disabledInput">Provincia</label>
                                    <select id="provincia">
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="col-6">
                                <label class="form-label">Comune</label>
                                    <select id="comune">
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                    </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="disabledInput">Via /Piazza numero civico</label>
                                <input class="form-control" id="disabledInput" type="text" value="bvgf">
                            </div>
                        </div>
                    </div> 
                </div>
            
            <div class="row">
            <br><br>
            <?php foreach ($indirizzi as $i) : ?>
                <?php $regione = $regionMgr->getRegione($i["region"]);
                    $provincia = $provinceMgr->getProvincia($i["province"]);
                    $citta = $cityMgr->getcitta($i["city"]);            
                ?>
                <div class="col-12">
                    
                    <h4><label class="form-label">Indirizzo numero <?php echo $count; $count++;?> </label></h4>
                    <hr>
                    <div class="col-6">
                        <label class="form-label">Regione</label>
                        <input class="form-control" id="disabledInput" type="text" value=<?php echo $regione[0]["name"]; ?>>
                        <label class="form-label" for="disabledInput">Comune</label>
                        <input class="form-control" id="disabledInput" type="text" value=<?php echo $citta[0]["name"]; ?>>
                    <br><br>
                    </div>
                    <div class="col-6">
                        <label class="form-label" for="disabledInput">Provincia</label>
                        <input class="form-control" id="disabledInput" type="text" value=<?php echo $provincia[0]["name"]; ?>>
                        <label class="form-label" for="disabledInput">Via /Piazza numero civico</label>
                        <input class="form-control" id="disabledInput" type="text" value="<?php echo $i['address']; ?>">
                    <br><br>
                    </div>
                </div>
            </div>
                   
                   
                    <div class="row">

                    <div class="row">

                    <div class="col-5"></div>
                    <div class="col-1"><input type="submit" class="btn btn-outline-primary" value="Modifica" style="width: 100%;"></input></div>
                    <div class="col-1"><input type="reset" class="btn btn-outline-danger" value="Elimina" style="width: 100%;"></input></div>
                    <div class="col-5"></div>
                    </div>
                    </div>
                    
                    <?php endforeach; ?>
                   <br><br>
                   <div class="row">
                    <div class="col-2"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Aggiungi nuovo indirizzo 
                 </button> </div>      
                 <div class="col-7"></div>
                 <div class="col-3"> <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Modifica indirizzo principale
                 </button> </div>  
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
                    <h5 class="text-primary"><strong>Inserisci nuovo indirizzo</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Regione:</label><br>
                                        <select id="regione">
                                            <option value='1'>1</option>
                                            <option value='2'>2</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="disabledInput">Provincia:</label><br>
                                        <select id="provincia">
                                            <option value='1'>1</option>
                                            <option value='2'>2</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label">Comune:</label><br>
                                        <select id="comune">
                                            <option value='1'>1</option>
                                            <option value='2'>2</option>
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-12">
                                        <label class="form-label" for="disabledInput">Via /Piazza numero civico:</label><br>
                                        <input class="form-control" id="disabledInput" type="text" value="bvgf">
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
