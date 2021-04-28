<?php

class Reservation
{
    private $conn;
    private $user;


    public function __construct()
    {

        /* Attempt to connect to MySQL database */
        $mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

        // Check connection
        if ($mysqli === false) {
            die("ERROR: Could not connect. " . $mysqli->connect_error);
        }

        $this->conn = $mysqli;
        $this->user = $_SESSION['id'];
    }

    //SELECT

    public function getReservationById($id)
    {

        $sql = "SELECT * FROM reservations WHERE id='$id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        } else {
            echo "non ci sono prenotazioni con questo id";
        }
    }
    public function getReservationsByUser($user_id)
    {

        $sql = "SELECT * FROM reservations WHERE created_by='$user_id'";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } else {
            echo "non avete prenotazioni per il momento";
        }
    }

    public function getReservations()
    {

        $sql = "SELECT r.id, r.checkin_date,r.checkout_date, r.vehicle_plate,r.vehicle_type, r.created_by, u.username,r.parking_space, r.total_amount, r.created_by,r.created_at FROM reservations as r JOIN users as u ON r.created_by=u.id";


        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);
            return $rows;
        } else {
            echo "non ci sono prenotazioni";
        }
    }

    //INSERT

    // public function addReservation($data_checkin, $data_checkout, $targa, $tipo_veicolo)
    // {
    //     $data_checkin = $this->formatDate($data_checkin);
    //     $data_checkout = $this->formatDate($data_checkout);
    //     $parking_spaces_query = "SELECT id FROM parking_spaces WHERE vehicle_type='$tipo_veicolo';";

    //     $array_parcheggi = array();
    //     $parking_spaces = $this->conn->query($parking_spaces_query);
    //     if ($parking_spaces->num_rows > 0) {
    //         $array_parcheggi = $parking_spaces->fetch_all(MYSQLI_ASSOC);
    //         echo "<hr>";
    //         //var_dump($array_parcheggi);
    //     } else {
    //         echo "non ci sono parcheggi di questo genere";
    //     }

    //     $ristrection_query = $this->conn->prepare( "SELECT id FROM   reservations
    //     WHERE '$data_checkin' BETWEEN reservations.checkin_date AND reservations.checkout_date OR
    //            '$data_checkout' BETWEEN reservations.checkin_date AND reservations.checkout_date AND parking_space= ?");
    //     $ristrection_query->bind_param('s', $posto_macchina);

    //     //$sql = "INSERT INTO reservations(checkin_date, checkout_date, vehicle_plate, vehicle_type, created_by) VALUES('$data_checkin','$data_checkout', '$targa', '$tipo_veicolo', '$this->user')";

    //     // preparo and bendo
    //     $stmt = $this->conn->prepare("INSERT INTO reservations(checkin_date, checkout_date, vehicle_plate, vehicle_type, parking_space, total_amount, created_by) VALUES(?,?,?,?,?,?,?)");
    //     $stmt->bind_param("sssssss", $checkin, $checkout, $plate, $vtype, $ps, $ta, $utente);

    //     $ckeckin = $data_checkin;
    //     $ckeckout = $data_checkout;
    //     $plate = $targa;
    //     $vtype = $tipo_veicolo;
    //     $utente = $this->user;
    //     $ta = 0;
    //     $datetime1 = new DateTime($ckeckin);
    //     $datetime2 = new DateTime($ckeckout);
    //     $diff = $datetime2->diff($datetime1);

    //     $prezzo_query = "SELECT daily_price FROM prices WHERE vehicle_type='$vtype'";
    //     $result = $this->conn->query($prezzo_query);

    //     if ($result->num_rows > 0) {
    //         $prezzo = $result->fetch_assoc();
    //         $ta = $diff->days * $prezzo['daily_price'];


    //     } else {
    //         echo "non sono riuscito a prendere il prezzo";
    //     }


    //     foreach ($array_parcheggi as $key => $value) {
    //         $ps = $value['id'];
    //         $posto_macchina =$ps;
    //         $ristrection_query->execute();
    //         $ristrection_query->bind_result($id_reservation);
    //         $ristrection_query->fetch();
    //         $numberofrows = $ristrection_query->num_rows;



    //         if ($numberofrows === 0) {
    //             if ($stmt->execute() === TRUE) {
    //                 echo '  <div class="alert alert-success alert-dismissable">
    //                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    //                     <strong>prenotazione aggiunta con successo, consulta la pagina prenotazioni per il prezzo dovuto, il pagamento è al Checkout</strong>
    //                 </div>';
    //                 $stmt->close();
    //                 $ristrection_query->close();
    //                 break;
    //             } else {
    //                 echo "Error: " . $this->conn->error. "questo è un errore brutto<br>";
    //             }
    //         } else {
    //             echo '  <div class="alert alert-danger alert-dismissable">
    //                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    //                     <strong>Il Parcheggio è purtroppo occupato nelle giornate selezionate</strong>
    //                 </div>';
    //         }
    //     }
    // }

    public function addReservation($data_checkin, $data_checkout, $targa, $tipo_veicolo)
    {
        $data_checkin = $this->formatDate($data_checkin);
        $data_checkout = $this->formatDate($data_checkout);
        $parking_spaces_query = "SELECT id FROM parking_spaces WHERE vehicle_type='$tipo_veicolo';";

        $array_parcheggi = array();
        $parking_spaces = $this->conn->query($parking_spaces_query);
        if ($parking_spaces->num_rows > 0) {
            $array_parcheggi = $parking_spaces->fetch_all(MYSQLI_ASSOC);
        } else {
            echo "non ci sono parcheggi di questo genere";
        }

        $ristrection_query = "SELECT id FROM   reservations
        WHERE '$data_checkin' BETWEEN reservations.checkin_date AND reservations.checkout_date OR
               '$data_checkout' BETWEEN reservations.checkin_date AND reservations.checkout_date AND parking_space=";

        $total_amount = 0;
        $datetime1 = new DateTime($data_checkin);
        $datetime2 = new DateTime($data_checkout);
        $diff = $datetime2->diff($datetime1);

        $prezzo_query = "SELECT daily_price FROM prices WHERE vehicle_type='$tipo_veicolo'";
        $result = $this->conn->query($prezzo_query);

        if ($result->num_rows > 0) {
            $prezzo = $result->fetch_assoc();
            $total_amount = $diff->days * $prezzo['daily_price'];
        } else {
            echo "non sono riuscito a prendere il prezzo";
        }

        $total_amount = 0;
        $datetime1 = new DateTime($data_checkin);
        $datetime2 = new DateTime($data_checkout);
        $diff = $datetime2->diff($datetime1);

        $prezzo_query = "SELECT daily_price FROM prices WHERE vehicle_type='$tipo_veicolo'";
        $result = $this->conn->query($prezzo_query);

        if ($result->num_rows > 0) {
            $prezzo = $result->fetch_assoc();
            $total_amount = $diff->days * $prezzo['daily_price'];
        } else {
            echo "non sono riuscito a prendere il prezzo";
        }

        var_dump($array_parcheggi[1]['id']);

        $posto = $array_parcheggi[0]['id'];
        $ristrection_query .= "'$posto';";
        $risultato = $this->conn->query($ristrection_query);
        echo "<hr>";
        if (is_object($risultato)) {

            if ($risultato->num_rows == 0) {

                $sql = "INSERT INTO reservations(checkin_date, checkout_date, vehicle_plate, vehicle_type, parking_space, total_amount, created_by) VALUES('$data_checkin','$data_checkout', '$targa', '$tipo_veicolo', '$posto', '$total_amount', '$this->user')";
               

                if ($this->conn->query($sql) === TRUE) {
                    echo '  <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>prenotazione aggiunta con successo, consulta la pagina prenotazioni per il prezzo dovuto, il pagamento è al Checkout</strong>
                    </div>';
                } else {
                    echo "Error: " . $this->conn->error . "questo è un errore brutto<br>";
                }
            } elseif ($risultato->num_rows == 1) {
                $posto = $array_parcheggi[1]['id'];
                $sql = "INSERT INTO reservations(checkin_date, checkout_date, vehicle_plate, vehicle_type, parking_space, total_amount, created_by) VALUES('$data_checkin','$data_checkout', '$targa', '$tipo_veicolo', '$posto', '$total_amount', '$this->user')";
                echo "<hr>";
                echo $sql;
                echo "<hr>";

                if ($this->conn->query($sql) === TRUE) {
                    echo '  <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>prenotazione aggiunta con successo, consulta la pagina prenotazioni per il prezzo dovuto, il pagamento è al Checkout</strong>
                    </div>';
                } else {
                    echo "Error: " . $this->conn->error . "questo è un errore brutto<br>";
                }
            } else {
                echo '  <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                        <strong>Il Parcheggio è purtroppo occupato nelle giornate selezionate</strong>
                    </div>';
            }
        }
    }

    //update

    public function updateReservationById($id, $data_checkin, $data_checkout, $targa, $tipo_veicolo)
    {
        $data_checkin = $this->formatDate($data_checkin);
        $data_checkout = $this->formatDate($data_checkout);

        $sql = "UPDATE reservations SET checkin_date='$data_checkin',checkout_date='$data_checkout',vehicle_plate='$targa',vehicle_type='$tipo_veicolo' WHERE id='$id";

        if ($this->conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $this->conn->error;
        }
    }

    //delete
    public function deleteReservationById($id)
    {

        $sql = "DELETE FROM reservations WHERE id='$id'";


        if ($this->conn->query($sql) === TRUE) {

            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . $this->conn->error;
        }
    }

    private function formatDate($date)
    {
        $date = str_replace('/"', '-', $date);
        $newDate = date("Y/m/d", strtotime($date));
        return $newDate;
    }
}
