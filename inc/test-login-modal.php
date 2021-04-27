<?php

require "classes/User.php";
// (A) PROCESS LOGIN ON SUBMIT
session_start();
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
if (isset($post['accedi'])) {
  
  $USR->login($post['email'], $post['password']);
}

if (isset($post['registrati'])) {
    $name = $post['username'];
    $email = $post['email'];
    $pass = $post['password'];
  
  $USR->save ($name, $email, $pass, "A", $data=null, $id=null);
}


 
// (B) REDIRECT USER IF SIGNED IN
if (isset($_SESSION['user'])) {
  header("Location: index.php");
  exit();
}
 
// (C) SHOW LOGIN FORM OTHERWISE ?>
<?php
if (isset($_POST['email'])) {
  echo "<div id='notify'>Invalid user/password</div>";
}

?>


<script type="text/javascript">
    $(window).on('load', function() {
        $('#ModalLoginForm').modal('show');
    });
</script>

<!-- Modal HTML Markup -->
<div id="ModalLoginForm" class="modal fade">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title">Accedi</h1>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Indirizzo Email</label>
                        <div>
                            <input type="email" class="form-control input-lg" name="email" placeholder="Inserisci Email" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" placeholder="Inserisci Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" data-dismiss="MyModal" aria-label="Close" class=" btn btn-outline-success btn-block rounded-pill" value="accedi">Accedi</button>

                            <a class="btn btn-link" href="">Hai dimenticato Password? Cavoli tuoi</a>
                        </div>
                    </div>
                </form>
                <hr>
                <h1>Oppure registrati</h1>
                <p style="font-size: 10px;">Anche se ci occuperai il database, ma tranquillo, ci pensiamo dopo a fartela pagare</p>
                <form role="form" method="POST" action="">
                    <input type="hidden" name="_token" value="">
                    <div class="form-group">
                        <label class="control-label">Username</label>
                        <div>
                            <input type="text" class="form-control input-lg" placeholder="Inserisci Username" name="username">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Indirizzo Email</label>
                        <div>
                            <input type="email" class="form-control input-lg" placeholder="Inserisci Email" name="email">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" placeholder="Inserisci Una Password" name="password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Conferma Password</label>
                        <div>
                            <input type="password" class="form-control input-lg" placeholder="Reinserisci la password di nuovo" name="password_confirmation">
                        </div>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-outline-success btn-block rounded-pill" value="registrati">
                                Registrati
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->