<?php
    include "../../../inc/init.php";

    if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
        header("Location: " . ROOT_URL);
    }
    

    $message = $_POST["message"];
    $chatID=$_POST["chat_id"];
    
    if($chatID=="broadcast"){
        $broadcast=1;
    }else{
        $broadcast=0; 
    }

    $messageMgr = new MessageManager();

    if($broadcast == 0){
        $messageMgr->newMessage($chatID,addslashes($message));
        header("Location: ".ROOT_URL."admin/pages/message/message.php?chat=".$chatID);
    }else{
        $chatMgr = new ChatManager();
        $chats = $chatMgr->getAll();
        foreach($chats as $chat){
            $messageMgr->newMessageB($chat->id,addslashes($message));
        }
        header("Location: ".ROOT_URL."admin/pages/message/message.php");
    }

?>