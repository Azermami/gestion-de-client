<?php
include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['libelle'])) {
        $libelle = $_POST['libelle'];

        $sql = "INSERT INTO projet (libelle)
                VALUES ('$libelle')";

        if ($conn->query($sql) === TRUE) {
            header("Location:liste_projet.php");
            exit();
        } else {
            echo "Erreur lors de l'ajout du projet : " . $conn->error;
        }
    }
}

$sql = "SELECT * FROM projet";
$result = $conn->query($sql);
$projets = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projets[] = $row;
    }
}
$conn->close();
?>
<main class="content">
<div class="pagetitle">
        <h1>Liste des Projet</h1>
    </div>
    <div class="container-fluid p-0">
        <table class="table table-striped" border="3">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nom Projet</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projets as $projet) { ?>
                    <tr>
                        <th scope="row"><?php echo $projet['id_projet']; ?></th>
                        <td><?php echo $projet['libelle']; ?></td>

                        <td>
                            <button class="icon-button" onclick="afficherFormulaireModification(<?php echo isset($projet['id_projet']) ? $projet['id_projet'] : '0'; ?>)">
							<form method="POST" id="modifierinfoprojet<?php echo $projet['id_projet']; ?>" name="modifapprenant<?php echo $projet['id_projet']; ?>" action="liste_projet.php">
                            <input type="hidden" name="nom" value='<?php echo $projet['libelle']; ?>' />
							<input type="hidden" name="id_p" value='<?php echo $projet['id_projet']; ?>' />
							</form>
                                <img src="img/icons/modifier.png" alt="Modifier" width="15px" height="15px" />
                            </button>

                            <button class="icon-button" onclick="afficherConfirmationSuppression(<?php echo $projet['id_projet']; ?>)">
                                <img src="img/icons/supprimer.png" alt="Supprimer" width="15px" height="15px" />
                            </button>
                            <form method="post" id="suppressioncli<?php echo $projet['id_projet']; ?>" action="supprimer_projet.php?projet=<?php echo $projet['id_projet']; ?>">
                                <input type="hidden" id="id_cl" name="id_cl" value="<?php echo $projet['id_projet']; ?>" />
                            </form>
                        </td>
                    </tr>
                    <!-- confirmation de supprission-->
                    <div id="popupContainersup<?php echo $projet['id_projet']; ?>" style=" display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
                        <div id="confirmationSuppression<?php echo $projet['id_projet']; ?>" style="display: none;">
                            <h3>Confirmation de suppression</h3>
                            <p>Êtes-vous sûr de vouloir supprimer ce projet ?</p>
                            <button class="btn btn-danger" onclick="supprimerAction(<?php echo $projet['id_projet']; ?>)">Confirmer</button>
                            <button class="btn btn-secondary" onclick="annulerSuppression(<?php echo $projet['id_projet']; ?>)">Annuler</button>
                        </div>
                    </div>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php if (isset($_POST['id_p']) && $_POST['id_p']) { ?>
        <div id="popupContainer" style=" position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
            <div id="formulaireModifier">
                <h3>Vos données à Modifier</h3>
                <form method="POST" action="modifier_projet.php">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_POST['id_p'] ?>">
                    <div class="mb-3">
                        <label for="nom" class="form-label">Nom Projet</label>
                        <input type="text" class="form-control" id="nom" name="libelle" value="<?php echo $_POST['nom'] ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                    <button type="button" class="btn btn-secondary" onclick="annulerModification()">Annuler</button>
                </form>
                </div>
                </div>
    <?php } ?>
    <!-- confirmation d'ajout -->
    <div id="popupContaineraj" style="display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <div id="formulaireAjout" style="display: none;">
            <h3>Ajouter un nouvel Projet</h3>
            <form method="POST" action="contenu_liste_projet.php">
                <div class="mb-3">
                    <label for="nomAjout" class="form-label">Nom Projet</label>
                    <input type="text" class="form-control" id="nomAjout" name="libelle" placeholder="Votre nom">
                </div>

                <button type="submit" class="btn btn-primary">Ajouter</button>
                <button type="button" class="btn btn-secondary" onclick="annulerAjout()">Annuler</button>
            </form>
        </div>
    </div>

    <button class="icon-button" onclick="afficherFormulaire('formulaireAjout')">
        <img src="img/icons/aj.png" alt="Ajouter" /> Ajouter
    </button>
</main>

<script>
    function afficherFormulaire(formulaireId) {
        var popupContainer = document.getElementById("popupContaineraj");
        var formulaire = document.getElementById(formulaireId);
        formulaire.style.display = "block";
        popupContainer.style.display = "block";
    }

    function afficherConfirmationSuppression(projet) {
        var popupContainer = document.getElementById("popupContainersup" + projet);
        var confirmation = document.getElementById("confirmationSuppression" + projet);
        confirmation.style.display = "block";
        popupContainer.style.display = "block";
    }

    function supprimerAction(projet) {
        // Action à effectuer lors de la confirmation de la suppression
        console.log("Suppression confirmée");
        var confirmation = document.getElementById("confirmationSuppression" + projet);
        document.getElementById("suppressioncli" + projet).submit();
        var popupContainer = document.getElementById("popupContainersup" + projet);
        confirmation.style.display = "none";
        popupContainer.style.display = "none";
    }

    function annulerSuppression(projet) {
        var confirmation = document.getElementById("confirmationSuppression" + projet);
        var popupContainer = document.getElementById("popupContainersup" + projet);
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
function afficherFormulaireModification(projetId) {
  console.log(" ll");
  document.getElementById("modifierinfoprojet"+projetId).submit();
 /* var popupContainer = document.getElementById("popupContainer");
  var formulaire = document.getElementById("formulaireModifier");
  formulaire.style.display = "block";
  popupContainer.style.display = "block";*/

  // Pré-remplir le formulaire avec les données du client
  var id_projet = document.getElementById("id_projet");
  var libelle = document.getElementById("libelle");
  

  // Récupérer les données du client à partir du tableau clients
  var projet = clients.find(function(p) {
    return p.id_projet == projetId;
  });

  // Vérifier si le client a été trouvé
  if (projet) {
    // Pré-remplir les champs du formulaire avec les données du client
    id_projet.value = projet.id_projet;
    projet.value = projet.libelle;
    
  }
}
    
    
</script>
