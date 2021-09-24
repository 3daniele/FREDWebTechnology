<?php include "../inc/init.php"; ?>

<?php include ROOT_PATH . "public/template-parts/title.php"; ?>

<title>Il mio account</title>

<?php include ROOT_PATH . "public/template-parts/header.php"; ?>

<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/order.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-box-seam" viewBox="0 0 16 16">
                                        <path d="M8.186 1.113a.5.5 0 0 0-.372 0L1.846 3.5l2.404.961L10.404 2l-2.218-.887zm3.564 1.426L5.596 5 8 5.961 14.154 3.5l-2.404-.961zm3.25 1.7-6.5 2.6v7.922l6.5-2.6V4.24zM7.5 14.762V6.838L1 4.239v7.923l6.5 2.6zM7.443.184a1.5 1.5 0 0 1 1.114 0l7.129 2.852A.5.5 0 0 1 16 3.5v8.662a1 1 0 0 1-.629.928l-7.185 2.874a.5.5 0 0 1-.372 0L.63 13.09a1 1 0 0 1-.63-.928V3.5a.5.5 0 0 1 .314-.464L7.443.184z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b>I miei ordini!</b></h5>
                                <p class="card-text">Traccia, visualizza e gestisci i tuoi ordini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/account.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                                        <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b>Profilo!</b></h5>
                                <p class="card-text">Modifica il login, il nome e il numero di cellulare.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/address.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-journal-bookmark-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6 1h6v7a.5.5 0 0 1-.757.429L9 7.083 6.757 8.43A.5.5 0 0 1 6 8V1z" />
                                        <path d="M3 0h10a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-1h1v1a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v1H1V2a2 2 0 0 1 2-2z" />
                                        <path d="M1 5v-.5a.5.5 0 0 1 1 0V5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0V8h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1zm0 3v-.5a.5.5 0 0 1 1 0v.5h.5a.5.5 0 0 1 0 1h-2a.5.5 0 0 1 0-1H1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b>Indirizzi!</b></h5>
                                <p class="card-text">Modifica indirizzi e preferenze di consegna per gli ordini e i regali.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/payment.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-credit-card" viewBox="0 0 16 16">
                                        <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v1h14V4a1 1 0 0 0-1-1H2zm13 4H1v5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V7z" />
                                        <path d="M2 10a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1v-1z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title "><strong>I tuoi pagamenti!</strong></h5>
                                <p class="card-text">Gestisci metodi e impostazioni di pagamento, visualizza saldi e offerte.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/invoice.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-receipt-cutoff" viewBox="0 0 16 16">
                                        <path d="M3 4.5a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 1 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zM11.5 4a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1zm0 2a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z" />
                                        <path d="M2.354.646a.5.5 0 0 0-.801.13l-.5 1A.5.5 0 0 0 1 2v13H.5a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H15V2a.5.5 0 0 0-.053-.224l-.5-1a.5.5 0 0 0-.8-.13L13 1.293l-.646-.647a.5.5 0 0 0-.708 0L11 1.293l-.646-.647a.5.5 0 0 0-.708 0L9 1.293 8.354.646a.5.5 0 0 0-.708 0L7 1.293 6.354.646a.5.5 0 0 0-.708 0L5 1.293 4.354.646a.5.5 0 0 0-.708 0L3 1.293 2.354.646zm-.217 1.198.51.51a.5.5 0 0 0 .707 0L4 1.707l.646.647a.5.5 0 0 0 .708 0L6 1.707l.646.647a.5.5 0 0 0 .708 0L8 1.707l.646.647a.5.5 0 0 0 .708 0L10 1.707l.646.647a.5.5 0 0 0 .708 0L12 1.707l.646.647a.5.5 0 0 0 .708 0l.509-.51.137.274V15H2V2.118l.137-.274z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b>Fatturazione!</b></h5>
                                <p class="card-text">Seleziona il tuo indirizzo di fatturazione.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-sm-4">
            <a href="<?php echo ROOT_URL; ?>user/support.php" class="btn text-start">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <span class="account">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="currentColor" class="bi bi-question-diamond" viewBox="0 0 16 16">
                                        <path d="M6.95.435c.58-.58 1.52-.58 2.1 0l6.515 6.516c.58.58.58 1.519 0 2.098L9.05 15.565c-.58.58-1.519.58-2.098 0L.435 9.05a1.482 1.482 0 0 1 0-2.098L6.95.435zm1.4.7a.495.495 0 0 0-.7 0L1.134 7.65a.495.495 0 0 0 0 .7l6.516 6.516a.495.495 0 0 0 .7 0l6.516-6.516a.495.495 0 0 0 0-.7L8.35 1.134z" />
                                        <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                    </svg>
                                </span>
                            </div>
                            <div class="col-8">
                                <h5 class="card-title"><b>Supporto!</b></h5>
                                <p class="card-text">Scopri gli argomenti disponibili nelle pagine di Aiuto.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>


<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>