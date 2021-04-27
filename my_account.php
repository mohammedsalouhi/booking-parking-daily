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

<script>
    $(function() {
        $("#username-form,#password-form").hide() // try to hide google navigation bar
    });
    $(document).ready(function() {
        $("#change-username").click(function() {
            $("#username-form").toggle(100);
        });
    });
    $(document).ready(function() {
        $("#change-password").click(function() {
            $("#password-form").toggle(100);
        });
    });
</script>

<!-- BODY -->
<div class="container">


    <!-- sezione navbar -->
    <?php include('inc/navbar.php'); ?>
    <!-- fine sezione navbar -->

    <div class="border rounded shadow-lg mt-5 p-3">
        <ul class="list-group">
            <h1 class="text-center m-5">Il Mio Account</h1>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h3>Username: <strong class="text-muted"><?= $_SESSION['username'] ?></strong></h3>
                <button class="btn btn-outline-danger" id="change-username"><i class="far fa-edit"></i></button>
            </li>
            <li class="list-group-item" id="username-form">
                <form action="account.php" method="post">
                    <input type="text" name="nuovo_username" placeholder="nuovo Username" class="form-control m-1">
                    <input type="submit" name="change_username" value="Cambia Username" class="btn btn-outline-success m-1 btn-block">
                </form>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <h3>Password</h3>
                <button class="btn btn-outline-danger" id="change-password"><i class="far fa-edit"></i></button>
                
            </li>
            <li class="list-group-item" id="password-form">
                <form action="account.php" method="post">
                    <input type="password" name="nuova_password" placeholder="nuova password" class="form-control m-1">
                    <input type="submit" name="change_password" value="Cambia Password" class="btn btn-outline-success m-1 btn-block">
                    <p class="text-danger text-center">Per ragione di sicurezza verrai reindirizzato al login</p>
                </form>
            </li>
            <form action="account.php" method="post">
                <input type="hidden" name="user_id" value="<?=$_SESSION['id']?>">
                <input type="submit" name="delete_account" value="Cancella Account" class="btn btn-outline-danger mt-4 btn-block">
            </form>
        </ul>
    </div>


    <!-- sezione footer -->
    <?php include('inc/footer.php'); ?>
    <!--fine sezione footer -->

</div>
<!-- END BODY -->