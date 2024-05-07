<?php
include "db_connexion.php";
//if (!isset ($_GET['message'])) $_POST['id_c']="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['nomAjout']) && isset($_POST['prenomAjout']) && isset($_POST['mailAjout']) &&
        isset($_POST['telephoneAjout']) && isset($_POST['adresseAjout']) && isset($_POST['typeAjout']) &&
        isset($_POST['mot_de_passe'])
    ) {
        $nom = $_POST['nomAjout'];
        $prenom = $_POST['prenomAjout'];
        $email = $_POST['mailAjout'];
        $telephone = $_POST['telephoneAjout'];
        $adresse = $_POST['adresseAjout'];
        $type = $_POST['typeAjout'];
        $mot_de_passe = $_POST['mot_de_passe'];

        $sql = "INSERT INTO client (nom, prenom, `e-mail`, telephone, adress, type_client, mot_de_passe)
                VALUES ('$nom', '$prenom', '$email', '$telephone', '$adresse', '$type', '$mot_de_passe')";

        if ($conn->query($sql) === TRUE) {
            header("Location: liste_client.php"); 
            exit(); 
        } else {
            echo "Erreur lors de l'ajout du client : " . $conn->error;
        }
    } 
}


$sql = "SELECT DISTINCT c.* FROM client AS c
        LEFT JOIN demande AS d ON c.id_client = d.id_client
        WHERE c.etatc = 'client' OR d.etat = 'client'";

$result = $conn->query($sql);

$clients = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
}
$conn->close();
?>

<main class="content">
<div class="pagetitle">
        <h1>Liste client</h1>
    </div>
  <div class="container-fluid p-0">
    <table class="table table-striped" border="3">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Prénom</th>
          <th scope="col">Mail</th>
          <th scope="col">Téléphone</th>
          <th scope="col">Adresse</th>
          <th scope="col">Type</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php foreach ($clients as $client) { ?>
  <tr>
    <th scope="row"><?php echo $client['id_client']; ?></th>
    <td><?php echo $client['nom']; ?></td>
    <td><?php echo $client['prenom']; ?></td>
    <td><?php echo $client['e-mail']; ?></td>
    <td><?php echo $client['telephone']; ?></td>
    <td><?php echo $client['adress']; ?></td>
    <td><?php echo $client['type_client']; ?></td>
    <td>
      <button class="icon-button" onclick="afficherFormulaireModification(<?php echo isset($client['id_client']) ? $client['id_client'] : '0'; ?>)">
        <form method="POST" id="modifierinfoclient<?php echo $client['id_client']; ?>" name="modifapprenant<?php echo $client['id_client']; ?>" action="liste_client.php">
          <input type="hidden" name="nom" value='<?php echo $client['nom']; ?>' />
          <input type="hidden" name="prenom" value='<?php echo $client['prenom']; ?>' />
          <input type="hidden" name="mail" value='<?php echo $client['e-mail']; ?>' />
          <input type="hidden" name="telephone" value='<?php echo $client['telephone']; ?>' />
          <input type="hidden" name="adresse" value='<?php echo $client['adress']; ?>' />
          <input type="hidden" name="type_client" value='<?php echo $client['type_client']; ?>' />
          <input type="hidden" name="id_c" value='<?php echo $client['id_client']; ?>' />
        </form>
        <img src="img/icons/modifier.png" alt="Modifier" width="15px" height="15px" />
      </button>
	  
            <button class="icon-button" onclick="afficherConfirmationSuppression(<?php echo $client['id_client']; ?>)">
              <img src="img/icons/supprimer.png" alt="Supprimer" width="15px" height="15px" />
            </button>
			<form method="post" id="suppressioncli<?php echo $client['id_client']; ?>" action="supprimer_client.php?client=<?php echo $client['id_client']; ?>">
  <input type="hidden" id="id_cl" name="id_cl" value="<?php echo $client['id_client']; ?>" />
</form>

       
    </td>
	
  </tr>
  <!-- confirmation de supprission-->
	<div id="popupContainersup<?php echo $client['id_client']; ?>" style= " z-index:1;display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
    <div id="confirmationSuppression<?php echo $client['id_client']; ?>" style="display: none;">
  <h3>Confirmation de suppression</h3>
  <p>Êtes-vous sûr de vouloir supprimer ce Client ?</p>
  <button class="btn btn-danger" onclick="supprimerAction(<?php echo $client['id_client']; ?>)">Confirmer</button> 
  <button class="btn btn-secondary" onclick="annulerSuppression(<?php echo $client['id_client']; ?>)">Annuler</button> 
  
  </div>
  </div>
<?php } ?>



      </tbody>
    </table>
  </div>

<?php if(isset($_POST['id_c']) && $_POST['id_c']){ ?>
  <div id="popupContainer" style=" z-index:1;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
    <div id="formulaireModifier" >
  <h3>Vos données à Modifier</h3>
  <form method="POST" action="modifier_client.php">
    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo$_POST['id_c']?>">
    <div class="mb-3">
      <label for="nom" class="form-label">Nom </label>
      <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_POST['nom']?>">
    </div>
    <div class="mb-3">
      <label for="prenom" class="form-label">Prénom</label>
      <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $_POST['prenom']?>">
    </div>
    <div class="mb-3">
      <label for="mail" class="form-label">Mail</label>
      <input type="email" class="form-control" id="mail" name="mail" value="<?php echo $_POST['mail']?>">
    </div>
    <div class="mb-3">
      <label for="telephone" class="form-label">Téléphone</label>
      <input type="tel" class="form-control" id="telephone" name="telephone" value="<?php echo $_POST['telephone']?>">
    </div>
    <div class="mb-3">
      <label for="adresse" class="form-label">Adresse</label>
      <input type="text" class="form-control" id="adresse" name="adresse" value="<?php echo $_POST['adresse']?>">
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-select" id="type" name="type_client">
        <option value="individu" <?php if($_POST['type_client']=='Individu')echo"selected"?>>Individu</option>
        <option value="ste" <?php if($_POST['type_client']=='ste')echo"selected"?>>Société</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
    <button type="button" class="btn btn-secondary" onclick="annulerModification()">Annuler</button>
  </form>
</div>


  </div>
<?php }?>
<!-- confirmation d'ajout -->
	  <div id="popupContaineraj" style="z-index:1; display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
      <div id="formulaireAjout" style="display: none;" class="row" style="border:1px solid">
      <h3>Ajouter un nouveau Client</h3>
      <form method="POST" action="ajout_client.php">
	  <div class="row">
        <div class="col-md-6">
          <label for="nomAjout" class="form-label">Nom</label>
          <input type="text" class="form-control" id="nomAjout" name="nomAjout" placeholder="Votre nom">
        </div>
        <div class="col-md-6">
          <label for="prenomAjout" class="form-label">Prénom</label>
          <input type="text" class="form-control" id="prenomAjout" name="prenomAjout" placeholder="Votre prénom">
        </div>
		</div>
		<div class="row">
        <div class="col-md-6">
          <label for="mailAjout" class="form-label">Mail</label>
          <input type="email" class="form-control" id="mailAjout" name="mailAjout" placeholder="Votre adresse e-mail">
        </div>
		<div class="col-md-6">
          <label for="adresseAjout" class="form-label">Adresse</label>
          <input type="text" class="form-control" id="adresseAjout" name="adresseAjout" placeholder="Votre adresse">
        </div>
		</div>
		<div class="row">
        <div class="col-md-6">
          <label for="telephoneAjout" class="form-label">Téléphone</label>
          <input type="tel" class="form-control" id="telephoneAjout" name="telephoneAjout" placeholder="Votre numéro de téléphone">
        </div>
        
        <div class="col-md-6">
          <label for="typeAjout" class="form-label">Type</label>
          <select class="form-select" name="typeAjout" id="typeAjout">
            <option value="individu">Individu</option>
            <option value="ste">Société</option>
          </select>
        </div>
		</div>
		<div class="row">
		<div class="col-md-6">
          <label for="typeAjout" class="form-label">Etat</label>
          <select class="form-select" name="etat" id="etat">
            <option value="client">client</option>
            <option value="devis">devis</option>
          </select>
        </div>
        <div class="col-md-6">
          <label for="mot_de_passe" class="form-label">Mot de passe</label>
          <input type="password" class="form-control" id="mot_de_passe" name="mot_de_passe" placeholder="Votre mot de passe">
        </div>
		</div>
		<div class="row">
		<div class="col-md-6" style="margin-left:55%;margin-top:20px">
        <button type="submit" class="btn btn-primary">Ajouter</button>
		
        <button type="button" class="btn btn-secondary" onclick="annulerAjout()">Annuler</button>
		</div>
		</div>
      </form>
    </div>
	</div>
	
  <button class="icon-button" onclick="afficherFormulaire('formulaireAjout')">
    <img src="img/icons/aj.png" alt="Ajouter" /> Ajouter
  </button>
  <div class="col-12 col-md-10 col-xxl-8 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Nos type de client</h5>
								</div>
								<?php   
			 include 'stat_client.php';
			 ?>
							</div>
						</div>
</main>

<script>
  function afficherFormulaire(formulaireId) {
    var popupContainer = document.getElementById("popupContaineraj");
    var formulaire = document.getElementById(formulaireId);
    formulaire.style.display = "block";
    popupContainer.style.display = "block";
  }

  function afficherConfirmationSuppression(client) {
    var popupContainer = document.getElementById("popupContainersup"+client);
    var confirmation = document.getElementById("confirmationSuppression"+client); 
    confirmation.style.display = "block";
    popupContainer.style.display = "block";
  }

  function supprimerAction(client) { 
    // Action à effectuer lors de la confirmation de la suppression
    console.log("Suppression confirmée");
    var confirmation = document.getElementById("confirmationSuppression"+client);
	document.getElementById("suppressioncli"+client).submit();
    var popupContainer = document.getElementById("popupContainersup"+client);
    confirmation.style.display = "none";
    popupContainer.style.display = "none";
  }

  function annulerSuppression() {
    var confirmation = document.getElementById("confirmationSuppression");
    var popupContainer = document.getElementById("popupContainersup");
    confirmation.style.display = "none";
    popupContainer.style.display = "none";
  }

  function annulerModification() {
    var formulaire = document.getElementById("formulaireModifier");
    var popupContainer = document.getElementById("popupContainer");
    formulaire.style.display = "none";
    popupContainer.style.display = "none";
  }

  function annulerAjout() {
    var formulaire = document.getElementById("formulaireAjout");
    var popupContainer = document.getElementById("popupContaineraj");
    formulaire.style.display = "none";
    popupContainer.style.display = "none";
  }

  function ajouterAction() {
    afficherFormulaire('formulaireAjout');
  }
   function afficherFormulaireModification(clientId) {
  console.log(" ll");
  document.getElementById("modifierinfoclient"+clientId).submit();
 /* var popupContainer = document.getElementById("popupContainer");
  var formulaire = document.getElementById("formulaireModifier");
  formulaire.style.display = "block";
  popupContainer.style.display = "block";*/

  // Pré-remplir le formulaire avec les données du client
  var id_client = document.getElementById("id_client");
  var nom = document.getElementById("nom");
  var prenom = document.getElementById("prenom");
  var mail = document.getElementById("mail");
  var telephone = document.getElementById("telephone");
  var adresse = document.getElementById("adresse");
  var type = document.getElementById("type");

  // Récupérer les données du client à partir du tableau clients
  var client = clients.find(function(c) {
    return c.id_client == clientId;
  });

  // Vérifier si le client a été trouvé
  if (client) {
    // Pré-remplir les champs du formulaire avec les données du client
    id_client.value = client.id_client;
    nom.value = client.nom;
    prenom.value = client.prenom;
    mail.value = client["e-mail"];
    telephone.value = client.telephone;
    adresse.value = client.adress;
    type.value = client.type_client;
  }
}

</script>
