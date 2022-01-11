<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_SESSION["admin"] == 1 || !isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL . "admin/index.php");
}

$ticketid = $_GET["ticket"];

$supportMgr = new SupportManager();
$ticket = $supportMgr->get($ticketid);
?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>

<title>Ticket numero<?php echo " " . $ticket->id; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <?php if ($ticket->status == 1) : ?>
        <form action="./open.php" method="POST">
        <?php else : ?>
            <form action="./close.php" method="POST">
            <?php endif; ?>


            <input type="text" hidden="hidden" id="id" name="id" value="<?php echo $ticket->id; ?>" style="visibility: none;"></input>
            <div class="row border-bottom">
                <div class="col-4">
                    <h2><strong class="text-primary">Ticket numero:<?php echo " " . $ticket->id; ?></strong></h2>
                </div>
                <div class="col-4"></div>
                <div class="col-3 text-end">
                    <div class="row">
                        <div class="col-5"></div>
                        <div class="col-4"></div>
                        <?php if ($ticket->status == 1) : ?>
                            <div class="col-2 text-end"><input class="btn btn-success" type="submit" value="Apri"></input></div>
                        <?php else : ?>
                            <div class="col-2 text-end"><input class="btn btn-danger" type="submit" value="Chiudi"></input></div>
                        <?php endif; ?>
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
                            <h4><strong>Oggetto:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <input class="form-control" id="name" name="name" type="text" value="<?php echo $ticket->object; ?>" disabled></input>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Descrizione:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <textarea class="form-control" id="description" name="description" type="text-area" style="width: 100%; height: 250px; " disabled><?php echo (string)$ticket->message; ?></textarea>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Numero ordine:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <input class="form-control" id="name" name="name" type="text" value="<?php echo $ticket->order_id; ?>" disabled></input>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Dettagli ordine:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <textarea class="form-control" id="small_description" name="small_description" type="text-area" style="width: 100%; height: 150px; "><?php echo (string)$product->small_description; ?></textarea>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4 col-lg-4 px-md-4">
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Info utente</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <input class="form-control text-end" id="price" name="price" type="Text" value="<?php echo $product->price; ?>"></input>
                    </div>
                    <hr>

                </div>
            </div>
            </form>
</main>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>