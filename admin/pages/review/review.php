<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Recensioni</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>


    <div class="col-md-9 col-lg-8 px-md-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2><strong class="text-primary">Recensioni</strong></h2>
        </div>
        <div class="card" style="border: none;">
            <div class="card-body">
                <div class="row">
                    <div class="col-1">
                        <h5><b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z" />
                                </svg></b></h5>
                    </div>
                    <div class="col-2">
                        <h5><b>Titolo</b></h5>
                    </div>
                    <div class="col-3">
                        <h5><b>Descrizione</b></h5>
                    </div>
                    <div class="col-2">
                        <h5><b>Prodotto</b></h5>
                    </div>
                    <div class="col-2">
                        <h5><b>Utente</b></h5>
                    </div>
                    <div class="col-2">
                        <h5><b>Azione</b></h5>
                    </div>
                </div>
                <hr>
                <?php
                $reviewMgr = new ReviewManager();
                $reviews = $reviewMgr->getAllOrder();
                ?>
                <?php foreach ($reviews as $review) : ?>

                    <div class="row">
                        <p class="card-text">
                        <div class="col-1">
                            <?php echo $review['vote']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $review['title'];
                            ?>
                        </div>
                        <div class="col-3">
                            <?php echo $review['message']; ?>
                        </div>
                        <?php $productMgr = new ProductManager();
                        $product = $productMgr->getName($review['product_id']);
                        ?>
                        <div class="col-2">
                            <?php echo $product[0]['name']; ?>
                        </div>
                        <?php $userMgr = new UserManager;
                        $users = $userMgr->getName($review['user_id']);
                        $user = $userMgr->getSurname($review['user_id']);
                        ?>
                        <div class="col-2">
                            <?php echo $users[0]['name'].", ".$user[0]['surname'];
                                
                            ?>
                        </div>
                        <div class="col-2">
                            <?php if($review['blocked'] == 0) :?>
                                <form action="./block.php" method="POST">
                                <input type="text" hidden="hidden" id="id" name="id" value="<?php echo $review['id']; ?>" style="visibility: none;"></input>
                                <input type="submit" class="btn btn-danger" value="Blocca"></input>
                                </form>
                            <?php else : ?>
                                <form action="./unlock.php" method="POST">
                                <input type="text" hidden="hidden" id="id" name="id" value="<?php echo $review['id']; ?>" style="visibility: none;"></input>
                                <input type="submit" class="btn btn-success" value="Sblocca"></input>
                                </form>
                            <?php endif; ?>
                        </div>
                        </p>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<div class="col-lg-2 px-md-4"></div>
                



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>