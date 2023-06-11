<?php
  // Code pour se connecter à la base de données
 $servername = "localhost";
$username = "root";
$password = "";
$dbname = "PILION";

  // Créer une connexion
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Vérifier si la connexion a échoué
  if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
  }

  // Récupérer les informations du chantier à partir de la base de données en utilisant l'ID
  $sql = "SELECT * FROM MODULE ;
  $result = $conn->query($sql);

  // Vérifier si le chantier existe dans la base de données
  if ($result->num_rows > 0) {
    $module = $result->fetch_assoc();
    $typeModule = $module['TYPE_MODULE'];
    $refCatalogueFabricant = $module['REF_CATALOGUE_FABRICANT'];
    $infoModule = $module['INFO_MODULE'];
    $statutActuel = $module['STATUT_ACTUEL'];
    $proprietaireModule = $module['PROPRIETAIRE_MODULE'];


    // Vérifier si le formulaire de modification a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les valeurs soumises du formulaire
     $typeModule = $_POST['TYPE_MODULE'];
     $refCatalogueFabricant = $_POST['REF_CATALOGUE_FABRICANT'];
     $infoModule = $_POST['INFO_MODULE'];
     $statutActuel = $_POST['STATUT_ACTUEL'];
     $proprietaireModule = $_POST['PROPRIETAIRE_MODULE'];

      // Mettre à jour les données du chantier dans la base de données
      $updateSql = "UPDATE MODULE SET TYPE_MODULE = '$typeModule', REF_CATALOGUE_FABRICANT = '$refCatalogueFabricant',
        INFO_MODULE = '$infoModule', STATUT_ACTUEL = '$statutActuel', PROPRIETAIRE_MODULE = '$proprietaireModule';
        //WHERE ID_CHANTIER = $idChantier";
      if ($conn->query($updateSql) === TRUE) {
        // La mise à jour a été effectuée avec succès
        header('Location: monParc.php');
        exit;
      } else {
        echo "Erreur lors de la mise à jour du chantier: " . $conn->error;
      }
    }
  } else {
    // Le chantier n'a pas été trouvé dans la base de données, rediriger vers une page d'erreur ou une autre page appropriée
    header('Location: erreur.php');
    exit;
  }

  // Fermer la connexion à la base de données
  $conn->close();
} else {
  // L'ID du chantier n'a pas été spécifié, rediriger vers une page d'erreur ou une autre page appropriée
  header('Location: erreur.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Modifier Chantier</title>
  <link rel="stylesheet" type="text/css" href="css/mesChantiers.css">
</head>
<body>

    <div class="container">
      <div class="content">

          <h1>Modifier Chantier</h1>
  
  <form method="POST" action="">
    <label for="type_module">Type module :</label>
          <input type="text" id="type_module" name="type_module"  required><br><br>


          <label for="REF_CATALOGUE_FABRICANT">Reférence catalogue du fabricant :</label>
          <input type="text" id="REF_CATALOGUE_FABRICANT" name="REF_CATALOGUE_FABRICANT" required><br><br>


          <label for="info module">Information sur le module :</label>
          <input type="text" id="info module" name="info module" required><br><br>


          <label for="STATUT ACTUEL">Statut actuel du module :</label>
          <input type="text" id="STATUT ACTUEL" name="STATUT ACTUEL"><br><br>


          <label for="PROPRIETAIRE MODULE">Propriétaire du module :</label>
          <input type="text" id="PROPRIETAIRE MODULE" name="PROPRIETAIRE MODULE"><br><br>


    <!--

    <label for="document_echaffaudage">Document d'échafaudage:</label>
    <input type="file" id="document_echaffaudage" name="document_echaffaudage" value="<?= $documentEchaffaudage ?>">

    <label for="document_chantier">Document du chantier:</label>
    <input type="file" id="document_chantier" name="document_chantier" value="<?= $documentChantier ?>">

  -->

    <input type="submit" value="Enregistrer">
  </form>

      </div>

      <footer class="footer">
        <div style="display:flex; justify-content: center; align-items: center;"> 
          
                <a href="monParc.php">
                  <img style="width: 70px; height: 70px;" src="srcImage/crochet.png" alt="Ma image">
                </a>
              
        </div>
      </footer>
    </div>

</body>
</html>