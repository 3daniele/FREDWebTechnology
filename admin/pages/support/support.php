<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Supporto</title>

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
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h2><strong class="text-primary">Supporto</strong></h2>
    </div>
    <div class="row">
        <div class="col-10">
            <?php $supportMgr = new SupportManager(); ?>

            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-bs-toggle="tab" href="#open">Aperti</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#close">Chiusi</a>
                </li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <?php $openTickets = $supportMgr->getOpenTicket(); ?>
                <div class="tab-pane fade active show" id="open">
                    <br>
                    <?php foreach ($openTickets as $ticket) : ?>
                        <div class="card" style="cursor:pointer;" onclick="location.href='<?php echo ROOT_URL . 'admin/pages/support/ticket.php?ticket='. $ticket['id'] ?>'">
                            <div class="card-header">
                                <?php echo $ticket['object'] ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $ticket['message']?></p>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
                <div class="tab-pane fade" id="close">
                    <br>
                    <?php $closeTickets = $supportMgr->getCloseTicket(); ?>
                    <?php foreach ($closeTickets as $ticket) : ?>
                        <div class="card" style="cursor:pointer;" onclick="location.href='<?php echo ROOT_URL . 'admin/pages/support/ticket.php?ticket='. $ticket['id'] ?>'">
                            <div class="card-header">
                                <?php echo $ticket['object'] ?>
                            </div>
                            <div class="card-body">
                                <p class="card-text"><?php echo $ticket['message']?></p>
                            </div>
                        </div>
                        <hr>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</main>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>