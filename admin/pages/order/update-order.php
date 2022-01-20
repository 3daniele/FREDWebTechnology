<?php include "../../../inc/init.php";?>

<?php if (!isset($_SESSION["email"]) || $_SESSION["admin"] == 1) {
    header("Location: " . ROOT_URL);
}
?>

<?php
    $orderID = $_POST["orderID"];
    $status = $_POST["status"];
    $stimate = $_POST["stimate"];
    $tracking_info = $_POST["tracking_info"];
   
    $orderMgr = new OrdersManager();
    $orderMgr->updateOrder($orderID,$status,$stimate,$tracking_info);

    header("Location: ".ROOT_URL."admin/pages/order/single-order.php?order=".$orderID);
    
?>