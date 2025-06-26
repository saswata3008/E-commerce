<?php
include("./project-config.php");
session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
</head>

<body>

    <div class="container my-5">
        <div class="text-center">
            <h3>Login Form</h3>
        </div>
        <?php
        if (isset($_SESSION['type']) && isset($_SESSION['msg'])) {
        ?>
            <div class="col-lg-6 col-md-6 mx-auto my-3">
                <div
                    class="alert alert-<?php echo $_SESSION['type'] ?>"
                    role="alert">
                    <strong>
                        <?php
                        echo $_SESSION['msg'];
                        session_destroy();
                        ?>
                    </strong>
                </div>

            </div>
        <?php
        }
        ?>
        <div class="col-lg-6 col-md-6 mx-auto">
            <form action="" method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="text" name="password" class="form-control">
                </div>
                <div>
                    <div class="d-grid gap-2">
                        <button
                            type="submit"
                            class="btn btn-primary">
                            Login
                        </button>
                    </div>

                </div>
            </form>
            <div class="mt-3">
                <p>don't have an account <a href="<?php echo ($cus_url . "register.php/") ?>">register now</a></p>
            </div>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
</body>

</html>
<?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $select_query = mysqli_query($conn, "SELECT * FROM `customers` WHERE cus_email='$email'");
    if (!mysqli_num_rows($select_query) > 0) {
        $_SESSION['type'] = "danger";
        $_SESSION['msg'] = "Customer not found with this {$email}";
        header("location:login.php");
        return;
    }
    $customer = mysqli_fetch_assoc($select_query);
    $hasf_password = $customer['cus_password'];
    if (!password_verify($password, $hasf_password)) {
        $_SESSION['type'] = "danger";
        $_SESSION['msg'] = "Invalid Password, try to login with correct password !";
        header("location:login.php");
        return;
    }
    $_SESSION['customer'] = $customer;
    header("location:$cus_url");
    return;
}
?>