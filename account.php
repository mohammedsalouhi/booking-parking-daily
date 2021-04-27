<?php
session_start();
require_once('config.php');

if (isset($_POST['change_username'])) {
    $nuovo_username = strtolower($_POST['nuovo_username']);
    $id = $_SESSION['id'];
    $sql = "UPDATE users SET username='$nuovo_username' WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        $_SESSION['username'] = $nuovo_username;
        header("location: my_account.php");
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}

if (isset($_POST['change_password'])) {
    $nuova_password = password_hash($_POST['nuova_password'], PASSWORD_DEFAULT);
    $id = $_SESSION['id'];
    $sql = "UPDATE users SET password='$nuova_password' WHERE id='$id'";

    if ($mysqli->query($sql) === TRUE) {
        sleep(2);
        header("location: my_account.php");

        session_destroy();
    } else {
        echo "Error updating record: " . $mysqli->error;
    }
}

if (isset($_POST['delete_account'])) {
    $user_id = $_POST['user_id'];
    // sql to delete a record
    $sql = "DELETE FROM users WHERE id='$user_id'";

    if ($mysqli->query($sql) === TRUE) {
        session_destroy();
        echo "Record deleted successfully";
        header("location:index.php");
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
}
