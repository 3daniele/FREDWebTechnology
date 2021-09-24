<?php include "../../../inc/init.php"; ?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Messaggi</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<?php include ROOT_PATH . "admin/pages/template-parts/adminSidebar.php"; ?>

<main class="col-md-9 col-lg-8 px-md-4">
    <div class="row border-bottom">
        <div class="col-4">
            <h2><strong class="text-primary">Messaggi</strong></h2>
        </div>
        <div class="col-4"></div>
        <div class="col-2 text-end">
        </div>
        <div class="col-2 text-end" style="margin-top : 5px;"><a href="new-product.php"><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                    <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                    <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                </svg></a>
        </div>
    </div>
    <div class="row" style="margin-top: 5px;">
        <div class="col-md-3 col-lg-3 px-md-4">
                Menu per le chat
        </div>
        <div class="col-md-6 col-lg-5 px-md-4">
            <strong>CIAO A TUTTI!</strong>
            <br>
            Questo è lo spazio per il caricamento dei messaggi della singola chat
        </div>
    </div>
    

</main>
<div class="col-lg-1 px-md-4"></div>



<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>