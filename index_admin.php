<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
}
?>

<!-- sezione head -->
<?php include('inc/head.php'); ?>


<!-- BODY -->
<div class="container">
        
        
        <!-- sezione navbar -->
        <?php include('inc/navbar-admin.php'); ?>
        <!-- fine sezione navbar -->
        <h1>sono la index admin</h1>
        
        <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>


        <!-- sezione footer -->
        <?php include('inc/footer.php'); ?>
        <!--fine sezione footer -->

</div>
<!-- END BODY -->