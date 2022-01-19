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
$users = array();
foreach ($chat as $c){
    $user = $userMgr->get($c['user_id']);
    array_push($users, $user);
}

if(isset($_GET['chat'])){
    $chat_id = $_GET['chat'];
    $chatuser = $userMgr->get($chatMgr->get($chat_id)->user_id);

    $messages = $messageMgr->getMessage($chat_id);

}else{
    $chat_id = null;
}


$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/message/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('message.html', [
    'ROOT_URL' => ROOT_URL,
    'users' => $users,
    'chat' => $chat,
    'chat_id' => $chat_id,
    'chatuser' => $chatuser,
    'messages' => $messages
    
]);
?>




<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

