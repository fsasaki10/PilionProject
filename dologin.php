<?php

//Activer le gestionnaire de session.
session_start();

    //Formulaire soumis
    if(!empty($_POST['login'])){

        //Obtenir la saisie de l'internaute et supprimer les espaces
        $login = trim($_POST['login']);

            //Le code SQL : vérification du login
            $sql = "SELECT * FROM utilisateur WHERE ID_PROPRIETAIRE=?;";

            //Lien de connexion (API MySQLi)
        $host = "localhost";
        $socket = "/srv/run/mysqld/mysqld.sock";
        $user = "root";
        $password = "";
        $database = "PILION";
            $db = new mysqli($host, $user, $password, $database, null, $socket);

            //Vérifier la connexion
            if ($db->connect_error) {
                die("Connection failed: " . $db->connect_error);
            }

                //Préparer la requête avec des paramètres
                $stmt = $db->prepare($sql);
                if ($stmt) {
                    //Lier le paramètre avec la valeur
                    $stmt->bind_param("s", $login);
                    //Exécuter la requête
                    $stmt->execute();
                    //Obtenir le résultat
                    $result = $stmt->get_result();
                    //Fermer le statement
                    $stmt->close();

                    //Test du nombre de lignes obtenu
                    if($result->num_rows == 1)
                    {
                        //Authentification OK, obtenir les infos
                        $data = $result->fetch_object();

                        //Variables de session
                        $_SESSION['ID_PROPRIETAIRE'] = $login;
                        $_SESSION['NOM_PROPRIETAIRE'] = $data->NOM_PROPRIETAIRE;
                        header('Location: index.php');
                        exit();

                    }else{
                        //Aucun utilisateur trouvé
                        $_SESSION['error'] = "Utilisateur introuvable.";
                        header('Location: connexion.php');
                        exit();
                    }
                } else {
                    //Erreur de préparation de la requête
                    die("Error: " . $db->error);
                }
    }else{
        //Si le formulaire est envoyé sans données
        $_SESSION['error'] = "Veuillez entrer votre login.";
        header('Location: connexion.php');
        exit();
    }

  //Fermer la connexion
  $db->close();
?>
