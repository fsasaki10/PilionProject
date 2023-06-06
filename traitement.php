<?php
session_start();

// Boucle conditions de connexion
if ($_POST["adresse_chantier"] != "" && $_POST["chantier_start_date"] != "" && $_POST["chantier_end_date"] != "" && $_POST["chantier_start_reel_date"] != "" && $_POST["chantier_end_reel_date"] != "" && $_POST["chantier_type"] != "" && $_POST["chantier_sous_type"] != "" && $_POST["document_echafaudage"] != "" && $_POST["document_chantier"] != "") {

  try {
    $pdo = new PDO(
      'mysql:host=localhost;dbname=PILION',
      'root',
      'root'
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$cle=rand(1000000,9000000);
    $id = rand(1000000,9000000) + 450;

    $insertion = "INSERT INTO CHANTIER(ID_CHANTIER, ADRESSE_CHANTIER, CHANTIER_START_DATE, CHANTIER_END_DATE, CHANTIER_START_REEL_DATE, CHANTIER_END_REEL_DATE, CHANTIER_TYPE, CHANTIER_SOUS_TYPE, DOCUMENT_ECHAFFAUDAGE, DOCUMENT_CHANTIER) VALUES('$id', '" . $_POST["adresse_chantier"] . "', '" . $_POST["chantier_start_date"] . "', '" . $_POST["chantier_end_date"] . "', '" . $_POST["chantier_start_reel_date"] . "', '" . $_POST["chantier_end_reel_date"] . "', '" . $_POST["chantier_type"] . "', '" . $_POST["chantier_sous_type"] . "', '" . $_POST["document_echafaudage"] . "', '" . $_POST["document_chantier"] . "')";

    $execute = $pdo->prepare($insertion);
    $execute->execute();
    header('Location: mesChantiers.php');
    exit();
  } catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }
} else {
  header('Location: cree_err_mdps.php?reg_err=password');
  die();
}
?>