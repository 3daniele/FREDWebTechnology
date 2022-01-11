<?php
    
    include "../../../inc/init.php";
    
    $review_id=$_POST["id"];

    

    $reviewMgr = new ReviewManager();
    $reviewMgr->unlockReview($review_id);
    
    header("Location: ".ROOT_URL."admin/pages/review/review.php");

?>