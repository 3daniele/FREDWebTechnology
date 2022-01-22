<?php
include "../inc/init.php";

$tmp = $_FILES['image']['tmp_name'];
$folder = ROOT_PATH . "public/img/user"; //cartella di destinazione dell'immagine
$name = "/" . $_SESSION['email'];
$ext = ".png";

if(is_uploaded_file($tmp)) {

$uploadDir = $folder . $name . $ext; //aggiungo il folder di destinazione

if(move_uploaded_file($tmp,$uploadDir)) {
    echo "Caricato correttamente";
} else {
    echo "Non è stato possibile caricare l'immagine<br/>";
}
}
