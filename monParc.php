<?php
  // Initialiser la session
  session_start();

  try {
    // Connect to the database with mysqli
    $host = "localhost";
    $socket = "/srv/run/mysqld/mysqld.sock";
    $user = "root";
    $password = "";
    $database = "PILION";
    $db = new mysqli($host, $user, $password, $database, null, $socket);

    // Check for any connection errors
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    // Prepare the SQL query with a parameter
    //$sql = "SELECT * FROM MODULE WHERE ID_PROPRIETAIRE=? ORDER BY ID_MODULE ASC";
      $sql = "SELECT * FROM MODULE";
    $stmt = $db->prepare($sql);

    // Check for any errors
    if ($stmt === false) {
      die("Error: " . $db->error);
    }

    // Bind the parameter with the user's ID_PROPRIETAIRE
  //  $stmt->bind_param("s", $_SESSION['ID_PROPRIETAIRE']);

    // Execute the query
    $stmt->execute();

    // Get the result
    $result = $stmt->get_result();

    // Check for any errors
    if ($result === false) {
      die("Error: " . $stmt->error);
    }

    // Fetch the data as objects
    $modules = $result->fetch_all(MYSQLI_ASSOC);

    // Free the result and close the statement
    $result->free();
    $stmt->close();
  } catch (Exception $e) {
    // Handle any exceptions
    die("Error: " . $e->getMessage());
  }
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
              <td><img style="width: 50px; height: 50px;" src="srcImage/monParc.png" alt="Ma image"></td>
              <td style="font-size: 50px; padding-left: 40px;">Mon parc</td>
            </tr>
          </table>
        </div>

        <div class="bloc">Liste des modules </div>


        <?php foreach ($modules as $MODULE) : ?>


          <table>
            <tr style="text-align: center;">

              <td>
                <div class="options" onclick="toggleDropdown(this)">
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dot"></div>
                  <div class="dropdown">
                    <ul>
                      <li onclick="modifyModule(<?= $MODULE['ID_MODULE'] ?>)">Modifier</li>
                      <li onclick="duplicateModule(<?= $MODULE['ID_MODULE'] ?>)">Dupliquer</li>
                      <li onclick="deleteModule(<?= $MODULE['ID_MODULE'] ?>)">Supprimer</li>
                    </ul>
                  </div>
               </div>
            </td>
            <td style="align-items: center;">
               <div class="bloc2" onclick="openModal('<?= $MODULE['ID_MODULE'] ?>','<?= $MODULE['TYPE_MODULE'] ?>','<?= $MODULE['REF_CATALOGUE_FABRICANT'] ?>','<?= $MODULE['INFO_MODULE'] ?>','<?= $MODULE['STATUT_MODULE'] ?>')">
            <?= $MODULE['ID_MODULE'] ?>

          </div>

            </td>
            
            </tr>
            </table>

        <?php endforeach; ?>

        <a style="text-decoration: none;" href="nouveauModule.php">
          <div class="bloc2" style="margin-left: 430px; margin-right: 430px;">
            <table>
              <tr>
                <td><img style="width: 30px; height: 30px;" src="srcImage/ajout.png" alt="Ma image"></td>
                <td style="font-size: 30px; padding-left: 50px; ">Nouveau Module</td>
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
                <a href="mesChantiers.php">
                  <img style="width: 70px; height: 70px;" src="srcImage/crochet.png" alt="Ma image">
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
          function openModal(ID_MODULE, TYPE_MODULE, REF_CATALOGUE_FABRICANT, INFO_MODULE, STATUT_MODULE) {
            var modal = document.getElementById("myModal");
            var modalTitle = document.getElementById("modal-title");
            var modalBody = document.getElementById("modal-body");

            modal.style.display = "block";
            modalTitle.textContent = "Informations module";
            modalBody.innerHTML = "Id Module : " + ID_MODULE + "<br>" +"Type de Module : " + TYPE_MODULE + "<br>" +
            "Référence catalogue fabricant : " + REF_CATALOGUE_FABRICANT+ "<br>" +"Infos du module : " + INFO_MODULE + "<br>" +"Statut actuel : " + STATUT_MODULE+ "<br>";
          }

          function toggleDropdown(options) {
            var dropdown = options.querySelector('.dropdown');
            dropdown.style.display = (dropdown.style.display === 'none') ? 'block' : 'none';
          }

          function closeModal() {
            var modal = document.getElementById('myModal');
            modal.style.display = 'none';
          }

          function modifyModule(id) {
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'modifierModule.php?id=' + id;
          }

          function duplicateModule(id) {
            
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'duplicateModule.php?id=' + id;
          }

          function deleteModule(id){
            // Redirection vers la page de modification avec l'ID du chantier
            window.location.href = 'deleteModule.php?id=' + id;
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
