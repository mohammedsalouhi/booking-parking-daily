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

    <h1 class="text-center mt-5">Le mie Prenotazioni</h1>

    <?php
    $reservation = new Reservation;
    $prenotazioni = $reservation->getReservations(); ?>
    <?php if ($prenotazioni) : ?>

        <table class='table table-bordered table-hover rounded shadow-lg mt-5'>
            <thead class="text-center">
                <th>id Prenotazione</th>
                <th>Data Checkin</th>
                <th>Data Ckeckout</th>
                <th>Targa</th>
                <th>Tipologia Veicolo</th>
                <th>Prenotato Da -id-</th>
                <th>Prenotato Da -username-</th>
                <th>Posto n°</th>
                <th>Importo Dovuto (€)</th>
                <th>Prenotato in Data</th>
                <th>Cancella prenotazione</th>
            </thead>
            <tbody>

                <?php
                foreach ($prenotazioni as $key => $row) {
                    echo "<tr>";
                    foreach ($row as $key2 => $row2) {
                        echo "<td>" . $row2 . "</td>";
                    }
                    $form = "<td class='text-center'>";
                    $form .= "<form action='delete.php' method='post'>";
                    $form .= "<input type='hidden' name='id_prenotazione' value='" . $row['id'] . "'>";
                    $form .= "<button type='submit' class='btn btn-outline-danger' name='delete'><i class='far fa-trash-alt'></i></button>";
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