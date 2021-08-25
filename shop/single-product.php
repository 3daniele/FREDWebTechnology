<?php include "../inc/init.php"; ?>
<?php
    if (!defined('ROOT_URL')) {
        die;
    }

    if ($_GET["product"] == null) {
        header("Location: " . ROOT_URL);
    }

    $productid = $_GET["product"];
?>
<?php include ROOT_PATH . "public/template-parts/title.php" ?>
<?php $productmgr = new ProductManager();
$product = $productmgr->get($productid);
if($product->name == ""){
    header("Location: " . ROOT_URL);
}
?>
<title><?php echo $product->name; ?></title>
<?php include ROOT_PATH . 'public/template-parts/header.php'; ?>
<div class="container" id="main-area" style="margin-top: 70px;">
    <div class="row">
        <div class="col-4">
            <div class="card" style="width: 18rem;">
                <img src="<?php
                            $imgMgr = new ImgManager();
                            $img = $imgMgr->get_thumbnail($product->id);
                            foreach ($img as $i) {
                                echo ROOT_URL . $i['link'];
                            } ?>" class="card-img-top" alt="...">
                </img>
                <div class="card-body">

                </div>
            </div>
        </div>
        <div class="col-8">
            <h2><?php echo $product->name; ?></h2>
            <hr>
            <h4><?php echo $product->price . "€"; ?></h4>
            <hr>
            <?php echo $product->description; ?>
        </div>

    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-8">
            <div class="form-group">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="Come...">
                    <label for="floatingInput">Hai qualche domanda?</label>
                </div>
            </div>
        </div>

    </div>
    <div class="row"><br></div>
    <div class="row">
        <div class="col-2">
            <div class="card text-white bg-warning mb-3" style="max-width: 20rem;">
                <div class="card-header">Recensioni</div>
                <div class="card-body">
                    <h4 class="card-title">Media con stelline</h4>
                    <p class="card-text">1 stella<br> 2 stelle <br>...</p>
                </div>
            </div>
        </div>

        <div class="col-10">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Type</th>
                        <th scope="col">Column heading</th>
                        <th scope="col">Column heading</th>
                        <th scope="col">Column heading</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table-active">
                        <th scope="row">Active</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr>
                        <th scope="row">Default</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-primary">
                        <th scope="row">Primary</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-secondary">
                        <th scope="row">Secondary</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-success">
                        <th scope="row">Success</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-danger">
                        <th scope="row">Danger</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-warning">
                        <th scope="row">Warning</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-info">
                        <th scope="row">Info</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-light">
                        <th scope="row">Light</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                    <tr class="table-dark">
                        <th scope="row">Dark</th>
                        <td>Column content</td>
                        <td>Column content</td>
                        <td>Column content</td>
                    </tr>
                </tbody>
            </table>
        </div>


    </div>
</div>

<?php include ROOT_PATH . 'public/template-parts/footer.php'; ?>