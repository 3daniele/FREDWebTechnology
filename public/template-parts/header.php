  </head>

  <body>
          <header class="p-3 mb-3 border-bottom">
              <div class="container">
                  <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                      <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                          <li><a href=<?php echo ROOT_URL ?> class="nav-link px-2 link-secondary"><img src="<?php echo ROOT_URL ?>public/img/logo.jpg" alt="BIO" width="100px"></img></a></li>
                      </ul>

                      <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3" action = "<?php echo ROOT_URL; ?>shop" method="GET">
                          <input type="search" name="search" class="form-control" placeholder="Carca..." aria-label="Search">
                      </form>

                      <ul class="nav col-12 col-lg-auto me-lg-3  mb-md-1">
                          <li><a href="<?php echo ROOT_URL; ?>shop/pages/cart.php" class="nav-link px-2 link-secondary"><strong><svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-cart3" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l.84 4.479 9.144-.459L13.89 4H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg></strong></a></li>
                      </ul>
                      <?php if (isset($_SESSION["email"])) : ?>
                          <div class="dropdown text-end">
                              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                  <img src="<?php echo ROOT_URL . $_SESSION['img'] ?>" alt="mdo" width="32" height="32" class="rounded-circle">
                              </a>
                              <ul class="dropdown-menu dropdown-menu-macos mx-0 shadow" style="width: 220px;">
                                  <li>
                                      <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                          <img src="<?php echo ROOT_URL; ?>public/img/order.png" alt="" width="16" height="16">Ordini</a>
                                  </li>
                                  <li>
                                      <a class="dropdown-item d-flex gap-2 align-items-center" href=<?php echo ROOT_URL . "shop/pages/wishlist.php" ?>>
                                          <img src="<?php echo ROOT_URL; ?>public/img/star.png" alt="" width="16" height="16">Preferiti</a>
                                  </li>
                                  <li>
                                      <a class="dropdown-item d-flex gap-2 align-items-center" href="#">
                                          <img src="<?php echo ROOT_URL; ?>public/img/support.png" alt="" width="16" height="16">
                                          Supporto
                                      </a>
                                  </li>
                                  <?php if ($_SESSION["admin"] == 2) : ?>
                                      <li>
                                          <a class="dropdown-item d-flex gap-2 align-items-center" href="<?php echo ROOT_URL . 'admin/'?>">

                                              <img src="<?php echo ROOT_URL; ?>public/img/admin.png" alt="" width="16" height="16">
                                              Amministrazione
                                          </a>
                                      </li>
                                  <?php endif ?>
                                  <li>
                                      <hr class="dropdown-divider">
                                  </li>

                                  <li>
                                      <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href="<?php echo ROOT_URL; ?>user/index.php">
                                          <img src="<?php echo ROOT_URL; ?>public/img/account.png" alt="" width="16" height="16">
                                          Account
                                      </a>
                                  </li>
                                  <li>
                                      <hr class="dropdown-divider">
                                  </li>
                                  <li>
                                      <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href=<?php echo ROOT_URL . "public/auth/pages/logout.php" ?>>
                                          <img src="<?php echo ROOT_URL; ?>public/img/logout.png" alt="" width="16" height="16">
                                          Logout
                                      </a>
                                  </li>


                              </ul>
                          </div>
                      <?php else : ?>
                          <div class="dropdown text-end">
                              <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                  <img src="<?php echo ROOT_URL ?>public/img/account.png" alt="mdo" width="32" height="32" class="rounded-circle">
                              </a>
                              <ul class="dropdown-menu mx-0 shadow" style="width: 220px;">
                                  <li>
                                      <a class="dropdown-item dropdown-item-danger d-flex gap-2 align-items-center" href=<?php echo ROOT_URL . "public/auth/pages/login.php" ?>>
                                          <img src="<?php echo ROOT_URL; ?>public/img/login.png" alt="" width="16" height="16">
                                          Login
                                      </a>
                                  </li>
                              </ul>
                          </div>
                      <?php endif ?>
                  </div>
              </div>
          </header>
