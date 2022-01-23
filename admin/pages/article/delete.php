<?php include "../../../inc/init.php"; ?>
<?php
if (!defined('ROOT_URL')) {
    die;
}

if ($_GET["article"] == null || $_SESSION["admin"] == 1 || !isset($_SESSION["email"])) {
    header("Location: " . ROOT_URL . "admin/index.php");
}

$articleid = $_GET["article"];

?>

<?php $articleMgr = new ArticleManager();
$articleMgr->delete($articleid);

if ($articleid == "") {
    header("Location: " . ROOT_URL);
}

header("Location: ".ROOT_URL."admin/pages/article/articles.php");

?>
