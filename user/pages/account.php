<?php
include "../../inc/init.php";
    if(!isset($_SESSION["email"])){
        header("Location: " . ROOT_URL);
    }
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Account</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<div class="container" id="main-area" style="margin-top: 25px;">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 100%;">
                <img src=<?php echo ROOT_URL . $_SESSION["img"]; ?> class="card-img-top" alt="...">
                </img>
            </div>
        </div>
        <?php $userMgr = new UserManager();
              $user = $userMgr->data($_SESSION["email"]);        
        ?>
        <div class="col-6">
            <div class="form-group">
                <?php foreach($user as $i) :?>
                <fieldset disabled="">
                    <label class="form-label" for="disabledInput">Nome</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder=<?php echo $i["name"]; ?>
                        disabled="">
                    <label class="form-label" for="disabledInput">Cognome</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="<?php echo $i['surname'];?>"
                        disabled="">
                    <label class="form-label" for="disabledInput">Email</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder=<?php echo $i["email"]; ?>
                        disabled="">
                    <label class="form-label" for="disabledInput">Recensioni fatte</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="Numero recensioni"
                        disabled="">
                    <label class="form-label" for="disabledInput">Numero ordini</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="Totale ordini" disabled="">
                    <label class="form-label" for="disabledInput">Punti</label>
                    <input class="form-control" id="disabledInput" type="text" placeholder="Totale ordini" disabled="">
                </fieldset>
                <?php endforeach;?>
            </div>
        </div>
    </div>
    


</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>