<?php
function get_cart_item($conn, $customer_id)
{
    $select_query = mysqli_query($conn, "SELECT SUM(quantity) AS total_item FROM cart WHERE cus_id=$customer_id");
    $result = mysqli_fetch_assoc($select_query);
    $count = $result['total_item'];
    return $count;
}

function add_item_to_cart($conn, $customer, $product)
{
    $insert_query = mysqli_query($conn, "INSERT INTO `cart`(`cus_id`, `product_id`) VALUES ('$customer','$product')");
    if (!$insert_query) {
        return;
    }
}

// Function to generate a random string of specified length
function random_strings($length_of_string){
    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
    return substr(str_shuffle($str_result), 0, $length_of_string);
}
