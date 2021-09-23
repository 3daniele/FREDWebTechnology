<?php include "../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Clienti</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 col-lg-8 px-md-4">
    <div class="row border-bottom">
        <div class="col-4">
            <h2><strong class="text-primary">Clienti</strong></h2>
        </div>
        <div class="col-4"></div>
        <div class="col-2 text-end"></div>
        <div class="col-2 text-end">
            <form>
                <input type="search" class="form-control" placeholder="Cerca utente" aria-label="Search">
            </form>
        </div>
    </div>
    <div class="card" style="border: none;">
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <h5><b></b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Nome</b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Cognome</b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Email</b></h5>
                </div>
                <div class="col-2">
                    <h5><b>Tipo</b></h5>
                </div>
                <div class="col-2 text-end">
                    <h5><b>Azione</b></h5>
                </div>
            </div>
            <hr>
            <?php
            $userMgr = new UserManager();
            $users = $userMgr->getClient();
            ?>
            <?php foreach ($users as $user) : ?>
            <div class="row">
                <p class="card-text">
                <div class="col-2">
                    <img src="<?php echo ROOT_URL . $user['img'] ?>" width=100px height=100px class="rounded-circle">
                </div>
                <div class="col-2">
                    <?php echo $user['name']; ?>
                </div>
                <div class="col-2">
                    <?php echo $user['surname']; ?>
                </div>
                <div class="col-2">
                    <?php echo $user['email']; ?>
                </div>
                <div class="col-2">
                    <?php if($user['user_type']) :?>
                    Utente
                    <?php else :?>
                    Admin
                    <?php endif;?>
                </div>
                <div class="col-2 text-end">
                    <a class="btn btn-primary" href="<?php echo ROOT_URL; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                                <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                                 </svg> Chat</a>
                </div>
                </p>
            </div>
            <hr>
            <?php endforeach; ?>
        </div>
</main>
<div class="col-lg-1 px-md-4"></div>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>