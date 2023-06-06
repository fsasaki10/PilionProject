<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>PILION</title>

  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places"></script>
  <script>
    // Fonction d'initialisation de l'API
    function initAutocomplete() {
      var input = document.getElementById("place-input");
      var autocomplete = new google.maps.places.Autocomplete(input);
      autocomplete.addListener('place_changed', function() {
        var place = autocomplete.getPlace();
        if (place.geometry) {
          console.log("Lieu sélectionné :", place.name);
        }
      });
    }
  </script>

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
            <td style="font-size: 50px; padding-left: 40px;">Nouveau chantier</td>
          </tr>
        </table>
      </div>

      <div style="text-align: center;">Créer un nouveau chantier</div>


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

        <form action="traitement.php" method="POST">


      <label for="adresse_chantier">Adresse Chantier :</label>
      <input type="text" id="adresse_chantier" name="adresse_chantier" placeholder="Entrez un lieu" onload="initAutocomplete()" required><br><br>


      <label for="chantier_start_date">Date de début prévue :</label>
      <input type="date" id="chantier_start_date" name="chantier_start_date" required><br><br>


      <label for="chantier_end_date">Date de fin prévue :</label>
      <input type="date" id="chantier_end_date" name="chantier_end_date" required><br><br>


      <label for="chantier_start_reel_date">Date de début réelle :</label>
      <input type="date" id="chantier_start_reel_date" name="chantier_start_reel_date"><br><br>


      <label for="chantier_end_reel_date">Date de fin réelle :</label>
      <input type="date" id="chantier_end_reel_date" name="chantier_end_reel_date"><br><br>


      <label for="chantier_type">Type de chantier :</label>
      <input type="text" id="chantier_type" name="chantier_type" required><br><br>


      <label for="chantier_sous_type">Sous-type de chantier :</label>
      <input type="text" id="chantier_sous_type" name="chantier_sous_type" required><br><br>


       <label for="document_echafaudage">Document d'échafaudage :</label>
      <input type="text" id="document_echafaudage" name="document_echafaudage" required><br><br>


      <label for="document_chantier">Document de chantier :</label>
      <input type="text" id="document_chantier" name="document_chantier" required><br><br>


      <!-- pour ajouter fichier à la base

      <label for="document_echafaudage">Document d'échafaudage :</label>
      <input type="file" id="document_echafaudage" name="document_echafaudage" required><br>

      <label for="document_chantier">Document de chantier :</label>
      <input type="file" id="document_chantier" name="document_chantier" required><br>
    -->

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
