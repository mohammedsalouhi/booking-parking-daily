<nav class="navbar navbar-expand-md navbar-light">
  <!-- Brand -->
  <a class="navbar-brand" href="#"><img src="assets/FALS-PARKING-LOGO.png" alt="" style="width: 150px;"></a>

  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="index_admin.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="all-reservations.php">Prenotazioni</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" href="all_user.php">Utenti</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="my_account.php">Mio Account</a>
      </li>
      <?php if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true):?>
      <li class="nav-item">
        <a class="nav-link" href="logout.php" id="logout"><i class="fas fa-user">  Logout</i></a>
      </li>
      <?php endif?>
    </ul>
  </div>
</nav>

