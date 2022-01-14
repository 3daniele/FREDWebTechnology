<?php include "../../../inc/init.php";?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php 
    $ticketid = $_POST['id'];
    $answer = $_POST['answer'];
    $status = 1;
    $supportMgr = new SupportManager();
    $supportMgr->updateTicket($ticketid,$status);

    $answerMgr = new AnswerManager();

    $answerMgr->insertAnswer($_SESSION['userid'],$ticketid,$answer);

    header("Location: " . ROOT_URL. 'FREDWebTechnology/admin/pages/support/ticket.php?ticket=' . $ticketid);

?>