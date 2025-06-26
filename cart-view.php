<?php
include('./layout/header.php');
include('./project-config.php');
$total_price = 0;
?>

<!-- Related items section-->
<section class="py-5 bg-light">
    <div class="container my-5">
        <div class="text-center">
            <h3>YOUR CART</h3>
        </div>
    </div>
    <div class="container my-5">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Product</th>
                    <th scope="col">Image</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cus_id = $_SESSION['customer']['cus_id'];
                $select_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE cus_id=$cus_id");
                if (!mysqli_num_rows($select_query) > 0) {
                    echo "Cart is empty";
                }
                while ($data = mysqli_fetch_assoc($select_query)) {
                ?>
                    <tr>
                            <td>
                                <?php
                                $product_id = $data['product_id'];
                                $product_select_query = mysqli_query($conn, "SELECT * FROM `product` WHERE product_id=$product_id");
                                if (!mysqli_num_rows($product_select_query) > 0) {
                                    echo "product not found";
                                }
                                $product = mysqli_fetch_assoc($product_select_query);
                                echo $product['product_name'];
                                ?>
                            </td>
                            <td>
                                <img src="./admin/<?php echo $product['product_image'] ?>" alt="" height="100px" width="100px">
                            </td>
                            <form action="cart-update.php" method="post">
                                <td>
                                    <input type="number" name="quantity" value="<?php echo $data['quantity']; ?>">
                                </td>
                                <td>
                                    <?php
                                    $price = $data['quantity'] * $product['product_price'];
                                    $total_price += $price;
                                    echo $price;
                                    ?>
                                </td>
                                <td>
                                    <input type="hidden" name="cart-id" value="<?php echo $data['cart_id']; ?>">
                                    <button type="submit" class="btn btn-success">update</button>
                                </td>
                            </form>
                            <form action="cart-delete.php" method="post">
                                <td>
                                <input type="hidden" name="cart-id" value="<?php echo $data['cart_id']; ?>">
                                <button type="submit" class="btn btn-danger">delete</button>
                                </td>
                            </form>
                    </tr>
                <?php
                }
                ?>

            </tbody>
        </table>
    </div>
    <div class="container my-5">
        <div class="col-lg-6">
            <div class="">
                <h2>Total cart Amount</h2>
            </div>
            <div>
                <h4>Sub Total : <?php echo $total_price; ?></h4>
            </div>
            <?php
                if (!empty($total_price)) {
                    ?>
                    <div>
                        <form action="checkout.php" method="post">
                            <input type="hidden" name="cus_id" value="<?php echo $cus_id; ?>">
                            <button type="submit" class="btn btn-primary"> Check out now </button>
                        </form>
                    </div>
                    <?php
                }
            ?>
        </div>
    </div>
    
</section>
<?php
include('./layout/footer.php'); 
?>