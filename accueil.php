<?php
session_start();
if (!isset($_SESSION['is_login']) || $_SESSION['is_login'] !== 'true') {
    header("Location: login.php");
    exit();
}

$role = $_SESSION['role'];
$direction = $_SESSION['direction'];

$directions = [
    1 => "Direction Générale",
    2 => "Direction de l'administration et des finances",
    3 => "Direction des réseaux et des systèmes d'information géographiques",
    4 => "Direction des études générales et de la prospective",
    5 => "Direction de la maîtrise d'ouvrage et des programmes de réalisations urbaines"
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Suivi PRI - Tableau de Bord</title>
  <link rel="shortcut icon" href="assets/images/logo.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
	<link href="assets/css/accueil.css" rel="stylesheet" type="text/css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark px-3">
    <div class="container-fluid justify-content-between align-items-center">
      <a class="navbar-brand d-flex align-items-center" href="accueil.php">
        <img src="assets/images/logo.png" alt="Logo" width="50" class="me-2" />
        Suivi PRI
      </a>
      <div class="mx-auto navbar-title text-white text-center">
        Suivi de la Prime de Rendement Individuel
      </div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <?php if ($role == 'admin') { ?>
            <li class="nav-item"><a class="nav-link text-white" href="user_management.php">Gestion des Utilisateurs</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="employee_managment.php">Gestion des Employés</a></li>
          <?php } ?>
        </ul>
      </div>
    </div>
  </nav>

  <div style="background: rgb(240 206 144 / 30%)">
    <main class="container py-5">
      <div class="mb-5 position-relative hero-card">
        <img src="assets/images/bg4.png" class="img-fluid rounded shadow hero-image" alt="cover" />
        <div class="hero-overlay position-absolute top-0 start-0 w-100 h-100 rounded d-flex align-items-center justify-content-center">
          <div class="text-center text-white px-3 hero-text fade-in">
            <h2 class="fw-bold mb-2">Suivi de la Prime de Rendement Individuel</h2>
            <p class="lead">Visualisez les performances, gérez vos équipes et atteignez vos objectifs.</p>
          </div>
        </div>
      </div>

      <div class="row g-4">
        <?php foreach ($directions as $id => $name): ?>
          <?php
          $isAllowed = ($role !== 'utilisateur') || (intval($direction) === $id);
          $cardClass = $isAllowed ? '' : 'disabled-card';
          if ($id == 4) echo '<div class="col-md-6 col-lg-2 col-xl-2 d-flex"></div>';
          ?>
          <div class="col-md-6 col-lg-4 col-xl-4 d-flex">
            <div class="card bg-perso-dark w-100 <?= $cardClass ?>">
              <div class="el-card-item">
                <div class="el-card-avatar el-overlay-1">
                  <img src="assets/images/dir<?= $id ?>.png" alt="direction" />
                  <div class="el-overlay">
                    <ul class="el-info">
                      <li>
                        <a class="btn default btn-outline image-popup-vertical-fit" href="<?= $isAllowed ? 'pri.php?dir=' . $id : '#' ?>">
                          Consulter <i class="fa fa-external-link-square"></i>
                        </a>
                      </li>
                    </ul>
                  </div>
                </div>
                <div class="el-card-content">
                  <h3 class="box-title"><?= $name ?></h3>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

      <footer class="text-center text-muted mt-5 mb-3">
        <p>&copy; ANURB 2025. Tous Droits Réservés.</p>
      </footer>
    </main>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
