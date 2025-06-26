<?php
include("./project-config.php");
include("./functions.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   $customer = $_POST['customer'];
   $address = $_POST['address'];
   $amount = $_POST['amount'];
   $payment_id = $_POST['payment_id'];
    $order_id = random_strings(20);
   if (!empty($payment_id)) {
    $insert_query = mysqli_query($conn, "INSERT INTO `orders`(`order_id`, `cus_id`, `address_id`, `total_order_amount`, `payment_mode`, `txn_id`) VALUES ('$order_id','$customer','$address','$amount','razor','$payment_id')");

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
        echo "Order Successfully done .";
    }
   }
}
?>