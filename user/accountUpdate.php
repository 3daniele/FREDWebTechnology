<?php
include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$userMgr = new UserManager();
$user = $userMgr->data($_SESSION["email"]);

$name_user = $_POST["name_user"];
$surname_user = $_POST["surname_user"];
$email_user = $_POST["email_user"];
$password = $_POST["password"];
$new_password2 = $_POST["new_password2"];
$new_password = $_POST["new_password"];
if ($new_password == $new_password && hash("sha1", $password) == $user[0]['password']) {
    $new_passwordh = hash("sha1", $new_password);
    $userap = $userMgr->updateUser($user[0]['id'], $name_user, $surname_user, $email_user, $new_passwordh);
}

// upload immagine
if (isset($_FILES)) {

    $tmp = $_FILES['image']['tmp_name'];
    $folder = ROOT_PATH . "public/img/user"; //cartella di destinazione dell'immagine
    $name = "/" . $_SESSION['email'];
    $ext = ".png";

    if (is_uploaded_file($tmp)) {
        $uploadDir = $folder . $name . $ext; //aggiungo il folder di destinazione
        if (move_uploaded_file($tmp, $uploadDir)) {
            $userID = $_SESSION['userid'];
            $email = $_SESSION['email'];
            $_SESSION['img'] = "public/img/user/" . $email . ".png";
            
            $userMgr->updateImg($userID, $email);
        } else {
            echo "Non è stato possibile caricare l'immagine<br/>";
        }
    }
}
header("Location: " . ROOT_URL . "user/account.php");
