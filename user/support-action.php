<?php
    include "../inc/init.php";

    $userid = $_SESSION['userid'];
    $object = $_POST['object'];
    $message = $_POST['message'];
    $orderid = $_POST['orderid'];

    $supportMgr = new SupportManager();
    
    if($orderid == NULL){
        $supportMgr->addSupport($userid,$object,$message);
    }else{
       $supportMgr->addSupportOrder($userid,$object,$message,$orderid);
    }
    
    $last = $supportMgr->getLast($userid);
    
    

    header("Location:". ROOT_URL . "user/ticket-support.php?ticket=".$last[0]['id']);
    

?>