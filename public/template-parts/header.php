  
</head>

<body>

    <header class="p-3 mb-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href=<?php echo ROOT_URL ?> class="nav-link px-2 link-secondary"><img src="<?php echo ROOT_URL?>public/img/logo.jpeg" alt="BIO" width="100px" ></img></a></li>
                </ul>

                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                    <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
                </form>

                <ul class="nav col-12 col-lg-auto me-lg-3  mb-md-1">
                    <li><a href="<?php echo ROOT_URL; ?>shop/pages/cart.php" class="nav-link px-2 link-secondary"><img src="<?php echo ROOT_URL;?>public/img/shopping_bag.svg" alt="Cart"
                                width="32" height="32"></a></li>
                </ul>
                <?php if(isset($_SESSION["email"])): ?>
                <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo ROOT_URL . $_SESSION['img']?>" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-macos mx-0 shadow" style="width: 220px;">
                        <li>
                            <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                <img src="<?php echo ROOT_URL;?>public/img/order.png" alt="" width="16" height="16">Ordini</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                <img src="<?php echo ROOT_URL;?>public/img/star.png" alt="" width="16" height="16">Preferiti</a>
                        </li>
                        <li>
                            <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                <img src="<?php echo ROOT_URL;?>public/img/support.png" alt="" width="16" height="16">
                                Supporto
                            </a>
                        </li>
                        <?php if($_SESSION["admin"] == 2): ?>
                        <li>
                            <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                
                                <img src="<?php echo ROOT_URL;?>public/img/admin.png" alt="" width="16" height="16">
                                Amministrazione
                            </a>
                        </li>
                        <?php endif ?>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        
                        <li>
                            <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href="<?php echo ROOT_URL;?>user/pages/account.php">
                                <img src="<?php echo ROOT_URL;?>public/img/account.png" alt="" width="16" height="16">
                                Account
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href=<?php echo ROOT_URL."public/auth/pages/logout.php"?>>
                                <img src="<?php echo ROOT_URL;?>public/img/logout.png" alt="" width="16" height="16">
                                Logout
                            </a>
                        </li>
                        
                        
                    </ul>
                </div>
                <?php else : ?>
                    <div class="dropdown text-end">
                    <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo ROOT_URL ?>public/img/account.png" alt="mdo" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu mx-0 shadow" style="width: 220px;">
                            <li>
                                <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href=<?php echo ROOT_URL."public/auth/pages/login.php"?>>
                                    <img src="<?php echo ROOT_URL;?>public/img/login.png" alt="" width="16" height="16">
                                    Login
                                </a>
                            </li>
                        </ul>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </header>