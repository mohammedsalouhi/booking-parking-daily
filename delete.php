<?php
session_start();
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

if (isset($_POST['delete_user_by_admin'])) {
    $user_id = $_POST['id_user'];
    if ($_SESSION['is_admin'] == true) {
        
        // sql to delete a record
        $sql = "DELETE FROM users WHERE id='$user_id'";

        if ($mysqli->query($sql) === TRUE) {
            echo "Record deleted successfully";
            header("location: all_user.php");

        } else {
            echo "Error deleting record: " . $mysqli->error;
        }
    }
}
