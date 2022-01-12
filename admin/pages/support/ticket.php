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
                <div class="col-4">
                    <h2 class="text-primary">Aperto:<?php echo " " . $ticket->date; ?></h2>
                </div>
                <div class="col-3 text-end">
                    <div class="row">
                        <div class="col-4"></div>
                        <div class="col-5 text-end">
                            <?php if ($ticket->order_id != null) : ?>
                                <input class="btn btn-primary" type="submit" value="Visualizza ordine"></input>
                            <?php endif; ?>
                        </div>
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
                    <?php if ($ticket->order_id != null) : ?>
                        <div class="row">
                            <span class="text-primary">
                                <h4><strong>Data ordine:</strong></h4>
                            </span>


                        </div>
                        <div class="row">

                            <?php $orderMgr = new OrdersManager();
                            $order = $orderMgr->get($ticket->order_id);
                            ?>
                            <input class="form-control" id="name" name="name" type="text" value="<?php echo $order->date_order; ?>" disabled></input>


                        </div>
                        <hr>
                    <?php endif; ?>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Oggetto:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <input class="form-control" id="object" name="object" type="text" value="<?php echo $ticket->object; ?>" disabled></input>
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
                            <h4><strong>Risposta:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <?php $answerMgr = new AnswerManager();
                        $answer = $answerMgr->getBySupport($ticket->id);
                        ?>
                        <textarea class="form-control" id="answer" name="answer" type="text-area" style="width: 100%; height: 150px; " <?php if ($ticket->status == 1) echo "disabled"; ?>><?php echo (string)$answer[0]['message']; ?></textarea>
                    </div>
                    <hr>
                </div>
                <div class="col-md-4 col-lg-4 px-md-4">
                    <?php $userMgr = new UserManager();
                    $user = $userMgr->get($ticket->user_id);
                    ?>
                    
                    <div class="row">
                        <div class="col-6">
                            <div class="row">
                                <span class="text-primary">
                                    <h4><strong>Codice utente:</strong></h4>
                                </span>
                            </div>
                            <div class="row">
                                <label>
                                    <h5>
                                        <?php echo $user->id; ?>
                                    </h5>
                                </label>

                            </div>
                            <hr>
                            <div class="row">
                                <span class="text-primary">
                                    <h4><strong>Nome:</strong></h4>
                                </span>
                            </div>
                            <div class="row">
                                <label>
                                    <h5><?php echo " " . $user->name ?></h5>
                                </label>
                            </div>
                            <hr>
                            <div class="row">
                                <span class="text-primary">
                                    <h4><strong>Cognome:</strong></h4>
                                </span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card border-light " style="width: 50%; border:none;">
                                <div class="text-center">
                                    <img class="rounded-circle text-center" src=<?php echo ROOT_URL . $user->img; ?> class="card-img-top" alt="..."></img>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label>
                            <h5><?php echo " " . $user->surname ?></h5>
                        </label>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Ticket aperti:</strong></h4>
                            <?php $countticket = $supportMgr->countTicket($user->id);?>
                        </span>
                    </div>
                    <div class="row">
                        <label>
                            <h5><?php echo $countticket[0]['nticket'] ; ?></h5>
                        </label>
                    </div>
                    <hr>
                    <div class="row">
                        <span class="text-primary">
                            <h4><strong>Ordini effettuati:</strong></h4>
                        </span>
                    </div>
                    <div class="row">
                        <label>
                            <h5>TOTALE ORDINI</h5>
                        </label>
                    </div>
                    <hr>



                </div>
            </div>
            </form>
</main>


<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>