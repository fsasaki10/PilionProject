<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION["ID_PROPRIETAIRE"])) {
    header("Location: connexion.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8">
    <title>PILION</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  </head>
  <body>
    <div class="bloc">Portail PILION</div>

    <div class="container">
    <i class="fas fa-user-circle profile-icon"></i>
    </div><br>
    <!-- Display the username -->
    <div style="text-align: center; font-size: 40px; margin-bottom: 40px;"> <?php echo $_SESSION['NOM_PROPRIETAIRE']; ?> </div>

    <div class="bloc2">
      <a href="mesChantiers.php">
        <img class="image-container" src="./srcImage/crochet.png" alt="Ma image">
      </a>
    </div>

    <div class="bloc2">
      <a href="monParc.php">
        <img class="image-container" src="./srcImage/monParc.png" alt="Ma image">
      </a>
    </div>

    <div class="bloc2">
      <a href="statistiques.php">
        <img class="image-container" src="./srcImage/statistiques.png" alt="Ma image">
      </a>
    </div>

   </body>
</html>
