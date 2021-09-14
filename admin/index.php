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
                    <?php 
                        $orderMgr = new OrdersManager();
                        $orders = $orderMgr->getLastOrders();
                        $i=0;
                        foreach($orders as $order) : $i++;
                    ?>

                    <div class="row">
                    <p class="card-text">
                        <div class="col-1">
                            <?php echo $order['id']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $order['date_order']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $order['status']; ?>
                        </div>
                        <div class="col-2">
                            <?php
                                $userMgr = new UserManager();
                                $users = $userMgr->getName($order['user_id']);
                                echo $users[0]['name']. ", ";
                                $users = $userMgr->getSurname($order['user_id']);
                                echo $users[0]['surname'];
                            ?>
                        </div>
                        <div class="col-5">
                            <?php
                                $orderAddressMgr = new OrderAddressManager();
                                $addressinfo = $orderAddressMgr->getAddressByOrder($order['id']);
                                $string = $addressinfo[0]['address'].", ".$addressinfo[0]['city_name'].", ".$addressinfo[0]['code'].", ".$addressinfo[0]['provinces_name']."."; 
                            echo $string; ?>
                        </div>
                    </p>
                    </div>
                    <?php if($i != count($orders)) : ?>
                        <hr>
                        <?php endif; ?>
                    <?php endforeach; ?>
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
                        $i = 0;
                        foreach($reviews as $review) : $i++;
                    ?>
                    <div class="row">
                    <p class="card-text">
                        <div class="col-1">
                            <?php echo $review['vote']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $review['title']; ?>
                        </div>
                        <div class="col-5">
                            <?php echo $review['message']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $review['product']; ?>
                        </div>
                        <div class="col-2">
                            <?php echo $review['user']; ?>
                        </div>
                    </p>
                    </div>
                    <?php if($i != count($reviews)) : ?>
                        <hr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                    

                </div>
            </div>
            <hr>

        </div>
        <div class="col-md-4 col-lg-4 px-md-4">
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
                    $i=0;
                    foreach ($products as $product) : $i++;?>
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
                        <?php if($i != count($products)) : ?>
                        <hr>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>

                </div>
            </div>


        </div>

    </div>
</main>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>