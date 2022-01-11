<?php include "../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Dashboard</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
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
                                <a href="<?php echo ROOT_URL . 'admin/pages/order.php'; ?>" class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <b> #</b>
                        </div>
                        <div class="col-2">
                            <b>Data</b>
                        </div>
                        <div class="col-2">
                            <b>Stato</b>
                        </div>
                        <div class="col-2">
                            <b>Utente</b>
                        </div>
                        <div class="col-5">
                            <b>Indirizzo</b>
                        </div>
                    </div>
                    <hr>
                    <?php
                    $orderMgr = new OrdersManager();
                    $orders = $orderMgr->getLastOrders();
                    $i = 0;
                    foreach ($orders as $order) : $i++;
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
                                echo $users[0]['name'] . ", ";
                                $users = $userMgr->getSurname($order['user_id']);
                                echo $users[0]['surname'];
                                ?>
                            </div>
                            <div class="col-5">
                                <?php
                                $orderAddressMgr = new OrderAddressManager();
                                $addressinfo = $orderAddressMgr->getAddressByOrder($order['id']);
                                $string = $addressinfo[0]['address'] . ", " . $addressinfo[0]['city_name'] . ", " . $addressinfo[0]['code'] . ", " . $addressinfo[0]['provinces_name'] . ".";
                                echo $string; ?>
                            </div>
                            </p>
                        </div>
                        <?php if ($i != count($orders)) : ?>
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
                                <a href="<?php echo ROOT_URL . 'admin/pages/support/support.php'; ?>" class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <?php $supportMgr = new SupportManager();
                    $tickets = $supportMgr->showOpenTicket();
                    $i = 0;
                    foreach ($tickets as $ticket) : $i++;
                    ?>
                        <p class="card-text"><strong><?php echo $ticket['object'] ?></strong><br><?php echo $ticket['message'] ?></p>
                        <?php if ($i < 3) : ?>
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
                                <h4><b>Nuove recensioni:</b></h4>
                            </div>
                            <div class="col-3 text-end">
                                <a href="<?php echo ROOT_URL . 'admin/pages/review/review.php'; ?>" class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-1">
                            <b><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
                                    <path d="M5.354 5.119 7.538.792A.516.516 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.537.537 0 0 1 16 6.32a.548.548 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.52.52 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.58.58 0 0 1 .085-.302.513.513 0 0 1 .37-.245l4.898-.696zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.565.565 0 0 1 .162-.505l2.907-2.77-4.052-.576a.525.525 0 0 1-.393-.288L8.001 2.223 8 2.226v9.8z" />
                                </svg></b>
                        </div>
                        <div class="col-2">
                            <b>Titolo</b>
                        </div>
                        <div class="col-5">
                            <b>Descrizione</b>
                        </div>
                        <div class="col-2">
                            <b>Prodotto</b>
                        </div>
                        <div class="col-2">
                            <b>Utente</b>
                        </div>
                    </div>
                    <hr>
                    <?php $reviewMgr = new ReviewManager();
                    $reviews = $reviewMgr->getLastReview();
                    $i = 0;
                    foreach ($reviews as $review) : $i++;
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
                        <?php if ($i != count($reviews)) : ?>
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
                                <a href="<?php echo ROOT_URL . 'admin/pages/product/product.php'; ?>" class="btn btn-primary btn-sm">Gestisci &raquo;</a>
                            </div>
                        </div>
                    </span>


                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-7">
                            <b>Prodotto</b>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-3 text-end">
                            <b>Stock</b>
                        </div>
                    </div>
                    <hr>
                    <?php $productMgr = new ProductManager();
                    $products = $productMgr->getEsaurimenti();
                    $i = 0;
                    foreach ($products as $product) : $i++; ?>
                        <div class="row">
                            <p class="card-text">
                            <div class="col-7"><?php echo $product['name']; ?></div>
                            <div class="col-2"></div>
                            <?php if ($product['stock'] <= 5) : ?>
                                <div class="col-3 text-end text-danger">
                                <?php else : ?>
                                    <div class="col-3 text-warning text-end">
                                    <?php endif; ?>
                                    <?php
                                    echo ("<b>");
                                    echo $product['stock'];
                                    echo ("</b></span>");
                                    ?>
                                    </div>
                                    </p>
                                    <?php if ($i != count($products)) : ?>
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