<?php
// Check if the user is logged in
if (isset($_SESSION["ID_PROPRIETAIRE"]) && $_SESSION["ID_PROPRIETAIRE"] == $user_id) {
    // The user is logged in and has the correct ID
    header("Location: index.php");
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

    <div class="bloc">Connexion</div>


        <div class="container">

            <form action="dologin.php" method="post">
                <div class="inputBox">
                    <span class="fas fa-user"></span>
                    <input type="text" id="login" name="login" placeholder="login">
                </div>

                <div>
                <input style="background: lawngreen; font-weight: bold;"    type="submit" name="submit" value="Se connecter" class="btn">
                </div><br/> <br/><br/> <br/><br/> <br/><br/> <br/><br/> <br/>
            </form>

             <a href=sommaire.php><h1>SCAN</h1></a>

        </div><br>

    </section>
    </div><br>

   </body>
</html>
