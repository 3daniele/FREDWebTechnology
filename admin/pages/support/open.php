<?php include "../../../inc/init.php";?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php 
    $ticketid = $_POST['id'];
    $status = 0;
    $supportMgr = new SupportManager();
    $supportMgr->updateTicket($ticketid,$status);

    $answerMgr = new AnswerManager();

    $answerMgr->DeleteAnswer($ticketid);

    header("Location: " . ROOT_URL. 'admin/pages/support/ticket.php?ticket=' . $ticketid);

?>