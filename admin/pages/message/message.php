<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Messaggi</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php
$chatMgr = new ChatManager();
$userMgr = new UserManager();
$messageMgr = new MessageManager();



$chat = $chatMgr->getAllChat();


$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/message/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('message.html', [
    'ROOT_URL' => ROOT_URLs
    
]);
?>




<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

