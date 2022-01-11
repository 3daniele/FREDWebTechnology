<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}

?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>




<title>Nuovo prodotto</title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <form action="./save-new-product.php" method="POST">
        <div class="row border-bottom">
            <div class="col-4">
                <h2><strong class="text-primary">Nuovo prodotto</strong></h2>
            </div>
            <div class="col-4"></div>
            <div class="col-3 text-end">
                <div class="row">
                    <div class="col-5"></div>
                    <div class="col-2 text-end"></div>
                    <div class="col-3 text-end"></div>
                    <div class="col-2 text-end"><input class="btn btn-success" type="submit" value="Salva"></input></div>

                </div>
            </div>
            <div class="col-1"></div>

        </div>
        <div class="row">
            <br>
        </div>

        <div class="row">
            <div class="col-md-6 col-lg-7">
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Nome:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control" id="name" name="name" type="text"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Descrizione:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <textarea class="form-control" id="description" name="description" type="text-area" style="width: 100%; height: 250px; "></textarea>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Descrizione breve:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <textarea class="form-control" id="small_description" name="small_description" type="text-area" style="width: 100%; height: 150px; "></textarea>
                </div>
                <hr>
            </div>
            <div class="col-md-4 col-lg-4 px-md-4">
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Prezzo:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control text-end" id="price" name="price" type="Text"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Giacenza:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <input class="form-control text-end" id="stock" name="stock" type="Text"></input>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Venditore:</strong></h4>
                    </span>
                </div>
                <div class="row">
                    <ul class="list-group list-group-flush">
                        <select id="select" name="select" class="form-select">
                            <option selected>Seleziona un venditore</option>
                            <?php $manufacturerMgr = new ManufacturerManager();
                                $manufacturers = $manufacturerMgr->getAll(); 
                                foreach($manufacturers as $manufacturer) :?>
                                <option value=<?php echo $manufacturer->id; ?>><?php echo $manufacturer->name; ?></option>
                            <?php endforeach;?>
                        </select>
                    </ul>
                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Foto:</strong></h4>
                        Modifica
                    </span>
                </div>
                <div class="row">

                </div>
                <div class="row">

                </div>
                <hr>
                <div class="row">
                    <span class="text-primary">
                        <h4><strong>Categorie:</strong></h4>
                        Modifica
                    </span>
                </div>
                <div class="row">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">

                        </li>
                    </ul>
                </div>
                <hr>
            </div>
        </div>
    </form>
</main>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>