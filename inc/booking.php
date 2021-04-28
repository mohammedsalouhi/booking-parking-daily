<?PHP
// Include config file
require_once "config.php";
require_once "classes/reservation.php";
$date_occupate = array();
if (isset($_POST['prenota'])) {
    $data_checkin = $_POST['data_checkin'];
    echo $data_checkin;
    $data_checkout = $_POST['data_checkout'];
    $tipo_veicolo = $_POST['tipo_veicolo'];
    $targa = $_POST['targa'];
    $prenotato_da = $_SESSION["id"];

    $reservation = new Reservation;
    $reservation->addReservation($data_checkin, $data_checkout, $targa, $tipo_veicolo);

    //$prenotazioni = $reservation->getReservations();
    #var_dump($prenotazioni);
    //echo '<br><hr><br>';
    //$count = 0;
/*
    foreach ($prenotazioni as $x => $values) {

        $date_occupate[$count++] = array($values['checkin_date'], $values['checkout_date']);
    }
    */
}



?>
<script>
    $(function() {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
        var yyyy = today.getFullYear();

        today = dd + '-' + mm + '-' + yyyy;

        var dateFormat = "dd-mm-yy",
            from = $("#from")
            .datepicker({
                dateFormat: dateFormat,
                //defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 2,
                minDate: today
            })
            .on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#to").datepicker({
                dateFormat: dateFormat,
                //defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 2,
                minDate: today
            })
            .on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }

            return date;
        }
    });
</script>
</head>

<div class="alert alert-success">

    <div class="row">
        <div class="col-sm-8">
            <h1 class="text-center">Prenota il tuo parcheggio</h1>

            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"> Checkin</i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Data di check-in" id="from" name="data_checkin" required>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-calendar-alt"> Checkout</i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="Data di check-out" id="to" name="data_checkout" required>
                </div>


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01"><i class="fas fa-shuttle-van"></i>Tipologia veicolo</label>
                    </div>
                    <select class="custom-select" name="tipo_veicolo" required>
                        <option value="macchina">Macchina</option>
                        <option value="moto">Moto</option>
                        <option value="camper">Camper e Autocarri</option>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text">Targa</i></span>
                    </div>
                    <input type="text" class="form-control" placeholder="targa del veicolo" name="targa" required>
                </div>


                <input type="submit" value="Prenota" class="btn btn-outline-success btn-block rounded-pill" name="prenota">
            </form>

        </div>
        <div class="col-sm-4 pt-5">

            <img src="assets/FALS-PARKING-LOGO.png" alt="" class="img-fluid">
            <h1 class="text-center">Ti diamo Il Benvenuto</h1>
        </div>



    </div>

</div>
<?/*if(isset($date_occupate)):?>
<?php
foreach ($date_occupate as $values) {
    echo "<div class='alert alert-danger' role='alert'> il parcheggio è occupato dal <strong>" . $values[0] . "</strong> al <strong>" . $values[1] . "</strong></div>";
}
echo "<hr>";
for ($i = 1; $i < count($date_occupate); $i++) {

    $date1 = new DateTime($date_occupate[$i][0]);
    $date2 = new DateTime($date_occupate[$i - 1][1]);
    $periodo_libero = $date1->diff($date2)->format("%d");
    if ($periodo_libero >= 2) {
        $Date = "2010-09-17";
        $inizio = date('Y-m-d', strtotime($date_occupate[$i - 1][1] . ' + 1 days'));
        $fine = date('Y-m-d', strtotime($date_occupate[$i][0] . ' - 1 days'));
        if ($inizio == $fine) {
            echo "<div class='alert alert-success' role='alert'> il parcheggio è libero nella giornata <strong>" . $inizio . "</strong></div>";
        } else {
            echo "<div class='alert alert-success' role='alert'> il parcheggio è libero tra <strong>" . $inizio . "</strong> e <strong>" . $fine . "</strong></div>";
        }
    }
    if ($i == count($date_occupate) - 1) {
        echo "<div class='alert alert-success' role='alert'> il parcheggio è libero dopo <strong>" . date('Y-m-d', strtotime($date_occupate[$i][1] . ' + 1 days')) . "</strong></div>";
    }
}
?>

<?endif*/?>