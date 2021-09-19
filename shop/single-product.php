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
<script type="text/javascript" src="<?php echo ROOT_URL; ?>assets/js/review.js"></script>

<?php $productmgr = new ProductManager();
$product = $productmgr->get($productid);
if ($product->name == "") {
    header("Location: " . ROOT_URL);
}
?>



<title><?php echo $product->name; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<span id="userID" hidden><?php echo $_SESSION['userid'] ?></span>
<span id="productID" hidden><?php echo $productid ?></span>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-4">
            <section style="width: 18rem;">
                <?php $imgMgr = new ImgManager(); ?>

                <div id="mdb-lightbox-ui"></div>

                <div class="mdb-lightbox">

                    <div class="row product-gallery">

                        <div class="col-12 mb-0">
                            <!-- Thumbneil -->
                            <figure class="view overlay rounded z-depth-1 main-img">
                                <a href=<?php $img = $imgMgr->get_thumbnail($product->id);
                                        echo ROOT_URL . $img[0]['link'];
                                        ?> data-size="710x823">
                                    <img src=<?php echo ROOT_URL . $img[0]['link']; ?> class="img-fluid z-depth-1">
                                </a>
                            </figure>
                            <!-- DOVREBBERO SERVIRE A SCAMBIARE L'IMMAGINE PRINCIPALE -->
                            <!--
                            <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                                <a href="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg" data-size="710x823">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/12a.jpg" class="img-fluid z-depth-1">
                                </a>
                            </figure>
                            <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                                <a href="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg" data-size="710x823">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/13a.jpg" class="img-fluid z-depth-1">
                                </a>
                            </figure>
                            <figure class="view overlay rounded z-depth-1" style="visibility: hidden;">
                                <a href="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14a.jpg" data-size="710x823">
                                    <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/14a.jpg" class="img-fluid z-depth-1">
                                </a>
                            </figure> -->
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <?php $imgs = $imgMgr->get_all_photo($product->id);
                                foreach ($imgs as $img) :
                                ?>
                                    <div class="col-3">
                                        <div class="view overlay rounded z-depth-1 gallery-item hoverable">
                                            <img src=<?php echo ROOT_URL . $img['link']; ?> class="img-fluid">
                                            <div class="mask rgba-white-slight"></div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>

                            </div>
                        </div>
                    </div>

                </div>

            </section>
            <!--Section: Block Content-->
        </div>
        <div class="col-8">
            <h2><?php echo $product->name; ?><p class="valutazione"><?php
                                                                    $reviewMgr = new ReviewManager();
                                                                    $stars = $reviewMgr->getAvg($product->id);
                                                                    $media = $stars[0]['media'];

                                                                    $intere = (int) $media;

                                                                    $m = $media - $intere;

                                                                    if ($m > 0.4) {
                                                                        $mezze = 1;
                                                                    } else {
                                                                        $mezze = 0;
                                                                    }

                                                                    $vuote = (5 - $intere) - $mezze;

                                                                    for ($i = 0; $i < $intere; $i++) {
                                                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star-fill\" viewBox=\"0 0 16 16\">
                  <path d=\"M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z\"/>
                  </svg>";
                                                                    }
                                                                    if ($mezze == 1) {
                                                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star-half\" viewBox=\"0 0 16 16\">
                  <path d=\"M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z\"/>
                </svg>";
                                                                    }
                                                                    for ($i = 0; $i < $vuote; $i++) {
                                                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star\" viewBox=\"0 0 16 16\">
                <path d=\"M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z\"/>
              </svg>";
                                                                    }
                                                                    ?>
                </p>
            </h2>
            <hr>
            <h4><?php echo $product->price . " €"; ?></h4>
            <hr>
            <?php echo $product->description; ?>
            <br><br><br>
            <div class="row">
                <div class="col-3">
                    <form method="POST" action="./cart-action.php">
                        <input type="hidden" name="singleProduct" value=1>
                        <input type="text" class="form-control" name="productID" value=<?php echo $product->id ?> hidden>
                        <button class="btn btn-outline-success btn-sm" name="product_id" type="submit" value=<?php echo $product->id; ?>>Aggiungi al carrello</button>
                    </form>
                </div>
                <div class="col-1">
                    <form method="POST" action="./wishlist-action.php">
                        <input type="text" class="form-control" name="productID" value=<?php echo $product->id ?> hidden>
                        <?php if (!(isset($_SESSION["email"]))) : ?>
                            <button class="btn btn-outline-primary btn-sm" name="wishlist" type="submit" disabled value=<?php echo $product->id; ?>>Preferiti</button>
                        <?php else : ?>
                            <button class="btn btn-outline-primary btn-sm" name="wishlist" type="submit" value=<?php echo $product->id; ?>>Preferiti</button>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

        </div>

    </div>

    <div class="row"><br></div>
    <div class="row"><br></div>
    <div class="row">
        <!-- Tabella recensioni -->
        <div class="col-12">
            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary"><strong>Recensioni</strong></span>
            </h4>

            <div class="row">
                <div class="col-lg-12 col-6">
                    <form class="card p-2">
                        <div class="input-group">
                            <input type="text" class="form-control" id="floatingInput" placeholder="Cerca tra le recensioni">
                            <!-- Button trigger modal -->
                            <?php
                            $check = $reviewMgr->checkReview($_SESSION['userid'], $product->id);
                            if ($check) : ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="update" <?php if (!isset($_SESSION['email'])) : ?> disabled <?php endif; ?>>
                                    Modifica la tua recensione
                                </button>
                            <?php else : ?>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal" data-whatever="add" <?php if (!isset($_SESSION['email'])) : ?> disabled <?php endif; ?>>
                                    Aggiungi una recensione
                                </button>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            $userMgr = new UserManager();
            $reviews = $reviewMgr->getReviews($product->id);
            ?>

            <span id="reviews" hidden><?php echo json_encode($reviews) ?></span>


            <?php if ($reviews == 0) : ?>

                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                        <div class="row w-100">
                            <div class="col-lg-12 col-6">
                                <h5 class="my-0 text-muted">Nessuna recensione presente, scrivi tu la prima!</h5>
                            </div>
                        </div>
                    </li>
                </ul>

                <?php else :

                foreach ($reviews as $review) :
                    $user = $userMgr->getName($review['user_id']);
                ?>
                    <ul class="list-group mb-3">
                        <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                            <div class="row w-100">
                                <div class="col-lg-2 col-6 text-center">
                                    <img class="rounded-circle" src=<?php echo ROOT_URL . $user[0]['img']; ?> alt="immagine" width=100px></img>
                                    </br>
                                    </br>
                                    <span class="my-0 text-primary"><small><?php echo $user[0]['name']; ?></small></span>
                                </div>
                                <div class="col-lg-10 col-6">
                                    <h5 class="my-0 text-primary"><strong><?php echo $review['title']; ?></strong>
                                        <span class="valutazione"> <?php
                                                                    for ($i = 1; $i <= $review['vote']; $i++) {
                                                                        echo "<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-star-fill\" viewBox=\"0 0 16 16\">
                                            <path d=\"M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z\"/>
                                            </svg>";
                                                                    } ?>
                                        </span>
                                    </h5>
                                    <span class="my-0 text-muted"><small><?php echo $review['message'] ?></small></span>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
        </div>
    </div>
</div>

<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>

<!-- Finestra di dialogo per la scrittura della recensione -->
<!-- Modal -->
<form method="POST" action="./review-action.php">
    <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary"><strong id="modalTitle">Inserisci una recensione</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Titolo</p>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Inserisci un titolo">
                    <input type="text" class="form-control" name="productID" value=<?php echo $product->id ?> hidden>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <ul class="ratings">
                            <li class="star" value="5"></li>
                            <li class="star" value="4"></li>
                            <li class="star" value="3"></li>
                            <li class="star" value="2"></li>
                            <li class="star" value="1"></li>
                            <input type="hidden" name="vote" id="starValue" value=1></input>
                        </ul>
                    </div>
                    <div class="modal-body">
                        <p>Descrizione</p>
                        <textarea class="form-control" name="message" id="message" rows="4" placeholder="Inserisci una recensione"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button id="modalBtn" type="submit" class="btn btn-primary" name="add">Invia</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                    </div>
                </div>
            </div>
        </div>
</form>