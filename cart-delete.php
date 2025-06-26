<?php
include("./project-config.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart-id']);
    $delete_query=mysqli_query($conn, "DELETE FROM `cart` WHERE cart_id = $cart_id");
    header("location:cart-view.php");
    return;
}
?>