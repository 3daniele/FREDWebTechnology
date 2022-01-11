<?php
include "../../../inc/init.php";
?>
<?php
include ROOT_PATH . "public/template-parts/title.php";
?>
<title>Sign-Up</title>
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

$formName = NORMAL_FORM;
$formSurname = NORMAL_FORM;
$formEmail = NORMAL_FORM;
$formPassword = NORMAL_FORM;
$formConfPassword = NORMAL_FORM;

$nameValue = "";
$surnameValue = "";
$emailValue = "";


// logica registrazione
$nameError = "";
$surnameError = "";
$emailErr = "";
$passwordErr = "";
$confPasswordErr = "";

$name = "";
$surname = "";
$email = "";
$password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        setFields("name");
        $formName = INVALID_FORM;
        $nameErr = "Inserisci il tuo nome";
    } elseif (empty($_POST["surname"])) {
        setFields("surname");
        $formSurname = INVALID_FORM;
        $surnameErr = "Inserisci il tuo cognome";
    } elseif (empty($_POST["email"])) {
        setFields("email");
        $formEmail = INVALID_FORM;
        $emailErr = "Inserisci il tuo indirizzo email";
    } elseif (empty($_POST["password"])) {
        setFields("password");
        $formPassword = INVALID_FORM;
        $formConfPassword = INVALID_FORM;
        $passwordErr = "Inserisci una password";
    } elseif (empty($_POST["confPassword"])) {
        setFields("password");
        $formPassword = INVALID_FORM;
        $formConfPassword = INVALID_FORM;
        $confPasswordErr = "Inserisci nuovamente la password";
    } else {
        testInput();
    }
}

// helper per la compilazione automatica dei campi già settati
function setFields($data)
{
    global $formName, $formSurname, $formEmail;
    global $nameValue, $surnameValue, $emailValue;

    if ($data == "name") {
        $formSurname = (empty($_POST["surname"])) ? NORMAL_FORM : VALID_FORM;
        $surnameValue = VALUE . $_POST["surname"] . END;
        $formEmail = (empty($_POST["email"])) ? NORMAL_FORM : VALID_FORM;
        $emailValue = VALUE . $_POST["email"] . END;
    } elseif ($data == "surname") {
        $formName = (empty($_POST["name"])) ? NORMAL_FORM : VALID_FORM;
        $nameValue = VALUE . $_POST["name"] . END;
        $formEmail = (empty($_POST["email"])) ? NORMAL_FORM : VALID_FORM;
        $emailValue = VALUE . $_POST["email"] . END;
    } elseif ($data == "email") {
        $formName = (empty($_POST["name"])) ? NORMAL_FORM : VALID_FORM;
        $nameValue = VALUE . $_POST["name"] . END;
        $formSurname = (empty($_POST["surname"])) ? NORMAL_FORM : VALID_FORM;
        $surnameValue = VALUE . $_POST["surname"] . END;
    } else {
        $formName = (empty($_POST["name"])) ? NORMAL_FORM : VALID_FORM;
        $nameValue = VALUE . $_POST["name"] . END;
        $formSurname = (empty($_POST["surname"])) ? NORMAL_FORM : VALID_FORM;
        $surnameValue = VALUE . $_POST["surname"] . END;
        $formEmail = (empty($_POST["email"])) ? NORMAL_FORM : VALID_FORM;
        $emailValue = VALUE . $_POST["email"] . END;
    }
}

// helper per le validation rules
function testInput()
{
    $userMgr = new UserManager();

    global $formEmail, $formPassword, $formConfPassword;
    global $display;
    global $error;

    $name = $_POST["name"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confPassword = $_POST["confPassword"];

    $passHash = hash("sha1", $password);
    $confPassHash = hash("sha1", $confPassword);

    $checkPassword = $userMgr->checkPassword($passHash, $confPassHash);
    $checkEmail = $userMgr->checkEmail($email);

    if (!$checkPassword) {
        setFields("password");
        $formPassword = INVALID_FORM;
        $formConfPassword = INVALID_FORM;
        $display = TRUE;
        $error = "Le due password non coincidono!";
    } elseif ($checkEmail) {
        setFields("email");
        $formEmail = INVALID_FORM;
        $display = TRUE;
        $error = "Email già utilizzata!";
    } else {
        // creazione del nuovo utente
        $userID = $userMgr->register($name, $surname, $email, $passHash);

        if ($userID > 0) {
            // login automatico dell'utente appena creato
            $login = $userMgr->login($email, $passHash);

            $_SESSION["email"] = $email;
            foreach ($login as $log) {
                $_SESSION["img"] = $log["img"];
                $_SESSION["admin"] = $log["user_type"];
                $_SESSION["name"] = $log["name"];
                $_SESSION["userid"] = $log["id"];
            }
            // creazione e sincronizzazione dei carrelli
            $cartMgr = new CartManager();

            $cartID = $cartMgr->createCart();
            $currentCartID = $cartMgr->getCurrentCartId();
            if($cartID != $currentCartID){
                $cartMgr->mergeCarts($cartID, $currentCartID);
            }
            

            // redirect alla home
            header("Location: " . ROOT_URL . "shop");
        } else {
            $display = TRUE;
            $error = "Errore durante la registrazione, riprova più tardi!";
        }
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


<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-4" style="margin-left: 9px;">
            <main class="form-signin">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">

                    <h1 class="h3 mb-3 fw-normal">Registrazione</h1>

                    <div class="form-floating">
                        <input type="text" <?php echo $formName; ?> name="name" id="name" placeholder="Nome" <?php echo $nameValue; ?>>
                        <label for="floatingPassword">Nome</label>
                        <span>
                            <div class="errorLabel"><?php echo $nameErr; ?></div>
                        </span>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="text" <?php echo $formSurname; ?> name="surname" id="surname" placeholder="Cognome" <?php echo $surnameValue; ?>>
                        <label for="floatingPassword">Cognome</label>
                        <span>
                            <div class="errorLabel"><?php echo $surnameErr; ?></div>
                        </span>
                    </div>
                    <br>
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
                        <span>
                            <div class="errorLabel"><?php echo $passwordErr; ?></div>
                        </span>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" <?php echo $formConfPassword; ?> name="confPassword" id="confPassword" placeholder="Conferma Password">
                        <label for="floatingPassword">Conferma Password</label>
                        <span>
                            <div class="errorLabel"><?php echo $confPasswordErr; ?></div>
                        </span>
                    </div>
                    <br>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="auth-cond" name="checkCond" id="checkCond"> Accetto le condizioni del sito
                        </label>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="auth-data" name="checkData" id="checkData"> Acconsento al trattamento dei dati personali
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrati</button>
                </form>
            </main>
        </div>

        <div class="spazio" id="spazio_vuoto" style="margin-top: 110px;">

            <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>