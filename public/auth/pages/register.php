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

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-4" style="margin-left: 9px;">
            <main class="form-signin">
                <form>

                    <h1 class="h3 mb-3 fw-normal">Registrazione</h1>

                    <div class="form-floating">
                        <input type="text" class="form-control" id="name" placeholder="Nome">
                        <label for="floatingPassword">Nome</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="text" class="form-control" id="surname" placeholder="Cognome">
                        <label for="floatingPassword">Cognome</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" placeholder="name@example.com">
                        <label for="floatingInput">Indirizzo Email</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <br>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="password2" placeholder="Conferma Password">
                        <label for="floatingPassword">Conferma Password</label>
                    </div>
                    <br>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="auth-cond" id="check1"> Accetto le condizioni del sito
                        </label>
                    </div>
                    <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="auth-data" id="check2"> Acconsento al trattamento dei dati personali
                        </label>
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Registrati</button>
                </form>
            </main>
        </div>

        <div class="spazio" id="spazio_vuoto" style="margin-top: 110px;">

            <?php include ROOT_PATH . "public/template-parts/footer.php"; ?>