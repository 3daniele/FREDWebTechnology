<?php include "../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

$ticketid = $_GET["ticket"];

$supportMgr = new SupportManager();
$ticket = $supportMgr->get($ticketid);

if($ticket->user_id != $_SESSION['userid']){
    header("Location: ".ROOT_URL."user/support.php");
}

?>

<?php include ROOT_PATH . "public/template-parts/title.php" ?>

<title>Ticket numero<?php echo " " . $ticket->id; ?></title>

<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>

<?php
$orderMgr = new OrdersManager();
$order = $orderMgr->get($ticket->order_id);

$answerMgr = new AnswerManager();
$answert = $answerMgr->getBySupport($ticket->id);
$answer = $answert[0]['message'];

$userMgr = new UserManager();
$user = $userMgr->get($ticket->user_id);

$imgpath = ROOT_URL . $user->img;

$counttickets = $supportMgr->countTicket($user->id);
$countticket = $counttickets[0]['nticket'];

$orderUser = $orderMgr->getOrder($user->id);
$countOrder = count($orderUser);

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/user/');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('ticket-support.html', [
    'ticket' => $ticket,
    'order' => $order,
    'answer' => $answer,
    'user' => $user,
    'countticket' => $countticket,
    'imgpath' => $imgpath,
    'countorder' => $countOrder

]);

?>

<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>