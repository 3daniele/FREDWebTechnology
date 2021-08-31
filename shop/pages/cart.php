<?php
include "../../inc/init.php";
include ROOT_PATH . "public/template-parts/title.php";
?>
<title>Carrello</title>
<?php include ROOT_PATH . "public/template-parts/header.php"; ?>
<div class="container" id="main-area" style="margin-top: 70px;">
  <?php if (isset($_SESSION["email"])) : ?>
    <h2><?php echo "Benvenuto " . $_SESSION["name"]; ?><h2>
        <hr>
      <?php else : ?>
        <div class="row">

          <a href="<?php echo ROOT_URL; ?>/public/auth/pages/login.php" class="btn btn-primary">Loggati</a>

          <hr>
          <hr>
        </div>
      <?php endif ?>
      <div class="row">
        <div class="col-9">

          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Carrello</span>
            <span class="badge bg-secondary rounded-pill text-white">2 elementi nel carrello</span>
          </h4>

          <ul class="list-group mb-3">

            <li class="list-group-item d-flex justify-content-between lh-sm p-4">
              <div class="row w-100">
                <div class="col-lg-4 col-6">
                  <h6 class="my-0">Nome prodotto</h6>
                  <small class="text-muted">Descrizione</small>
                </div>
                <div class="col-lg-2 col-6">
                  <span class="text-muted">€ 5.00</span>
                </div>
                <div class="col-lg-4 col-6">
                  <form method="post">
                    <div class="cart-buttons btn-group" role="group">
                      <button name="minus" type="submit" class="btn btn-sm btn-primary">-</button>
                      <span class="text-muted">2</span>
                      <button name="plus" type="submit" class="btn btn-sm btn-primary">+</button>
                      <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                    </div>
                  </form>
                </div>
                <div class="col-lg-2 col-6">
                  <strong class="text-primary">€ 10.00</strong>
                </div>
              </div>
            </li>

            <li class="list-group-item d-flex justify-content-between lh-sm p-4">
              <div class="row w-100">
                <div class="col-lg-4 col-6">
                  <h6 class="my-0">Nome prodotto</h6>
                  <small class="text-muted">Descrizione</small>
                </div>
                <div class="col-lg-2 col-6">
                  <span class="text-muted">€ 5.00</span>
                </div>
                <div class="col-lg-4 col-6">
                  <form method="post">
                    <div class="cart-buttons btn-group" role="group">
                      <button name="minus" type="submit" class="btn btn-sm btn-primary">-</button>
                      <span class="text-muted">2</span>
                      <button name="plus" type="submit" class="btn btn-sm btn-primary">+</button>
                      <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                    </div>
                  </form>
                </div>
                <div class="col-lg-2 col-6">
                  <strong class="text-primary">€ 10.00</strong>
                </div>
              </div>
            </li>

            <li class="list-group-item d-flex justify-content-between lh-sm p-4">
              <div class="row w-100">
                <div class="col-lg-4 col-6">
                  <h6 class="my-0">Nome prodotto</h6>
                  <small class="text-muted">Descrizione</small>
                </div>
                <div class="col-lg-2 col-6">
                  <span class="text-muted">€ 5.00</span>
                </div>
                <div class="col-lg-4 col-6">
                  <form method="post">
                    <div class="cart-buttons btn-group" role="group">
                      <button name="minus" type="submit" class="btn btn-sm btn-primary">-</button>
                      <span class="text-muted">2</span>
                      <button name="plus" type="submit" class="btn btn-sm btn-primary">+</button>
                      <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                    </div>
                  </form>
                </div>
                <div class="col-lg-2 col-6">
                  <strong class="text-primary">€ 10.00</strong>
                </div>
              </div>
            </li>


            <li class="cart-total list-group-item d-flex justify-content-between p-4">
              <div class="row w-100">
                <div class="col-lg-4 col-6">
                  <span>Totale</span>
                </div>
                <div class="col-lg-6 lg-screen"></div>
                <div class="col-lg-2 col-6">
                  <span>€ 30.00</span>
                </div>
              </div>
            </li>
          </ul>

          <hr>

          <button class="btn btn-primary btn-block">Checkout</button>
        </div>
        <?php include ROOT_PATH . "public/template-parts/sidebar.php"; ?>
      </div>
</div>


<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>