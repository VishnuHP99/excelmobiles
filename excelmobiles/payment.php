<?php
session_start();
error_reporting(0);
include_once('includes/dbconnection.php');
if (strlen($_SESSION['msmsuid']==0)) {
  header('location:logout.php');
  } else{ 

//placing order

if(isset($_POST['placeorder'])){
//getting address
$fnaobno=$_POST['flatbldgnumber'];
$street=$_POST['streename'];
$area=$_POST['area'];
$lndmark=$_POST['landmark'];
$city=$_POST['city'];
$zipcode=$_POST['zipcode'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$cod=$_POST['cod'];
$userid=$_SESSION['msmsuid'];
//genrating order number
$orderno= mt_rand(100000000, 999999999);
$query="update tblorders set OrderNumber='$orderno',IsOrderPlaced='1',PaymentMode='$cod' where UserId='$userid' and IsOrderPlaced is null;";
$query.="insert into tblorderaddresses(UserId,Ordernumber,Flatnobuldngno,StreetName,Area,Landmark,City,Zipcode,Phone,Email) values('$userid','$orderno','$fnaobno','$street','$area','$lndmark','$city','$zipcode','$phone','$email');";

$result = mysqli_multi_query($con, $query);
if ($result) {

echo '<script>alert("Your order placed successfully. Order number is "+"'.$orderno.'")</script>';
echo "<script>window.location.href='my-order.php'</script>";

}
}    

 }   ?>
<!DOCTYPE html>
<html lang="zxx">


<head>
    <title>Excel Mobiles||Checkout Page</title>
    <!-- Vendor CSS Files -->
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/vendor/fontawesome.css">
    <link rel="stylesheet" href="assets/css/vendor/plaza-icon.css">
    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css">

    <!-- Plugin CSS Files -->
    <link rel="stylesheet" href="assets/css/plugin/swiper.min.css">
    <link rel="stylesheet" href="assets/css/plugin/material-scrolltop.css">
    <link rel="stylesheet" href="assets/css/plugin/price_range_style.css">
    <link rel="stylesheet" href="assets/css/plugin/in-number.css">
    <link rel="stylesheet" href="assets/css/plugin/venobox.min.css">
    <!-- Main Style CSS File -->
    <link rel="stylesheet" href="assets/css/main.css">
</head>


<body>

<?php
include_once('includes/header.php');
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3 class="text-center mb-4">Make Online Payment</h3>
            <form action="submit_payment.php" method="POST" enctype="multipart/form-data" class="border p-4 shadow rounded" style="background-color: #f8f9fa;">

                <!-- QR Code Display -->
                <div class="text-center mb-4">
                    <!-- Replace src with your actual QR image path -->
                    <img src="images/qr_placeholder.png" alt="QR Code for Payment" class="img-fluid" style="max-width: 250px;">
                </div>

                <!-- User Details -->
                <div class="form-group mb-3">
                    <label for="username" class="text-primary fw-bold">Name</label>
                    <input type="text" class="form-control border-primary" id="username" name="username" required>
                </div>

                <div class="form-group mb-3">
                    <label for="email" class="text-primary fw-bold">Email</label>
                    <input type="email" class="form-control border-primary" id="email" name="email" required>
                </div>

                <div class="form-group mb-3">
                    <label for="mobile" class="text-primary fw-bold">Mobile Number</label>
                    <input type="tel" class="form-control border-primary" id="mobile" name="mobile" required>
                </div>

                <div class="form-group mb-4">
                    <label for="screenshot" class="text-primary fw-bold">Upload Payment Screenshot</label>
                    <input type="file" class="form-control border-primary" id="screenshot" name="screenshot" accept="image/*" required>
                </div>

                <div class="text-center">
                <button class="btn btn--block btn--small btn--blue btn--uppercase btn--weight" type="submit" name="placeorder">PLACE ORDER</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php'; // or your footer include file
?>
 <!-- ::::::  Start  Footer Section  ::::::  -->
 <?php include_once('includes/footer.php');?>

<!-- material-scrolltop button -->
<button class="material-scrolltop" type="button"></button>


<!-- ::::::::::::::All Javascripts Files here ::::::::::::::-->

<!-- Vendor JS Files -->
<script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
<script src="assets/js/vendor/modernizr-3.7.1.min.js"></script>
<script src="assets/js/vendor/jquery-ui.min.js"></script>
<script src="assets/js/vendor/bootstrap.bundle.js"></script>

<!-- Plugins JS Files -->
<script src="assets/js/plugin/swiper.min.js"></script>
<script src="assets/js/plugin/jquery.countdown.min.js"></script>
<script src="assets/js/plugin/material-scrolltop.js"></script>
<script src="assets/js/plugin/price_range_script.js"></script>
<script src="assets/js/plugin/in-number.js"></script>
<script src="assets/js/plugin/jquery.elevateZoom-3.0.8.min.js"></script>
<script src="assets/js/plugin/venobox.min.js"></script>

<!-- Use the minified version files listed below for better performance and remove the files listed above -->
<!-- <script src="assets/js/vendor/vendor.min.js"></script>
<script src="assets/js/plugin/plugins.min.js"></script> -->

<!-- Main js file that contents all jQuery plugins activation. -->
<script src="assets/js/main.js"></script>
</body>

</html>