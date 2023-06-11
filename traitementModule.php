<?php
session_start();

// Boucle conditions de connexion
if ($_POST["type module"] != "" && $_POST["REF_CATALOGUE_FABRICANT"] != "" && $_POST["info module"] != ""
    && $_POST["STATUT ACTUEL"] != "" && $_POST["PROPRIETAIRE MODULE"] != "") {

  try {
    $pdo = new PDO(
      'mysql:host=localhost;dbname=PILION',
      'root',
      ''
    );
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //$cle=rand(1000000,9000000);
    $id = rand(1000000,9000000) + 450;

    $insertion = "INSERT INTO MODULE(ID_MODULE, TYPE_MODULE, REF_CATALOGUE_FABRICANT, INFO_MODULE, STATUT_ACTUEL, PROPRIETAIRE_MODULE)
        VALUES('$id', '" . $_POST["type module"] . "', '" . $_POST["REF_CATALOGUE_FABRICANT"] . "', '" . $_POST["info module"] . "',
         '" . $_POST["STATUT ACTUEL"] . "', '" . $_POST["PROPRIETAIRE MODULE"] . "',)";

    $execute = $pdo->prepare($insertion);
    $execute->execute();
    header('Location: monParc.php');
    exit();
  } catch(PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
  }
} else {
  header('Location: cree_err_mdps.php?reg_err=password');
  die();
}
?>
