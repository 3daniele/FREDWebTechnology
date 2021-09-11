<?php
include "../../inc/init.php";
include ROOT_PATH . "public/template-parts/title.php";
?>
<title>Carrello</title>
<?php include ROOT_PATH . "public/template-parts/header.php"; ?>
<div class="container" id="main-area" style="margin-top: 70px;">
    <?php if (isset($_SESSION["email"])) : ?>
    <div class="row">
        <h2 class="text-primary"><?php echo "Benvenuto " . $_SESSION["name"]; ?></h2>
        <hr>
    </div>
    <?php else : ?>
    <div class="row">

        <a href="<?php echo ROOT_URL; ?>/public/auth/pages/login.php" class="btn btn-primary">Loggati</a>

        <hr>
        <hr>
    </div>
    <?php endif; ?>
    <div class="row">
        <div class="col-9">

            <?php
      $cartMgr = new CartManager();
      $cartItemMgr = new CartItemManager();

      if (isset($_SESSION['userid'])) {
        $cartID = $cartMgr->findCart($_SESSION['userid']);
      } else {
        $cartID = $cartMgr->getCart($_SESSION['client_id']);
      }

      $sum = 0;

      if ($cartID) :
        $quantity = $cartItemMgr->countTotalItem($cartID);
      ?>

            <h4 class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-primary">Carrello</span>
                <span class="badge bg-primary rounded-pill text-white"><?php echo $quantity ?> elementi nel
                    carrello</span>
            </h4>
            <ul class="list-group mb-3">
                <?php
          $imgMgr = new ImgManager();
          $productMgr = new ProductManager();
          $items = $cartItemMgr->getItems($cartID);
          foreach ($items as $item) :
            $product = $productMgr->get($item['product_id']);
            $img = $imgMgr->get_thumbnail($product->id);
          ?>

                <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                    <div class="row w-100">
                        <div class="col-lg-3 col-6">
                            <h6 class="my-0 text-primary"><strong><?php echo $product->name ?></strong></h6>
                        </div>

                        <div class="col-lg-2 col-6">
                            <img src=<?php echo ROOT_URL . $img[0]['link']; ?> alt="immagine" width=100px></img>
                        </div>

                        <div class="col-lg-2 col-6">
                            <span class="text-muted"><?php echo $product->price ?> €</span>
                        </div>
                        <div class="col-lg-3 col-6">
                            <form method="POST">
                                <div class="cart-buttons btn-group" role="group">
                                    <button name="minus" type="submit" class="btn btn-sm btn-primary"
                                        value=<?php echo $product->id ?>>-</button>
                                    <span class="text-muted"><?php echo $item['quantity']; ?></span>
                                    <button name="plus" type="submit" class="btn btn-sm btn-primary"
                                        value=<?php echo $product->id ?>>+</button>
                                    <input type="hidden" name="id" value="<?php echo $item['id'] ?>" />
                                </div>
                            </form>
                        </div>
                        <div class="col-lg-2 col-6">
                            <strong class="text-primary"><?php $sum = $sum + number_format($item['quantity'] * $product->price, 2);
                                                echo number_format($item['quantity'] * $product->price, 2) ?>
                                €</strong>
                        </div>
                    </div>
                </li>
                <?php endforeach; ?>
            </ul>
            <ul class="list-group mb-3">
                <li class="list-group-item d-flex justify-content-between lh-sm p-4">
                    <div class="row w-100">
                        <div class="col-lg-3 col-6">
                            <h6 class="my-0 text-primary"><strong>Totale</strong></h6>
                        </div>
                        <div class="col-lg-7 col-6">
                        </div>
                        <div class="col-lg-2 col-6">
                            <strong class="text-primary"><?php echo number_format($sum, 2) ?> €</strong>
                        </div>
                    </div>
                </li>
            </ul>
            <hr>
            <a href="<?php echo ROOT_URL . 'shop/pages/checkout.php' ?>" class="btn btn-primary btn-block">Checkout</a>
            <?php else : ?>
            <p class="lead">Nessun elemento nel carrello...</p>
            <a href="<?php echo ROOT_URL . 'shop?page=products-list'; ?>" class="btn btn-primary btn-lg mb-5 mt-3">Vai
                allo Shopping &raquo;</a>
            <?php endif; ?>
        </div>
        <?php include ROOT_PATH . "public/template-parts/sidebar.php"; ?>
    </div>
</div>


<?php include ROOT_PATH . "public/template-parts/footer.php"; ?>

<!-- Aggiunta e rimozione dal carrello -->
<?php
 if (isset($_POST['minus'])) {
  $cartMgr->removeFromCart($_POST['minus'],$cartID);
  header("Location: " . ROOT_URL."shop/pages/cart");
  }  
  if (isset($_POST['plus'])) {
    $cartMgr->addToCart($_POST['plus'],$cartID);
    header("Location: " . ROOT_URL."shop/pages/cart");
  } 

?>