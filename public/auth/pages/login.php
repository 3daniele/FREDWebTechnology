<?php
include "../../../inc/init.php";

if (isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>
<?php
include ROOT_PATH . "public/template-parts/title.php";
?>
<title>Login</title>
<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<?php

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
?>

<!--div per stampare a video eventuali messaggi di errori-->
<div class="row">
    <div class="col-4"></div>
    <div class="col-4">
        <div class="alert alert-dismissible alert-danger text-center" <?php echo $display; ?>>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?php echo $error ?></strong>
        </div>
    </div>
</div>

<div class="container" id="main-area" style="margin-top: 25px;">
    <div class="row">
        <div class="col-4" style="margin-left: 9px;">
            <main class="form-signin">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <h1 class="h3 mb-3 fw-normal">Login</h1>

                    <div class="form-floating">
                        <input type="email" <?php echo $formEmail; ?> name="email" id="email" placeholder="name@example.com" <?php echo $emailValue; ?>>
                        <label for="floatingInput">Indirizzo Email</label>
                        <span>
                            <div class="errorLabel"><?php echo $emailErr; ?></div>
                        </span>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" <?php echo $formPassword; ?> name="password" id="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        <span class="cart-buttons">
                            <div class="errorLabel"><?php echo $passwordErr; ?></div>
                        </span>
                    </div>
                    <br>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Ricordami
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
                </form>
                <a href=".\register.php">Registrati</a>
            </main>
        </div>

        <div class="spazio" id="spazio_vuoto" style="margin-top: 80px;">

            <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>