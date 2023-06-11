<?php
session_start();

// Définir les constantes de connexion à la base de données
define("DB_HOST", "localhost");
define("DB_SOCKET", "/srv/run/mysqld/mysqld.sock");
define("DB_USER", "root");
define("DB_PASS", "");
define("DB_NAME", "PILION");

// Vérifier que toutes les données du formulaire sont présentes
if (isset($_POST["adresse_chantier"]) && isset($_POST["chantier_start_date"]) && isset($_POST["chantier_end_date"]) && isset($_POST["chantier_start_reel_date"]) && isset($_POST["chantier_end_reel_date"]) && isset($_POST["chantier_type"]) && isset($_POST["chantier_sous_type"]) && isset($_POST["document_echafaudage"]) && isset($_POST["document_chantier"])) {

  try {
    // Créer une instance de PDO avec les constantes définies
    $pdo = new PDO(
      "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";unix_socket=" . DB_SOCKET,
      DB_USER,
      DB_PASS
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Générer un identifiant aléatoire pour le chantier
    $id = rand(1000000,9000000) + 450;

      // Préparer la requête d'insertion avec un paramètre supplémentaire pour l'identifiant du propriétaire
      $insertion = "INSERT INTO CHANTIER(ID_CHANTIER, ADRESSE_CHANTIER, CHANTIER_START_DATE, CHANTIER_END_DATE, CHANTIER_START_REEL_DATE, CHANTIER_END_REEL_DATE, CHANTIER_TYPE, CHANTIER_SOUS_TYPE, DOCUMENT_ECHAFFAUDAGE, DOCUMENT_CHANTIER, ID_PROPRIETAIRE) VALUES(:id_chantier, :adresse_chantier, :chantier_start_date, :chantier_end_date, :chantier_start_reel_date, :chantier_end_reel_date, :chantier_type, :chantier_sous_type, :document_echafaudage, :document_chantier, :id_proprietaire)";

      // Préparer l'objet PDOStatement
      $execute = $pdo->prepare($insertion);

      // Lier les paramètres aux valeurs de $_POST et $_SESSION en utilisant filter_input() et filter_var()
      $execute->bindParam(":id_chantier", $id);
      $execute->bindParam(":adresse_chantier", filter_input(INPUT_POST, "adresse_chantier", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_start_date", filter_input(INPUT_POST, "chantier_start_date", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_end_date", filter_input(INPUT_POST, "chantier_end_date", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_start_reel_date", filter_input(INPUT_POST, "chantier_start_reel_date", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_end_reel_date", filter_input(INPUT_POST, "chantier_end_reel_date", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_type", filter_input(INPUT_POST, "chantier_type", FILTER_SANITIZE_STRING));
      $execute->bindParam(":chantier_sous_type", filter_input(INPUT_POST, "chantier_sous_type", FILTER_SANITIZE_STRING));
      $execute->bindParam(":document_echafaudage", filter_input(INPUT_POST, "document_echafaudage", FILTER_SANITIZE_STRING));
      $execute->bindParam(":document_chantier", filter_input(INPUT_POST, "document_chantier", FILTER_SANITIZE_STRING));
      $execute->bindParam(":id_proprietaire", filter_var($_SESSION["ID_PROPRIETAIRE"], FILTER_VALIDATE_INT));

      // Exécuter la requête
      $execute->execute();


    // Rediriger vers la page mesChantiers.php
    header("Location: mesChantiers.php");
    exit();
  } catch(PDOException $e) {
    // Afficher le message d'erreur en cas d'exception
    echo "Connection failed: " . $e->getMessage();
  }
} else {
  // Rediriger vers la page cree_err_mdps.php en cas de données manquantes
  header("Location: cree_err_mdps.php?reg_err=password");
  die();
}
?>
