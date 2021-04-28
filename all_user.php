<?php
require_once('config.php');
require_once('classes/reservation.php');

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

    <h1 class="text-center mt-5">TUTTI GLI UTENTI</h1>

    <?php



    $utenti_query = "SELECT * FROM users";
    $result = $mysqli->query($utenti_query);
    // if ($result->num_rows > 0) {

    //     $utenti = $result->fetch_assoc();
    //     echo "<hr>";
    //     echo "<hr>";
    // } else {
    //     echo "0 results";
    // }
    ?>
    <?php if (true/*$utenti*/) : ?>
        <table class='table table-bordered table-hover rounded shadow-lg mt-5'>
            <thead class="text-center">
                <th>id</th>
                <th>Username</th>

                <th>Cancella utente</th>
            </thead>
            <tbody>

                <?php
                /*foreach ($utenti as $key => $row) {
                    echo "<tr>";

                    foreach ($row as $key2 => $row2) {
                        echo "<td>" . $row2 . "</td>";
                    }

                    $form = "<td class='text-center'>";
                    $form .= "<form action='delete.php' method='post'>";
                    $form .= "<input type='hidden' name='id_prenotazione' value='" . $row . "'>";
                    $form .= "<button type='submit' class='btn btn-outline-danger' name='delete'><i class='far fa-trash-alt'></i></button>";
                    $form .= "</form></td>";
                    echo $form;
                    echo "</tr>";
                }*/

                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row['is_admin'] == true) {
                       continue;
                    } 
                    echo "<tr class='text-center'>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    $form = "<td class='text-center'>";
                    

                        $form .= "<form action='delete.php' method='post'>";
                        $form .= "<input type='hidden' name='id_user' value='" . $row['id'] . "'>";
                        $form .= "<button type='submit' class='btn btn-outline-danger' name='delete_user_by_admin'><i class='far fa-trash-alt'></i></button>";
                        $form .= "</form></td>";
                  
                    echo $form;
                    echo "</tr>";
                }

                ?>
            </tbody>
        </table>

    <?php endif ?>


    <!-- sezione footer -->
    <?php include('inc/footer.php'); ?>
    <!--fine sezione footer -->

</div>
<!-- END BODY -->