<?php
include('./project-config.php');
require_once('./functions.php');
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    add_item_to_cart($conn, $user, $product);
    header("location:index.php");
}
