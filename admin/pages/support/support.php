<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Supporto</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php 
    $supportMgr = new SupportManager();
    $openTicket = $supportMgr->getOpenTicket();
    $closeTicket = $supportMgr->getCloseTicket();
    $redirect = ROOT_URL . 'admin/pages/support/ticket.php?ticket=';

    $loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/admin/support');
    $twig = new \Twig\Environment($loader, []);

    echo $twig->render('support.html', [
        'openTicket' => $openTicket,
        'closeTicket' => $closeTicket,
        'redirect' => $redirect
    ]);
?>

<?php include ROOT_PATH . "public/template-parts/footer.php";?>