<?php include "../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["product"] == null) {
    header("Location: " . ROOT_URL);
}

$productid = $_GET["product"];
?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>
<?php $productmgr = new ProductManager();
$product = $productmgr->get($productid);
if ($product->name == "") {
    header("Location: " . ROOT_URL);
}
?>
<title><?php echo $product->name; ?></title>
<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>
<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="<?php
                            $imgMgr = new ImgManager();
                            $img = $imgMgr->get_thumbnail($product->id);
                            foreach ($img as $i) {
                                echo ROOT_URL . $i['link'];
                            } ?>" class="card-img-top" alt="...">
                </img>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-8">
            <h2><?php echo $product->name; ?></h2>
            <hr>
            <h4><?php echo $product->price . " €"; ?></h4>
            <hr>
            <?php echo $product->description; ?>
            <br><br><br>
            <div class="row">
                <form method="POST">
                    <button class="btn btn-outline-success btn-sm" name="product_id" type="submit" value=<?php echo $product->id; ?>>Aggiungi al carrello</button>
                    <?php if (!(isset($_SESSION["email"]))) : ?>
                        <button class="btn btn-outline-primary btn-sm" name="wishlist" type="submit" disabled value=<?php echo $product->id; ?>>Preferiti</button>
                    <?php else : ?>
                        <button class="btn btn-outline-primary btn-sm" name="wishlist" type="submit" value=<?php echo $product->id; ?>>Preferiti</button>
                    <?php endif; ?>
                </form>
            </div>

        </div>

    </div>

    <div class="row"><br></div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-2">
            <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
                <div class="card-header">Recensioni</div>
                <div class="card-body">
                    <h4 class="card-title">Media con stelline</h4>
                    <p class="card-text">1 stella<br> 2 stelle <br>...</p>
                </div>
            </div>
        </div>

        <!-- Tabella recensioni -->
        <div class="col-10">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary"><strong>Recensioni</strong></span>
            </h4>

            <div class="row">
                <div class="col-lg-12 col-6">
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Cerca tra le recensioni">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" <?php if(!isset($_SESSION['email'])) : ?> disabled <?php endif;?>>
                                Aggiungi una recensione
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                    <div class="row w-100">
                        <div class="col-lg-2 col-6 text-center">
                            <img class="rounded-circle" src=<?php echo ROOT_URL . $img[0]['link']; ?> alt="immagine" width=100px></img>
                            </br>
                            </br>
                            <span class="my-0 text-primary"><small><?php echo $product->name ?></small></span>
                        </div>
                        <div class="col-lg-10 col-6">
                            <h5 class="my-0 text-primary"><strong><?php echo $product->name ?></strong> <span class="text-muted"> Valutazione</span></h5>
                            <span class="my-0 text-muted"><small><?php echo $product->description ?></small></span>
                        </div>
                    </div>
                </li>
        </div>

    </div>
</div>



<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>

<!-- Finestra di dialogo per la scrittura della recensione -->
<!-- Modal -->
<div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Titolo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Recensione</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Invia</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
            </div>
        </div>
    </div>
</div>

<!-- AGGIUNTA AL CARRELLO -->
<?php
if (!defined('ROOT_URL')) {
    die;
}

if (isset($_POST['product_id'])) {

    $productID = $_POST['product_id'];

    // addToCart Logic
    $cartMgr = new CartManager();

    if (isset($_SESSION['userid'])) {
        $cartID = $cartMgr->findCart($_SESSION['userid']);
    } else {
        $cartID = $cartMgr->getCurrentCartId();
    }
    // aggiungi al carrello "cartID" il prodotto "productID"
    $cartMgr->addToCart($productID, $cartID);
}

if (isset($_POST["wishlist"])) {
    $wishlistMgr = new WishlistManager();

    $userid = $_SESSION["userid"];
    $productID = $_POST["wishlist"];

    $wishlistMgr->addProduct($userid, $productID);
}


$id = htmlspecialchars(trim($_GET['product_id']));


?>