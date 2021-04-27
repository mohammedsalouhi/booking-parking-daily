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
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="my_reservations.php">Le Mie Prenotazioni</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="my_account.php">Mio Account</a>
      </li>
      <?php if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) : ?>
        <li class="nav-item">
          <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown"><i class="fas fa-user"></i> <?=ucfirst($_SESSION['username'])?>
              <span class="caret"></span></button>
            <ul class="dropdown-menu">
              <li><a class="nav-link" href="logout.php" id="logout">Logout</a></li>
            </ul>
          </div>
        </li>

      <?php endif ?>
    </ul>
  </div>
</nav>