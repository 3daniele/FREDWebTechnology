<?php include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
include ROOT_PATH . "public/template-parts/title.php";
include ROOT_PATH . "public/template-parts/header.php";

$chatMgr = new ChatManager();
$messageMgr = new MessageManager();

$chatUser = $chatMgr->getUserChat($_SESSION["userid"]);

for ($i = 0; $i < count($chatUser); $i++) {
    $messages[] = $messageMgr->getMessageTotal($chatUser[$i]['id']);
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user');
$twig = new \Twig\Environment($loader, []);

    echo $twig->render('notification.html', [
        'ROOT_URL' => ROOT_URL,
        'messages' => $messages  
    ]);
?>

<?php include ROOT_PATH . "public/template-parts/footer.php";?>