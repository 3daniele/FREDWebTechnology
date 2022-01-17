<?php
include "../../../inc/init.php";

if (isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}


include ROOT_PATH . "public/template-parts/title.php";

include ROOT_PATH . "public/template-parts/header.php";

/*
// costanti
define('NORMAL_FORM', 'class="form-control"');
define('VALID_FORM', 'class="form-control is-valid"');
define('INVALID_FORM', 'class="form-control is-invalid error"');
define('NONE', 'style="display: none"');
define('TRUE', 'style="display: true"');
define('VALUE', 'value="');
define('END', '"');


// css dinamico 
$display = NONE;

$formEmail = NORMAL_FORM;
$formPassword = NORMAL_FORM;

$emailValue = "";


// logica login
$emailErr = "";
$passwordErr = "";
$error = "";

$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["email"])) {
        $formEmail = INVALID_FORM;
        $emailErr = "Inserisci il tuo indirizzo email";
    } elseif (empty($_POST["password"])) {
        $formEmail = VALID_FORM;
        $emailValue = VALUE . $_POST["email"] . END;
        $formPassword = INVALID_FORM;
        $passwordErr = "Inserisci la tua password";
    } else {
        testInput();
    }
}

// helper per le validation rules
function testInput()
{
    $userMgr = new UserManager();

    global $display, $error, $formEmail, $emailValue, $formPassword;

    $email = $_POST["email"];
    $password = $_POST["password"];

    $passHash = hash("sha1", $password);

    $login = $userMgr->login($email, $passHash);

    if ($login == null) {
        $display = TRUE;
        if ($userMgr->checkEmail($email)) {
            $formEmail = VALID_FORM;
            $emailValue = VALUE . $_POST["email"] . END;
            $formPassword = INVALID_FORM;
            $error = "Password non corretta!";
        } else {
            $formEmail = INVALID_FORM;
            $error = "Email non corretta!";
        }
    } else {
        // login
        $_SESSION["email"] = $email;
        foreach ($login as $log) {
            $_SESSION["img"] = $log["img"];
            $_SESSION["admin"] = $log["user_type"];
            $_SESSION["name"] = $log["name"];
            $_SESSION["userid"] = $log["id"];
        }
        // sincronizzazione dei carrelli
        $cartMgr = new CartManager();

        $cartID = $cartMgr->findCart($_SESSION["userid"]);
        $currentCartID = $cartMgr->getCurrentCartId();
        if($cartID != $currentCartID){
            $cartMgr->mergeCarts($cartID, $currentCartID);
        }
        

        // redirect alla home
        header("Location: " . ROOT_URL . "shop");
    }
}
*/

$email = $_POST["email"];
$password = $_POST["password"];

$passHash = hash("sha1",$password);

$userMgr = new UserManager();
$login = $userMgr->login($email, $passHash);

if ($login == null) {
    //ALERT
}else{
    $_SESSION["email"] = $email;
    foreach ($login as $log) {
        $_SESSION["img"] = $log["img"];
        $_SESSION["admin"] = $log["user_type"];
        $_SESSION["name"] = $log["name"];
        $_SESSION["userid"] = $log["id"];
    }
    //header("Location: " . ROOT_URL . "shop");
}

$loader = new \Twig\Loader\FilesystemLoader(ROOT_PATH . 'templates/public/auth');
$twig = new \Twig\Environment($loader, []);

echo $twig->render('login.html', [
    'ROOT_URL' => ROOT_URL,
]);

/*
<!--div per stampare a video eventuali messaggi di errori-->
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <div class="alert alert-dismissible alert-danger text-center"  echo $display; >
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong> echo $error </strong>
        </div>
    </div>
</div>
*/


include ROOT_PATH . "public/template-parts/footer.php";
