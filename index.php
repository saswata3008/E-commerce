<?php
include('./layout/header.php');
include('./project-config.php');
?>
<!-- Header-->
<header class="bg-dark py-5">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Shop in style</h1>
            <p class="lead fw-normal text-white-50 mb-0">With this shop hompeage template</p>
        </div>
    </div>
</header>
<!-- Section-->
<section class="py-5">
    <div class="container px-4 px-lg-5 mt-5">
        <div class="row gx-4 gx-lg-5 row-cols-2 row-cols-md-3 row-cols-xl-4 justify-content-center">
            <?php
            $select_query = mysqli_query($conn, "SELECT * FROM `product` WHERE 1");
            if (!mysqli_num_rows($select_query) > 0) {
                echo "No product found";
            }
            while ($data = mysqli_fetch_assoc($select_query)) {
            ?>
                <div class="col mb-5">
                    <div class="card h-100">
                        <!-- Sale badge-->
                        <div class="badge bg-dark text-white position-absolute" style="top: 0.5rem; right: 0.5rem">Sale</div>
                        <!-- Product image-->
                        <img class="card-img-top" src="./Admin/<?php echo $data['product_image']; ?>" alt="no image found" height="200px" width="200px" />
                        <!-- Product details-->
                        <div class="card-body p-4">
                            <div class="text-center">
                                <!-- Product name-->
                                <a href="./product-view.php?product-id=<?php echo $data['product_id']; ?>">
                                    <h5 class="fw-bolder"><?php echo (substr($data['product_name'], 0, 30) . '...'); ?></h5>
                                </a>
                                <!-- Product reviews-->
                                <div class="d-flex justify-content-center small text-warning mb-2">
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                    <div class="bi-star-fill"></div>
                                </div>
                                <!-- Product price-->
                                <span class="text-muted text-decoration-line-through">₹ 99999.00</span>
                                ₹<?php echo $data['product_price']; ?>
                            </div>
                        </div>
                        <!-- Product actions-->
                        <div class="card-footer p-4 pt-0 border-top-0 bg-transparent">
                            <div class="text-center">
                                <form action="cart-process.php" method="post">
                                    <?php
                                        if (isset($_SESSION['customer'])) {
                                            ?>
                                            <input type="number" name="user" value="<?php echo $_SESSION['customer']['cus_id']; ?>" hidden>
                                            <?php
                                        }
                                    ?>
                                    <input type="number" name="product" value="<?php echo $data['product_id']; ?>" hidden>
                                    <button type="submit" class="btn btn-outline-dark mt-auto">Add to cart</button>
                                </form>
                            </div>
                        </div>
                    </div>
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
