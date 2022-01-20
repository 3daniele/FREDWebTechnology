<?php
include "../inc/init.php";

    if (!isset($_SESSION["email"]) ) {
        header("Location: " . ROOT_URL);
    }
    
    $userMgr = new UserManager();
    $user = $userMgr->data($_SESSION["email"]);

    $name_user= $_POST["name_user"];
    $surname_user= $_POST["surname_user"];
    $email_user = $_POST["email_user"];
    $password = $_POST["password"];
    $new_password2 = $_POST["new_password2"];
    $new_password= $_POST["new_password"];
    if($new_password == $new_password && hash("sha1",$password) == $user[0]['password'] ){
        $new_passwordh= hash("sha1",$new_password);
        $userap = $userMgr->updateUser($user[0]['id'], $name_user, $surname_user,$email_user,$new_passwordh);
    }
   
    
       

        header("Location: ".ROOT_URL."user/account.php");
?>