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

  // Supprimer le chantier de la base de données en utilisant l'ID
  $deleteSql = "DELETE FROM CHANTIER WHERE ID_CHANTIER = $idChantier";
  if ($conn->query($deleteSql) === TRUE) {
    // La suppression a été effectuée avec succès
    header('Location: mesChantiers.php');
    exit;
  } else {
    echo "Erreur lors de la suppression du chantier: " . $conn->error;
  }

  // Fermer la connexion à la base de données
  $conn->close();
} else {
  // L'ID du chantier n'a pas été spécifié, rediriger vers une page d'erreur ou une autre page appropriée
  header('Location: erreur.php');
  exit;
}
?>
