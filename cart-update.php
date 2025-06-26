<?php
include("./project-config.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $cart_id = mysqli_real_escape_string($conn, $_POST['cart-id']);
    if ($quantity<=1) {
        header('location:cart-view.php');
        return;
    }
    $update_query = mysqli_query($conn, "UPDATE `cart` SET `quantity`='$quantity' WHERE cart_id = $cart_id");
    header('location:cart-view.php');
    return;
}
