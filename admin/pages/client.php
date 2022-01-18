<?php include "../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Clienti</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<?php
    $userMgr = new UserManager();
    $chatMgr = new ChatManager();

    $users = $userMgr->getClient();
    
    $chatf = array();

    foreach($users as $user){
        $chat = $chatMgr->getUserChat($user['id']);
        $chatid=$chat[0]['id'];
        array_push($chatf,$chatid);
    }

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . '/templates/admin/');
    $twig = new \Twig\Environment($loader, []);
    
    echo $twig->render('client.html', [
        'ROOT_URL' => ROOT_URL,
        'users' => $users,
        'chat' => $chatf
        
    ]);
?>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>