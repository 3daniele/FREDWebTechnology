<?php include "../inc/init.php"; ?>

<?php if ($_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Dashboard</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="chartjs-size-monitor">
        <div class="chartjs-size-monitor-expand">
            <div class=""></div>
        </div>
        <div class="chartjs-size-monitor-shrink">
            <div class=""></div>
        </div>
    </div>
    <div
        class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><strong class="text-primary">Dashboard</strong></h2>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-7">
            <div class="card">
                <div class="card-header">

                    <span class="text-primary">
                        <div class="row">
                            <div class="col-9">
                                <h4><b>Ultimi ordini:</b></h4>
                            </div>
                            <div class="col-3 text-end">
                                <a href="<?php echo ROOT_URL . 'admin/pages/order.php'; ?>"
                                    class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <hr>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <hr>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

                </div>
            </div>
            <hr>

            <div class="card">
                <div class="card-header">
                    <span class="text-primary">
                        <div class="row">
                            <div class="col-9">
                                <h4><b>Ticket aperti:</b></h4>
                            </div>
                            <div class="col-3 text-end">
                                <a href="<?php echo ROOT_URL . 'admin/pages/support.php'; ?>"
                                    class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <hr>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                    <hr>
                    <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                </div>
            </div>
            <hr>

            <div class="card">
                <div class="card-header">

                    <span class="text-primary">
                        <div class="row">
                            <div class="col-9">
                                <h4><b>Nuove recensioni:</b></h4>
                            </div>
                            <div class="col-3 text-end">
                                <a href="<?php echo ROOT_URL . 'admin/pages/review.php'; ?>"
                                    class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <?php $reviewMgr = new ReviewManager();
                        $reviews = $reviewMgr->getLastReview();
                        foreach($reviews as $review) :
                    ?>
                    <p class="card-text">
                    
                    </p>
                    <hr>
                    <?php endforeach; ?>
                    

                </div>
            </div>
            <hr>

        </div>
        <div class="col-md-3 col-lg-3 px-md-4">
            <div class="card">
                <div class="card-header">

                    <span class="text-primary">
                        <div class="row">
                            <div class="col-7">
                                <h4><b>In esaurimento:</b></h4>
                            </div>
                            <div class="col-5 text-end">
                                <a href="<?php echo ROOT_URL . 'admin/pages/product.php'; ?>"
                                    class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <?php $productMgr = new ProductManager();
                    $products = $productMgr->getEsaurimenti();
                    foreach ($products as $product) : ?>
                    <div class="row">
                        <p class="card-text">
                        <div class="col-7"><?php echo $product['name']; ?></div>
                        <div class="col-2"></div>
                        <?php if ($product['stock'] <= 5) :?>
                            <div class="col-3 text-danger text-end">
                            <?php else :?>
                            <div class="col-3 text-warning text-end">
                        <?php endif; ?>
                            <?php
                                echo("<b>");
                                echo $product['stock']; 
                                echo ("</b></span>");
                            ?>
                            </div>
                        </p>
                        <hr>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>

    </div>
</main>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>