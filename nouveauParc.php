<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>PILION</title>

  <link rel="stylesheet" type="text/css" href="css/mesChantiers.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

  <div class="container">
    <div class="content">
      <div style="display:flex; justify-content: center; align-items: center; margin-bottom: 50px;"> 
        <table>
          <tr>
            <td><img style="width: 50px; height: 50px;" src="srcImage/crochet.png" alt="Ma image"></td>
            <td style="font-size: 50px; padding-left: 40px;">Nouveau module</td>
          </tr>
        </table>
      </div>

      <div style="text-align: center;">Créer un nouveau module</div>


      <div class="bloc3">

        <div>
      <?php
      if (isset($msgError)) {
        echo $msgError;
      } elseif (isset($msgSuccess)) {
        echo $msgSucess;
      }
      ?>
    </div>

        <form action="traitementModule.php" method="POST">


      <label for="type_module">Type module :</label>
      <input type="text" id="type_module" name="type_module"  required><br><br>


      <label for="REF_CATALOGUE_FABRICANT">Reférence catalogue du fabricant :</label>
      <input type="text" id="REF_CATALOGUE_FABRICANT" name="REF_CATALOGUE_FABRICANT" required><br><br>


      <label for="info module">Information sur le module :</label>
      <input type="text" id="info module" name="info module" required><br><br>


      <label for="STATUT ACTUEL">Statut actuel du module :</label>
      <select name="statut du module" id="pos-select" required>
          <option value="entrepot">Dans l'entrepot</option>
          <option value="camion">Charg&eacute; sur le camion</option>
          <option value="chantier">Arriv&eacute; sur le chantier</option>
          <option value="levage">Pr&ecirc;t pour levage</option>
          <option value="maintenance">Maintenance</option>
          <option value="monte">Mont&eacute; et Fonctionel</option>
      </select><br><br>


      <label for="PROPRIETAIRE MODULE">Propriétaire du module :</label>
      <input type="text" id="PROPRIETAIRE MODULE" name="PROPRIETAIRE MODULE"><br><br>

      <input type="submit" style="font-size: 18px;" value="Envoyer">
    </form>


      </div>

    </div>

    <footer class="footer">
      <div style="display:flex; justify-content: center; align-items: center;"> 
        <table>
          <tr>
            <td style="padding-right: 100px;">
              <a href="../monParc/monParc.html">
                <img style="width: 70px; height: 70px;" src="srcImage/monParc.png" alt="Ma image">
              </a>
            </td>
            <td style="padding-left: 100px;">
              <a href="../statistiques/statistiques.html">
                <img style="width: 70px; height: 70px;" src="srcImage/statistiques.png" alt="Ma image">
              </a>
            </td>
          </tr>
        </table>
      </div>
    </footer>

  </div>

</body>


</html>
