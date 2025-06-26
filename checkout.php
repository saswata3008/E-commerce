<?php
include("./layout/header.php");
include("./project-config.php");
$sum_of_total = 0;
$total_price = 0;
$cus_id = null;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  $cus_id = mysqli_real_escape_string($conn, $_POST['cus_id']);
  if ($cus_id === null) {
    header("location:cart-view.php");
    return;
  }
  if ($cus_id !== $_SESSION['customer']['cus_id']) {
    header("location:cart-view.php");
    return;
  }
}
?>
<div class="container my-5">
  <main>
  <!-- action="checkout-process.php" -->
    <form  method="">
      <input type="hidden" name="customer" id="customer" value="<?php echo $_SESSION['customer']['cus_id'] ?>">
      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-primary">Your cart</span>
            <span class="badge bg-primary rounded-pill">
              <?php echo (get_cart_item($conn, $cus_id)); ?>
            </span>
          </h4>
          <ul class="list-group mb-3">
            <?php
          $select_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE cus_id=$cus_id");
          if (mysqli_num_rows($select_query) > 0) {
            while ($data = mysqli_fetch_assoc($select_query)) {
          ?>
            <li class="list-group-item d-flex justify-content-between lh-sm">
              <div>
                <?php
                    $product_id = $data['product_id'];
                    $p_s_query = mysqli_query($conn, "SELECT * FROM `product` WHERE product_id=$product_id");
                    $product = mysqli_fetch_assoc($p_s_query);
                  ?>
                <h6 class="my-0">
                  <?php echo $product['product_name']; ?>
                </h6>
                <small class="text-body-secondary my-3">Quantity -
                  <?php echo $data['quantity']; ?>
                </small>
              </div>
              &nbsp;
              &nbsp;
              &nbsp;
              <span class="text-body-secondary">
                <?php echo $total_price = $data['quantity']*$product['product_price']; ?>
              </span>
            </li>
            <?php
              $sum_of_total += $total_price;
            }
          }
          ?>
            <li class="list-group-item d-flex justify-content-between">
              <span>Total (INR)</span>
              <strong>
                <?php echo $sum_of_total; ?>
              </strong>
              <input type="hidden" name="total_order_amount" id="total_order_amount" value="<?php echo $sum_of_total; ?>">
            </li>
          </ul>
        <div class="col-md-7 col-lg-8">
          <h4 class="mb-3">Billing address</h4>
          <div class="row g-3">
            <hr class="my-4">
            <?php
              $a_s_query = mysqli_query($conn, "SELECT * FROM `address` WHERE cus_id=$cus_id");
              if (mysqli_num_rows($a_s_query) > 0) {
                while ($address = mysqli_fetch_assoc($a_s_query)) {
                  ?>
            <div class="form-check">
              <input type="radio" name="address" id="address" class="form-check-input" value="<?php echo $address['address_id']; ?>"
                id="same-address">
              <label class="form-check-label" for="same-address">
                <?php echo $address['address_type']; ?>
              </label>
            </div>
            <?php
                }
              }else{
                ?>
            <p>Address not found, Plesae <a href="<?php echo $cus_url . "customer-address.php"; ?>">Add One</a></p>
            <?php
              }
            ?>

            <hr class="my-4">
            <button class="w-100 btn btn-primary btn-lg mb-3" type="submit">Place Order</button>
            <a class="btn btn-success" onclick="startPayment()">Pay Now</a>
          </div>
        </div>
    </form>
  </main>
</div>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function startPayment() {
      var customer = jQuery('#customer').val();
      var address = jQuery('#address').val();
      var amount = jQuery('#total_order_amount').val();
      console.log(customer);
      console.log(address);
      console.log(amount);
        var options = {
            key: "rzp_test_LOQW4a93WLPyup", // Enter the Key ID generated from the Dashboard
            amount: amount*100, // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
            currency: "INR",
            name: "Acme Corp",
            description: "Test transaction",
            image: "https://cdn.razorpay.com/logos/GhRQcyean79PqE_medium.png",
            notes: {
                address: "Razorpay Corporate Office"
            },
            theme: {
                "color": "#3399cc"
            },
            "handler": function (response) {
                jQuery.ajax({
                  type:"post",
                  url:"rzr-payment-process.php",
                  data: {
                    customer : customer, address : address, amount : amount, payment_id : response.razorpay_payment_id
                  },
                  success: function (response) {
                    alert(response);
                    window.location.href = "http://localhost/JPHP18/Project/Project/index.php";
                  },
                });
            }
        };
        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>
<?php
include("./layout/footer.php");
?>