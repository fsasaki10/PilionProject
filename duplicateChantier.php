<?php

$idRAND = rand(1000000, 9000000) + 450;
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
  $selectSql = "SELECT * FROM CHANTIER WHERE ID_CHANTIER = $idChantier";
  $result = $conn->query($selectSql);

  // Vérifier si le chantier existe dans la base de données
  if ($result->num_rows > 0) {
    $chantier = $result->fetch_assoc();

    // Copier les valeurs du chantier existant pour créer une duplication
    $newChantierData = $chantier;
    // Vous pouvez également modifier certaines valeurs si nécessaire
    $newChantierData['ID_CHANTIER'] = $idRAND;

    
    // Insérer le nouveau chantier dans la base de données
    $insertSql = "INSERT INTO CHANTIER (ID_CHANTIER, ADRESSE_CHANTIER, CHANTIER_START_DATE, CHANTIER_END_DATE, CHANTIER_START_REEL_DATE, CHANTIER_END_REEL_DATE, CHANTIER_TYPE, CHANTIER_SOUS_TYPE, DOCUMENT_ECHAFFAUDAGE, DOCUMENT_CHANTIER) VALUES ('{$newChantierData['ID_CHANTIER']}', '{$newChantierData['ADRESSE_CHANTIER']}', '{$newChantierData['CHANTIER_START_DATE']}', '{$newChantierData['CHANTIER_END_DATE']}', '{$newChantierData['CHANTIER_START_REEL_DATE']}', '{$newChantierData['CHANTIER_END_REEL_DATE']}', '{$newChantierData['CHANTIER_TYPE']}', '{$newChantierData['CHANTIER_SOUS_TYPE']}', '{$newChantierData['DOCUMENT_ECHAFFAUDAGE']}', '{$newChantierData['DOCUMENT_CHANTIER']}')";

    if ($conn->query($insertSql) === TRUE) {
      // La duplication a été effectuée avec succès
      header('Location: mesChantiers.php');
      exit;
    } else {
      echo "Erreur lors de la duplication du chantier: " . $conn->error;
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