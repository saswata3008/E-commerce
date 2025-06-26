<?php
include("./project-config.php");
include("./functions.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $customer = mysqli_real_escape_string($conn, $_POST['customer']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $total_order_amount = mysqli_real_escape_string($conn, $_POST['total_order_amount']);
    // $payment_mode = mysqli_real_escape_string($conn, $_POST['payment_mode']);
    $order_id = random_strings(20);

    $insert_query = mysqli_query($conn, "INSERT INTO `orders`(`order_id`, `cus_id`, `address_id`, `total_order_amount`, `payment_mode`) VALUES ('$order_id','$customer','$address','$total_order_amount','cod')");
    if ($insert_query) {
        $select_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE cus_id=$customer");
        if (mysqli_num_rows($select_query)>0) {
            while($cart_data = mysqli_fetch_assoc($select_query)){
                $product_id = $cart_data['product_id'];
                $quantity = $cart_data['quantity'];
                $order_details_insert_query = mysqli_query($conn, "INSERT INTO `order_details`(`order_id`, `cus_id`, `product_id`, `quantity`) VALUES ('$order_id','$customer','$product_id','$quantity')");
            }
        }
    }
    $delete_query = mysqli_query($conn, "DELETE FROM `cart` WHERE cus_id=$customer");
    if ($delete_query) {
        header("location:index.php");
    }
}
?>