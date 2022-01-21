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

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/admin/support');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('ticket.html', [
    'ROOT_URL' => ROOT_URL,
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