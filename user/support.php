<?php
include "../inc/init.php";
if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}
?>

<?php
include ROOT_PATH . "public/template-parts/title.php";
?>

<title>Ordini</title>

<?php
include ROOT_PATH . "public/template-parts/header.php";
?>

<div class="container" id="main-area" style="margin-top: 25px; ">
    
</div>

<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>