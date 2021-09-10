<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Profilo</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    <form action="" method="POST">
        <div class="row">


            <?php $userMgr = new UserManager();
            $user = $userMgr->data($_SESSION["email"]);
            ?>

            <div class="col-7">

                <?php foreach ($user as $i) : ?>
                    <h4><label class="form-label">Informazioni personali:</label></h4>
                    <hr>
                    <label class="form-label">Nome</label>
                    <input class="form-control" id="disabledInput" type="text" value=<?php echo $i["name"]; ?>>
                    <label class="form-label" for="disabledInput">Cognome</label>
                    <input class="form-control" id="disabledInput" type="text" value="<?php echo $i['surname']; ?>">
                    <label class="form-label" for="disabledInput">Email</label>
                    <input class="form-control" id="disabledInput" type="text" value=<?php echo $i["email"]; ?>>

                    <br><br>
                    <h4><label class="form-label">Aggiorna password</label></h4>
                    <hr>
                    <label class="form-label">Password attuale</label>
                    <input class="form-control" id="disabledInput" type="password" value="">
                    <label class="form-label" for="disabledInput">Nuova password</label>
                    <input class="form-control" id="disabledInput" type="password" value="********">
                    <label class="form-label" for="disabledInput">Conferma password</label>
                    <input class="form-control" id="disabledInput" type="password" value="********">

                <?php endforeach; ?>
            </div>
            <div class="col-2"></div>
            <div class="col-3" style="margin-top: 15px;">
            <h4><label class="form-label"></label></h4>
                <div class="card border-light" style="width: 100%; border:none;">
                    <img class="rounded-circle" src=<?php echo ROOT_URL . $_SESSION["img"]; ?> class="card-img-top" alt="..."></img>
                </div>
                <br><br>
                <div class="input-group mb-3">
                    <input type="file" class="form-control" id="inputGroupFile02"></input>
                    <label class="input-group-text" for="inputGroupFile02">Upload</label>
                </div>
            </div>
        </div>
        <br><br>
        <div class="row">

            <div class="col-5"></div>
            <div class="col-1"><input type="submit" class="btn btn-outline-primary" value="Modifica" style="width: 100%;"></input></div>
            <div class="col-1"><input type="reset" class="btn btn-outline-danger" value="Reset" style="width: 100%;"></input></div>
            <div class="col-5"></div>
        </div>
    </form>
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>