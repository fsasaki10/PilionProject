<?php
// Vérifier si l'ID du chantier est passé dans l'URL
if (isset($_GET['id'])) {
  $idChantier = $_GET['id'];

  // Code pour se connecter à la base de données
 $servername = "localhost";
$username = "root";
$password = "root";
$dbname = "PILION";

  // Créer une connexion
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Vérifier si la connexion a échoué
  if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
  }

  // Récupérer les informations du chantier à partir de la base de données en utilisant l'ID
  $sql = "SELECT * FROM CHANTIER WHERE ID_CHANTIER = $idChantier";
  $result = $conn->query($sql);

  // Vérifier si le chantier existe dans la base de données
  if ($result->num_rows > 0) {
    $chantier = $result->fetch_assoc();
    $adresseChantier = $chantier['ADRESSE_CHANTIER'];
    $startDate = $chantier['CHANTIER_START_DATE'];
    $endDate = $chantier['CHANTIER_END_DATE'];
    $startReelDate = $chantier['CHANTIER_START_REEL_DATE'];
    $endReelDate = $chantier['CHANTIER_END_REEL_DATE'];
    $chantierType = $chantier['CHANTIER_TYPE'];
    $sousTypeChantier = $chantier['CHANTIER_SOUS_TYPE'];
    $documentEchaffaudage = $chantier['DOCUMENT_ECHAFFAUDAGE'];
    $documentChantier = $chantier['DOCUMENT_CHANTIER'];

    // Vérifier si le formulaire de modification a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      // Récupérer les valeurs soumises du formulaire
      $adresseChantier = $_POST['adresse_chantier'];
      $startDate = $_POST['start_date'];
      $endDate = $_POST['end_date'];
      $startReelDate = $_POST['start_reel_date'];
      $endReelDate = $_POST['end_reel_date'];
      $chantierType = $_POST['chantier_type'];
      $sousTypeChantier = $_POST['sous_type_chantier'];
      $documentEchaffaudage = $_POST['document_echaffaudage'];
      $documentChantier = $_POST['document_chantier'];

      // Mettre à jour les données du chantier dans la base de données
      $updateSql = "UPDATE CHANTIER SET ADRESSE_CHANTIER = '$adresseChantier', CHANTIER_START_DATE = '$startDate', CHANTIER_END_DATE = '$endDate', CHANTIER_START_REEL_DATE = '$startReelDate', CHANTIER_END_REEL_DATE = '$endReelDate', CHANTIER_TYPE = '$chantierType', CHANTIER_SOUS_TYPE = '$sousTypeChantier', DOCUMENT_ECHAFFAUDAGE = '$documentEchaffaudage', DOCUMENT_CHANTIER = '$documentChantier' WHERE ID_CHANTIER = $idChantier";
      if ($conn->query($updateSql) === TRUE) {
        // La mise à jour a été effectuée avec succès
        header('Location: mesChantiers.php');
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
    <label for="adresse_chantier">Adresse du chantier:</label>
    <input type="text" id="adresse_chantier" name="adresse_chantier" value="<?= $adresseChantier ?>"><br><br>

    <label for="start_date">Date de début du chantier:</label>
    <input type="date" id="start_date" name="start_date" value="<?= $startDate ?>"><br><br>

    <label for="end_date">Date de fin du chantier:</label>
    <input type="date" id="end_date" name="end_date" value="<?= $endDate ?>"><br><br>

    <label for="start_reel_date">Date de début réelle du chantier:</label>
    <input type="date" id="start_reel_date" name="start_reel_date" value="<?= $startReelDate ?>"><br><br>

    <label for="end_reel_date">Date de fin réelle du chantier:</label>
    <input type="date" id="end_reel_date" name="end_reel_date" value="<?= $endReelDate ?>"><br><br>

    <label for="chantier_type">Type de chantier:</label>
    <input type="text" id="chantier_type" name="chantier_type" value="<?= $chantierType ?>"><br><br>

    <label for="sous_type_chantier">Sous-type de chantier:</label>
    <input type="text" id="sous_type_chantier" name="sous_type_chantier" value="<?= $sousTypeChantier ?>"><br><br>

    <label for="document_echafaudage">Document d'échafaudage :</label>
    <input type="text" id="document_echafaudage" name="document_echafaudage" value="<?= $documentEchaffaudage ?>"><br><br>


    <label for="document_chantier">Document de chantier :</label>
    <input type="text" id="document_chantier" name="document_chantier" value="<?= $documentChantier ?>"> <br><br>

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
          
                <a href="mesChantiers.php">
                  <img style="width: 70px; height: 70px;" src="srcImage/crochet.png" alt="Ma image">
                </a>
              
        </div>
      </footer>
    </div>

</body>
</html>