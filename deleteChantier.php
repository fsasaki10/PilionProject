<?php
// Vérifier si l'ID du chantier est passé dans l'URL
if (isset($_GET['id'])) {
  // Filtrer et valider l'ID du chantier
  $idChantier = filter_var($_GET['id'], FILTER_VALIDATE_INT);

  // Utiliser les informations de connexion à la base de données fournies
  $host = "localhost";
  $socket = "/srv/run/mysqld/mysqld.sock";
  $user = "root";
  $password = "";
  $database = "PILION";

  // Créer une connexion
  $conn = new mysqli($host, $user, $password, $database, null, $socket);

  // Vérifier si la connexion a échoué
  if ($conn->connect_error) {
    die("Erreur de connexion à la base de données: " . $conn->connect_error);
  }

  // Préparer la requête de suppression avec un paramètre positionnel
  $deleteSql = "DELETE FROM CHANTIER WHERE ID_CHANTIER = ?";
  
  // Préparer l'objet mysqli_stmt
  $stmt = $conn->prepare($deleteSql);

  // Lier le paramètre à la valeur de l'ID du chantier
  $stmt->bind_param("i", $idChantier);

  // Exécuter la requête
  $stmt->execute();

  // Vérifier si la requête a réussi ou non
  if ($conn->affected_rows > 0) {
    // La suppression a été effectuée avec succès
    header('Location: mesChantiers.php');
    exit;
  } else {
    echo "Erreur lors de la suppression du chantier: l'ID du chantier n'existe pas dans la table CHANTIER.";
  }

  // Fermer la connexion à la base de données
  $conn->close();
} else {
  // L'ID du chantier n'a pas été spécifié, rediriger vers une page d'erreur ou une autre page appropriée
  header('Location: erreur.php');
  exit;
}
?>

