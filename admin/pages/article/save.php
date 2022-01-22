<?php include "../../../inc/init.php"; ?>
<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>
<?php
$title = $_POST["title"];

$text = (string)$_POST["text"];

$img = (string)$_POST["img"];

$articleMgr = new ArticleManager();
$articleMgr->newArticle($title, $text, $img);

$id = $articleMgr->getLast();

// upload immagine
if (isset($_FILES)) {

    $tmp = $_FILES['image']['tmp_name'];
    $folder = ROOT_PATH . "public/img/slider/slide"; //cartella di destinazione dell'immagine
    $name = $id[0]['id'];
    $ext = ".png";

    if (is_uploaded_file($tmp)) {
        $uploadDir = $folder . $name . $ext; //aggiungo il folder di destinazione
        if (move_uploaded_file($tmp, $uploadDir)) {
            $articleMgr->updateImg($id[0]['id']);
        } else {
            echo "Non è stato possibile caricare l'immagine<br/>";
        }
    }
}

header("Location: " . ROOT_URL . "admin/pages/article/edit-article.php?article=" . $id[0]['id']);

?>