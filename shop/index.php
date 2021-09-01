<?php include "../inc/init.php" ?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>
<title>Shop</title>
<?php
include ROOT_PATH . 'public/template-parts/header.php';
?>

<div class="container" id="main-area" style="margin-top: 70px;">
<?php
  if (!defined('ROOT_URL')) {
    die;
  }

  if (isset($_POST['product_id'])) {

    $productId = $_POST['product_id'];
    // addToCart Logic
    $cm = new CartManager();
    $cartId = $cm->getCurrentCartId();
  
    // aggiumngi al carrello "cartId" il prodotto "productId"
    $cm->addToCart($productId, $cartId);
  
    // stampato un messaggio per l'utente
    echo 'ok';
  }
  
  $id = htmlspecialchars(trim($_GET['product_id']));

  $productMgr = new ProductManager();
  $products = $productMgr->getAll();

  
?>
    <div class="row">
    <?php if($products) : ?>
        <?php foreach($products as $product) : ?>
        <div class="col-3">
            <div class="card mb-3">
                <h3 class="card-header text-center">
                <?php echo $product->name; ?>
                </h3>
                <img src="<?php 
                $imgMgr = new ImgManager();
                    $img = $imgMgr->get_thumbnail($product->id);
                    foreach($img as $i){
                        echo ROOT_URL . $i['link'];
                    }?>" class="d-block user-select-none" aria-label="Placeholder: Image cap" focusable="false" role="img" viewBox="0 0 318 180" style="width:auto; height:250" alt="<?php echo $product->name; ?>">
                    
                </img>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Valutazione</li>
                    <li class="list-group-item">
                    
                        <?php 
                            $categoryItemMgr = new CategoryItemManager();
                            $categoryMgr = new CategoryManager();
                            $categories = $categoryItemMgr->get_category_id_by_product($product->id);
                            
                            foreach ($categories as $category){
                                $results = $categoryMgr->getCategory($category['category_id']);
                                foreach ($results as $result) {
                                    echo "<span class=\"badge rounded-pill bg-info\">";
                                    echo $result['name'];
                                    echo"</span>";
                                    echo " ";
                                }
                            }

                          

                        

                        ?>
                    
                    </li>
                    <li class="list-group-item"> <?php echo $product->price." €" ?></li>
                </ul>
                <div class="card-body text-center">
                <form method="POST">
                    <a href=<?php echo ROOT_URL . 'shop/single-product.php?product='.$product->id;?> class="btn btn-outline-primary btn-sm" style="margin-right: 18px">Dettagli</a>
                        <button  class="btn btn-outline-success btn-sm" name="product_id"  type = "submit" value=<?php echo $product->id; ?>>Aggiungi al carrello</button>
                    </form>
                </div>
            </div>


        </div>
        <?php endforeach; ?>
        <?php else : ?>
  <p>Nessun prodotto disponibile...</p>
<?php endif; ?> 
    </div>
    </div>
        
</div>
<?php
include ROOT_PATH . 'public/template-parts/footer.php';
?>