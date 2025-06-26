<?php
include('./project-config.php');
include('./functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Shop Homepage - Start Bootstrap Template</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="Project-vendor/assets/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="Project-vendor/css/styles.css" rel="stylesheet" />
    <link href="Project-vendor/css/checkout.css" rel="stylesheet" />
</head>

<body>
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container px-4 px-lg-5">
            <a class="navbar-brand" href="#!"><strong><?php echo $site_title; ?></strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#!">About</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Shop</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#!">All Products</a></li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li><a class="dropdown-item" href="#!">Popular Items</a></li>
                            <li><a class="dropdown-item" href="#!">New Arrivals</a></li>
                        </ul>
                    </li>
                </ul>
                <?php
                if (!isset($_SESSION['customer'])) {
                    $cus_register_url = $cus_url . "register.php/";
                    $cus_login_url = $cus_url . "login.php/";
                ?>
                    <div class="d-flex mx-2">
                        <a href="<?php echo $cus_login_url; ?>" class="btn btn-outline-success" type="submit">
                            Login
                        </a>
                    </div>
                    <div class="d-flex">
                        <a href="<?php echo $cus_register_url; ?>" class="btn btn-outline-danger">
                            Register
                        </a>
                    </div>
                <?php
                } else {
                ?>
                    <div class="d-flex mx-2">
                        <h3><?php echo $_SESSION['customer']['cus_name']; ?></h3>
                    </div>
                    <form class="d-flex">
                        <a class="btn btn-outline-dark" href="./cart-view.php">
                            <i class="bi-cart-fill me-1"></i>
                            Cart
                            <span class="badge bg-dark text-white ms-1 rounded-pill"><?php echo (get_cart_item($conn, $_SESSION['customer']['cus_id'])); ?></span>
                        </a>
                    </form>
                    <div class="d-flex mx-2">
                        <a href="<?php echo ($cus_url . "logout.php/"); ?>" class="btn btn-danger">
                            Logout
                        </a>
                    </div>
                    <div class="d-flex mx-2">
                        <button class="btn btn-outline-dark" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                            <i class="bi bi-gear"></i>
                        </button>
                    </div>
                <?php
                }
                ?>


            </div>
        </div>
    </nav>
    <!-- Bootstrap Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel"><?php echo $_SESSION['customer']['cus_name']; ?></h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div>

            </div>
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                <li class="nav-item border-bottom border-dark p-2 rounded">
                    <a class="nav-link active" aria-current="page" href="#"><i class="bi bi-speedometer2 "></i> &nbsp; &nbsp;Your Dashboard</a>
                </li>
                <li class="nav-item border-bottom border-dark p-2 rounded">
                    <a class="nav-link active" aria-current="page" href="<?php echo $cus_url."order-view.php"; ?>"><i class="bi bi-box-seam"></i> &nbsp; &nbsp;Your Orders</a>
                </li>
                <li class="nav-item border-bottom border-dark p-2 rounded">
                    <a class="nav-link active" aria-current="page" href="<?php echo $cus_url . "customer-address.php"; ?>"><i class="bi bi-house"></i> &nbsp; &nbsp;Your Addresses</a>
                </li>
            </ul>
        </div>
    </div>