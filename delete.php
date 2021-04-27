<?php
require_once('config.php');
require_once('classes/reservation.php');


if (isset($_POST['id_prenotazione'])) {
    $reservation = new Reservation;
    $reservation->deleteReservationById($_POST['id_prenotazione']);
    if ($_SESSION['is_admin'] == true) {
        header("location: all-reservations.php");
    } else {
        header("location: my_reservations.php");
    }
}
