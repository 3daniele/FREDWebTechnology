<?php include "../../inc/init.php"; ?>

<?php if ($_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Prodotti</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-8 col-lg-9 px-md-4">
    <div class="row border-bottom">
        <div class="col-4"><h2><strong class="text-primary">Prodotti</strong></h2></div>
        <div class="col-4"></div>
        <div class="col-2 text-end"><form>
          <input type="search" class="form-control" placeholder="Cerca nella lista" aria-label="Search">
        </form></div>
        <div class="col-2 text-end"><a class="btn btn-primary" href="new-product.php">Nuovo Prodotto</a>
        </div>
    </div>
    <div class="card" style="border: none;">
        <div class="card-body">
            <div class="row">
                <div class="col-1">
                    <h5><b>ID</b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Nome</b></h5>
                </div>
                <div class="col-3">
                    <h5><b>Descrizione</b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Produttore</b></h5>
                </div>
                <div class="col-2 text-end">
                    <h5><b>Prezzo</b></h5>
                </div>
                <div class="col-2 text-end">
                    <h5><b>Giacenza</b></h5>
                </div>
            </div>
            <hr>
            <?php
            $productMgr = new ProductManager();
            $products = $productMgr->getProductOrderByStock();
            ?>
            <?php foreach ($products as $product) : ?>
            <?php $path = "admin/pages/edit-product.php?product=" . $product['id']; ?>
            <?php if ($product['stock'] >= 20) : ?>
                <div class="row" style="cursor:pointer" onclick="location.href='<?php echo ROOT_URL . $path; ?>'">
                <?php else : ?>
                <?php if ($product['stock'] < 20 && $product['stock'] >= 10) : ?>
                    <div class="row text-warning" style="cursor:pointer" onclick="location.href='<?php echo ROOT_URL . $path; ?>'">
                <?php else : ?>
                    <div class="row text-danger" style="cursor:pointer" onclick="location.href='<?php echo ROOT_URL . $path; ?>'">
                <?php endif; ?>
                <?php endif; ?>
                
                    <p class="card-text">
                    <div class="col-1">
                        <?php echo $product['id']; ?>
                    </div>
                    <div class="col-2">
                        <?php echo $product['name']; 
                        ?>
                    </div>
                    <div class="col-3">
                        <?php echo $product['small_description'];?>
                    </div>
                    <?php $manufacturerMgr = new ManufacturerManager();
                        $manufacture = $manufacturerMgr->get($product['manufacturer_id']);
                    ?>
                    <div class="col-2">
                        <?php echo $manufacture->name;?>
                    </div>
                    <div class="col-2 text-end">
                        <?php echo $product['price']." €"; 
                        ?>
                    </div>
                    <div class="col-2 text-end">
                        <?php echo $product['stock'];?>
                    </div>
                    </p>
                </div>
                <hr>
                <?php endforeach; ?>
        </div>
</main>
<div class="col-md-1 col-lg-1 px-md-4"></div>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>