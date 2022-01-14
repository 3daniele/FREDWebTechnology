<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Messaggi</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 col-lg-8 px-md-4">
    <div class="row border-bottom">
        <div class="col-4">
            <h2><strong class="text-primary">Messaggi</strong></h2>
        </div>
        <div class="col-4"></div>
        <div class="col-2 text-end">
        </div>
        <div class="col-2 text-end" style="margin-top : 5px;"><a href="" data-bs-toggle="modal" data-bs-target="#modal"
                data-whatever="add"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor"
                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path
                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd"
                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg></a>
        </div>
    </div>
    <div class="row" style="margin-top: 10px;">
        <div class="col-md-3 col-lg-3 px-md-4">
            <?php
            $chatMgr = new ChatManager();
            $userMgr = new UserManager();
            $messageMgr = new MessageManager();
            $chat = $chatMgr->getAllChat();
            $i = 0;
            foreach ($chat as $c) :

                $user = $userMgr->get($c['user_id']);

            ?>
            <form method="GET">
                <?php $path = "admin/pages/message/message.php?chat=" . $c['id']; ?>
                <?php if ($i == 0) : ?>
                <div class="card" style="cursor:pointer; width: 18rem;"
                    onclick="location.href='<?php echo ROOT_URL . $path; ?>'">
                    <?php else : ?>
                    <div class="card" style="cursor:pointer; width: 18rem; border-top:none;"
                        onclick="location.href='<?php echo ROOT_URL . $path; ?>'">
                        <?php endif; ?>
                        <div class="card-body">
                            <p class="card-text">
                            <div class="row">
                                <div class="col-4 text-end">
                                    <?php if ($user->img != null) : ?>
                                    <img alt="immagine" width=70px class="rounded-circle"
                                        src=<?php echo ROOT_URL . $user->img; ?>>
                                    <?php else : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width=70px fill="currentColor"
                                        class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path
                                            d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                                        <path fill-rule="evenodd"
                                            d="M5.216 14A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216z" />
                                        <path d="M4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5z" />
                                    </svg>
                                    <?php endif; ?>
                                </div>
                                <div class="col-7">
                                    <div class="row">
                                        <?php if ($user->img != null) : ?>
                                        <b><?php echo $user->name . " " . $user->surname; ?></b>
                                        <?php else : ?>
                                        <b>Broadcast</b>
                                        <?php endif; ?>

                                    </div>
                                    <div class="row">
                                        <?php $message = $messageMgr->getLast($c['id']);
                                            echo substr($message[0]['message'], 0, 30) . "...";
                                            ?>
                                    </div>
                                </div>
                            </div>
                            </p>
                        </div>
                    </div>
            </form>
            <?php $i++;
            endforeach; ?>

        </div>
        <div class="col-lg-1 px-md-4"></div>
        <div class="col-md-9 col-lg-8 px-md-4">
            <?php 
                if(isset($_GET['chat'])) :
            ?>
            <?php $chat_id = $_GET['chat'];  ?>
            <div class="card">
                <div class="card-header">
                    <?php $user = $userMgr->get($chatMgr->get($chat_id)->user_id);?>
                    <div class="row">
                        <div class="col-1">
                            <img alt="immagine" width=40px class="rounded-circle"
                                src=<?php echo ROOT_URL . $user->img; ?>>
                        </div>
                        <div class="col-11" style="margin-top: 6px;">
                            <strong><?php echo $user->name." ".$user->surname; ?></strong>
                        </div>
                    </div>
                </div>
                <div class="card-body">


                    <?php 
                $messages = $messageMgr->getMessage($chat_id);
                foreach($messages as $message) :
            ?>
                    <p class="card-text">
                    <h5>
                        <?php if($message['broadcast']==0) :?>
                        <span class="badge rounded-pill bg-primary">
                            <?php else: ?>
                            <span class="badge rounded-pill bg-success">
                                <?php endif; ?>

                                <?php echo $message['message']; ?>
                            </span>
                    </h5>
                    <span style="font-size:smaller"><?php echo $message['date']; ?></span>
                    </p>

                    <?php endforeach; ?>
                    <div class="row">
                        <hr>
                        <form action="send.php" method="POST">
                            <input type="hidden" id="chat_id" name="chat_id" value="<?php echo $chat_id ?>">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="message" name="message"
                                    placeholder="Cosa vuoi inviare?">
                                <label for="floatingInput">Scrivi...</label>
                            </div>
                            <input type="submit" class="btn btn-primary btn-sm" value="Invia">
                        </form>
                    </div>
                </div>
            </div>


            <?php endif;?>
        </div>
    </div>


</main>
<div class="col-lg-1 px-md-4"></div>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

<!-- Finestra di dialogo per la scrittura della recensione -->
<!-- Modal -->
<form method="POST" action="./send.php">
    <div class="modal" id="modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-primary"><strong id="modalTitle">Scrivi un nuovo messaggio</strong></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php
                        $chats = $chatMgr->getAll();
                    ?>
                    <p>Seleziona utenti</p>
                    <select class="form-select" aria-label="selezione utenti" aria-label="size 3" id="chat_id" name="chat_id">
                        <option selected value="broadcast">Tutti</option>
                        <?php foreach ($chats as $chat) : ?>
                        <?php $user = $userMgr->get($chat->user_id);?>
                        <option value="<?php echo $chat->id ?>"><?php echo $user->name." ".$user->surname; ?></option>
                        <?php endforeach; ?>
                        
                    </select>
                    <p></p>
                    <p>Messaggio</p>
                    <textarea class="form-control" name="message" id="message" name="message" rows="4"
                        placeholder="Scrivi..."></textarea>
                </div>

                <div class="modal-footer">
                    <button id="modalBtn" type="submit" class="btn btn-primary" name="add">Invia</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Chiudi</button>
                </div>

            </div>
        </div>
</form>