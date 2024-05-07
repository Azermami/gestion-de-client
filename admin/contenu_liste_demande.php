<?php
include "db_connexion.php";

$query = "SELECT c.nom, c.prenom,c.etatc, c.`e-mail`, p.libelle, d.date_creation, d.id_client, d.id_demande,d.prix,d.etat
          FROM demande d
          INNER JOIN client c ON d.id_client = c.id_client
          INNER JOIN projet p ON d.id_projet = p.id_projet
          ";
$result = $conn->query($query);
?>

<main class="content">
<div class="pagetitle">
        <h1>Liste des demandes</h1>
    </div>
  <div class="container-fluid p-0">
    <table class="table table-striped" border="3" align="center">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">E-mail</th>
          <th scope="col">Libellé projet</th>
          <th scope="col">Date Demande</th>
          <th scope="col">Etat</th>
        </tr>
      </thead>

      <tbody>
        <?php
        if ($result->num_rows > 0) {
          $counter = 1;
          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $counter . "</td>";
            echo "<td>" . $row["nom"] . "</td>";
            echo "<td>" . $row["e-mail"] . "</td>";
            echo "<td>" . $row["libelle"] . "</td>";
            echo "<td>" . $row["date_creation"] . "</td>";
            echo '<td align="center">'. $row["etat"] .'</td>';
            echo "</tr>";
            $counter++;
          }
        } else {
          echo "<tr><td colspan='6'>Aucune donnée trouvée.</td></tr>";
        }
        ?>
      </tbody>
    </table>
    
    <?php if (isset($_POST['id_demande']) && $_POST['id_demande']) { 
      $id_demande = $_POST['id_demande'];
	  $etatc= $_POST['etatc'];
      ?>
      <div id="popupContaineraj" style="z-index:1;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <div id="formulaireAjout">
          <h3>Confirmer la demande</h3>
          <form method="POST" action="confirmation_demande.php" enctype="multipart/form-data">
            <div class="mb-3">
              <label for="descriptif" class="form-label">Descriptif</label>
              <input type="file" class="form-control" id="descriptif" name="descriptif" accept="application/pdf">
            </div>
            <div class="mb-3">
              <label for="cahierCharge" class="form-label">Cahier de charge (PDF)</label>
              <input type="file" class="form-control" id="cahierCharge" name="cahier" accept="application/pdf">
            </div>
			<div class="mb-3">
              <label for="prix" class="form-label">Proposition de prix</label>
              <input type="number" class="form-control" id="prix" name="prix">
            </div>
            <div class="mb-3">
              <input type="hidden" class="form-control" id="id_demande" name="id_demande" placeholder="Votre demande" value="<?php echo $id_demande; ?>">
            </div><?php if ($etatc !='client'){?>
            <div class="row mb-3">
              <label for="inputPasswordm" class="form-label" id="password-input">Mot de passe</label>
              <div class="row mb-3">
                  <label for="inputPasswordm" class="col-sm-2 col-form-label" id="password-input">Mot de Passe</label>
                  <div class="col-sm-10 " >
                    <input type="password" class="form-control" name="password">
                    <br>
                    <button type="button" class="btn btn-primary " id="generate-button" >Generate</button>

                      <input class="form-check-input" type="checkbox" id="show-password-checkbox">
                      <label class="form-check-label" for="show-password-checkbox">
                        Show
                      </label>

                  </div>
                </div>
            </div>
			<?php } ?>
            <button type="submit" class="btn btn-primary">Envoyer</button>
            <button type="button" class="btn btn-secondary" onclick="annulerAjout()">Annuler</button>
          </form>
        </div>
      </div>
    <?php } ?>
  </div>
<div class="col-12 col-md-12 col-xxl-9 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Les demandes selon le libelle de projet </h5>
								</div>
								<?php   
			 include 'stat_demande_enligne.php';
			 ?>
							</div>
						</div>
  <script>
    function afficherFormulaire(id_demande,etatc) {
      var form = document.createElement("form");
      form.setAttribute("method", "POST");
      form.setAttribute("action", "suivie_demande.php");
      form.style.display = "none";

      var inputIdDemande = document.createElement("input");
      inputIdDemande.setAttribute("type", "text");
      inputIdDemande.setAttribute("name", "id_demande");
      inputIdDemande.setAttribute("value", id_demande);

var inputEtat = document.createElement("input");
      inputEtat.setAttribute("type", "text");
      inputEtat.setAttribute("name", "etatc");
      inputEtat.setAttribute("value", etatc);

      form.appendChild(inputIdDemande);
	  
	  form.appendChild(inputEtat);
      document.body.appendChild(form);

      form.submit();
    }

    function annulerAjout() {
      var formulaire = document.getElementById("formulaireAjout");
      var popupContainer = document.getElementById("popupContaineraj");
      formulaire.style.display = "none";
      popupContainer.style.display = "none";
    }

    
	const passwordInput = document.querySelector('input[type="password"]');

// Add a click event listener to the "Generate" button
document.querySelector('#generate-button').addEventListener('click', () => {
  // Generate a random string
  const randomString = Math.random().toString(36).slice(-8);

  // Set the generated string as the value of the password input field
  passwordInput.value = randomString;
});
const showPasswordCheckbox = document.getElementById("show-password-checkbox");

showPasswordCheckbox.addEventListener("change", function() {
  if (showPasswordCheckbox.checked) {
    passwordInput.type = "text";
  } else {
    passwordInput.type = "password";
  }
});
  </script>
</main>
