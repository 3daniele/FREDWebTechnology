<?php include "../inc/init.php";

if (!isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL);
}

$reviewMgr = new ReviewManager();

// AGGIUNTA RECENSIONE 
if (isset($_POST['add'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $vote = $_POST['vote'];
    $productID = $_POST['productID'];
    $userID = $_SESSION['userid'];

    $review = $reviewMgr->add($title, $message, $vote, $userID, $productID);

    header('Location: ' . ROOT_URL . 'shop/single-product.php?product=' . $productID);
}

// MODIFICA RECENSIONE
if (isset($_POST['update'])) {
    $title = $_POST['title'];
    $message = $_POST['message'];
    $vote = $_POST['vote'];
    $productID = $_POST['productID'];
    $userID = $_SESSION['userid'];

    $review = $reviewMgr->updateReview($title, $message, $vote, $userID, $productID);

    header('Location: ' . ROOT_URL . 'shop/single-product.php?product=' . $productID);

}

?>
