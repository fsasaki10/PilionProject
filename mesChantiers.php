  <?php
  // Initialiser la session
  session_start();

  $objetpdo = new PDO(
    'mysql:host=localhost;dbname=PILION',
    'root',
    ''
  );

  $pdoStat = $objetpdo->prepare('SELECT * FROM CHANTIER ORDER BY adresse_chantier ASC');

  $executeIsOk = $pdoStat->execute();

  $chantiers = $pdoStat->fetchAll();
  ?>


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
        <a style="text-decoration: none;" href="index.php">
          <header>
            <h1 style="text-align: center; background-color: #18BF6D; font-size: 50px;padding: 20px; margin: 30px;color: #fff;border-radius: 10px;">Portail PILION</h1>
          </header>
        </a>

        <div style="display:flex; justify-content: center; align-items: center; margin-bottom: 50px;"> 
          <table>
            <tr>
              <td><img style="width: 50px; height: 50px;" src="srcImage/crochet.png" alt="Ma image"></td>
              <td style="font-size: 50px; padding-left: 40px;">Mes chantiers</td>
            </tr>
          </table>
        </div>

        <div class="bloc">Liste des chantiers</div>


        <?php foreach ($chantiers as $CHANTIER) : ?>


          <table>
            <tr style="text-align: center;">

              <td>
                <div class="options" onclick="toggleDropdown(this)">
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dropdown">
                    <ul>
                      <li onclick="modifyChantier(<?= $CHANTIER['ID_CHANTIER'] ?>)">Modifier</li>
                      <li onclick="duplicateChantier(<?= $CHANTIER['ID_CHANTIER'] ?>)">Dupliquer</li>
                      <li onclick="deleteChantier(<?= $CHANTIER['ID_CHANTIER'] ?>)">Supprimer</li>
                    </ul>
                  </div>
               </div>
            </td>
            <td style="align-items: center;">
               <div class="bloc2" onclick="openModal('<?= $CHANTIER['ADRESSE_CHANTIER'] ?>','<?= $CHANTIER['CHANTIER_START_DATE'] ?>','<?= $CHANTIER['CHANTIER_END_DATE'] ?>','<?= $CHANTIER['CHANTIER_START_REEL_DATE'] ?>','<?= $CHANTIER['CHANTIER_END_REEL_DATE'] ?>','<?= $CHANTIER['CHANTIER_TYPE'] ?>','<?= $CHANTIER['CHANTIER_SOUS_TYPE'] ?>','<?= $CHANTIER['DOCUMENT_ECHAFFAUDAGE'] ?>','<?= $CHANTIER['DOCUMENT_CHANTIER'] ?>')">
            <?= $CHANTIER['ADRESSE_CHANTIER'] ?>

          </div>

            </td>
            
            </tr>
            </table>

        <?php endforeach; ?>

        <a style="text-decoration: none;" href="nouveauChantier.php">
          <div class="bloc2" style="margin-left: 430px; margin-right: 430px;">
            <table>
              <tr>
                <td><img style="width: 30px; height: 30px;" src="srcImage/ajout.png" alt="Ma image"></td>
                <td style="font-size: 30px; padding-left: 50px; ">Nouveau Chantier</td>
              </tr>
            </table>
          </div>
        </a>

      </div>

      <footer class="footer">
        <div style="display:flex; justify-content: center; align-items: center;"> 
          <table>
            <tr>
              <td style="padding-right: 100px;">
                <a href="monParc.php">
                  <img style="width: 70px; height: 70px;" src="srcImage/monParc.png" alt="Ma image">
                </a>
              </td>
              <td style="padding-left: 100px;">
                <a href="statistiques.php">
                  <img style="width: 70px; height: 70px;" src="srcImage/statistiques.png" alt="Ma image">
                </a>
              </td>
            </tr>
          </table>
        </div>
      </footer>

    </div>

    <!-- Fenêtre modale -->
    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h2 id="modal-title"></h2>
        <div id="modal-body"></div>
      </div>
    </div>

    <script>
          // Fonction pour ouvrir la fenêtre modale
          function openModal(ADRESSE_CHANTIER, CHANTIER_START_DATE, CHANTIER_END_DATE, CHANTIER_START_REEL_DATE, CHANTIER_END_REEL_DATE, CHANTIER_TYPE, CHANTIER_SOUS_TYPE, DOCUMENT_ECHAFFAUDAGE, DOCUMENT_CHANTIER) {
            var modal = document.getElementById("myModal");
            var modalTitle = document.getElementById("modal-title");
            var modalBody = document.getElementById("modal-body");

            modal.style.display = "block";
            modalTitle.textContent = "Informations chantiers";
            modalBody.innerHTML = "Adresse : " + ADRESSE_CHANTIER + "<br>" +"Date de début : " + CHANTIER_START_DATE + "<br>" +
            "Date de fin : " + CHANTIER_END_DATE+ "<br>" +"Date réelle de début : " + CHANTIER_START_REEL_DATE + "<br>" +"Date réelle de fin : " + CHANTIER_END_REEL_DATE+ "<br>" + "Type : " + CHANTIER_TYPE+ "<br>" +"Sous-type : " + CHANTIER_SOUS_TYPE + "<br>" +"Document sur l'échafaudage: " + DOCUMENT_ECHAFFAUDAGE+ "<br>" +"Document du chantier: " + DOCUMENT_CHANTIER + "<br>";
          }

          function toggleDropdown(options) {
            var dropdown = options.querySelector('.dropdown');
            dropdown.style.display = (dropdown.style.display === 'none') ? 'block' : 'none';
          }

          function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
          }

          function modifyChantier(id) {
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'modifierChantier.php?id=' + id;
          }

          function duplicateChantier(id) {
            
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'duplicateChantier.php?id=' + id;
          }

          function deleteChantier(id){
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'deleteChantier.php?id=' + id;
          }

          var options = document.querySelectorAll('.options');
          options.forEach(function(option) {
            option.addEventListener('click', function(event) {
              event.stopPropagation();
              var isActive = this.classList.contains('active');
              options.forEach(function(opt) {
                opt.classList.remove('active');
                opt.querySelector('.dropdown').style.display = 'none';
              });

              if (!isActive) {
                this.classList.add('active');
                toggleDropdown(this);
              }
            });
          });

          document.addEventListener('click', function(event) {
            options.forEach(function(option) {
              if (!option.contains(event.target)) {
                option.classList.remove('active');
                option.querySelector('.dropdown').style.display = 'none';
              }
            });
          });
                  
        </script>

      </body>


      </html>
