<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
        header("location: login.php");
        exit;
}
if ($_SESSION['is_admin'] == true) {
        header("location: index_admin.php");
}
?>

<!-- sezione head -->
<?php include('inc/head.php'); ?>

<!-- BODY -->
<div class="container">


        <!-- sezione navbar -->
        <?php include('inc/navbar.php'); ?>
        <!-- fine sezione navbar -->
        <h1>sono la index utente</h1>


        <div class="alert alert-success alert-dismissible fade show">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <h6 class="my-1">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h6>
        </div>


        <!-- sezione prenotazione -->
        <?php include('inc/booking.php'); ?>
        <!-- fine sezione prenotazione -->



        <!-- sezione footer -->
        <?php include('inc/footer.php'); ?>
        <!--fine sezione footer -->

</div>
<!-- END BODY -->