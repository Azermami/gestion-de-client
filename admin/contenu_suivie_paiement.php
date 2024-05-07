
<?php
include "db_connexion.php";

function obtenirDonneesPourTableau($idClient)
{
    global $conn;

    $donnees = array();

   $requete = "SELECT p.id_paiement,c.id_client, c.nom, c.prenom, pr.libelle AS nom_projet, d.prix AS prix_projet, p.tranche AS montant_tranche, p.date_paiement AS date_paiement, p.modaliter_paiement AS modaliter_paiement,d.etat
                FROM paiement p
                INNER JOIN demande d ON d.id_demande = p.id_demande
                INNER JOIN client c ON c.id_client = d.id_client
                INNER JOIN projet pr ON d.id_projet = pr.id_projet
                WHERE c.id_client = $idClient";

    $resultat = $conn->query($requete);

    if ($resultat && $resultat->num_rows > 0) {
        while ($row = $resultat->fetch_assoc()) {
            $donnees[] = $row;
        }
    }

    return $donnees;
}

if (isset($_POST['recherche'])) {
    $payers = obtenirDonneesPourTableau($_POST['paiement']);
}

function obtenirDonne($idClient)
{
    global $conn;

    $donnees = array();

    $rep = "SELECT p.id_projet, p.libelle
            FROM demande d
            INNER JOIN projet p ON d.id_projet = p.id_projet
            WHERE d.id_client = $idClient and  d.etat='client'";
    $req = $conn->query($rep);
    while ($row = mysqli_fetch_array($req)) {
        echo '<option value="' . $row['id_projet'] . '">' . $row['libelle'] . '</option>';
    }
    return $donnees;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Tableau de recherche</title>
</head>
<body>

    <main class="content">
	<div class="pagetitle">
        <h1>Suivie de paiement</h1>
    </div>
        <div class="container-fluid p-0">
           <form method="POST">
		   <div class="row" style="padding:10px 0px 10px 0px; margin-bottom:20px;">
    <div class="col-md-10">
      <select name="paiement" class="form-select">
        <option value=""> Choisir un Client</option>
        <?php
        $rep = "SELECT * FROM client
                JOIN demande ON client.id_client = demande.id_client
                WHERE demande.etat = 'client' GROUP BY demande.id_client";

        $req = $conn->query($rep);
        while ($row = mysqli_fetch_array($req)) {
            echo '<option value="'.$row['id_client'].'">'.$row['nom'].' '.$row['prenom'].'</option>';
        }
        ?>
    </select>
    </div>
    <div class="col-md-2">
       <button type="submit" name="recherche" value="recherche" class="btn btn-secondary"  id="rechercheBtn">Rechercher</button>
    </div>
    
  </div>
    
    
</form>



            <?php
            if (isset($payers) && !empty($payers)) {
                ?>
                <table class="table table-striped" border="3">
                    <thead>
                        <tr>
                            <th scope="col">Num paiement</th>
                            <th scope="col">#</th>
                            <th scope="col">Nom Client</th>
                            <th scope="col">Nom Projet</th>
                            <th scope="col">Modaliter Paiement</th>
                            <th scope="col">Prix Projet</th>
                            <th scope="col">Montant Tranche</th>
                            <th scope="col">Date Tranche</th>
                            <th scope="col">Modifier</th>
                            <th scope="col">Reçu</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($payers as $payer) {
                             $client = $payer['id_client'];
                            ?>
                            <tr>
                                <td><?php echo $payer['id_paiement']; ?></td>
                                <td><?php echo $payer['id_client']; ?></td>
                                <td><?php echo $payer['nom'] . ' ' . $payer['prenom']; ?></td>
                                <td><?php echo $payer['nom_projet']; ?></td>
                                <td><?php echo $payer['modaliter_paiement']; ?></td>
                                <td><?php echo $payer['prix_projet']; ?></td>
                                <td><?php echo $payer['montant_tranche']; ?></td>
                                <td><?php echo $payer['date_paiement']; ?></td>
                                <td>
                                    <form method="POST" id="formulaireModifierPaiement<?php echo $payer['id_paiement']; ?>" name="modifapprenant<?php echo $payer['id_paiement']; ?>" action="suivie_paiement.php">
                                        <input type="hidden" name="tranche" value="<?php echo $payer['montant_tranche']; ?>" />
                                        <input type="hidden" name="paiement" value="<?php echo $payer['id_client']; ?>" />
                                        <input type="hidden" name="id_pa" value="<?php echo $payer['id_paiement']; ?>" />
                                        <input type="hidden" name="recherche" value="rechercher" />
                                        <input type="hidden" name="affiche_modif" value="affiche_modif" />
                                        <button type="submit" name="modif" value="modifier"><img src="img/icons/modifier.png" alt="Modifier" width="15px" height="15px" /></button>
                                    </form>
                                </td>
                                <td>
                                    <button class="icon-button" onclick="afficherFormulaireRecu(<?php echo $payer['id_paiement']; ?>)">
                                        <img src="img/icons/recu.png" alt="recu" width="25px" height="25px" />
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php
            } 
            ?>
        </div>

        <div id="popupContaineraj" style="z-index:1;display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
            <div id="formulaireAjout" style="display: none;">
                <h3>Ajouter une nouvelle Tranche</h3>
                <form method="POST" action="ajout_tranche.php">
                    <div class="mb-3">
                        <label for="montantTranche" class="form-label">Montant Tranche</label>
                        <input type="text" class="form-control" id="montantTranche" name="tranche" placeholder="Votre tranche">
                    </div>
                    <div class="mb-3">
                        <label for="montantTranche" class="form-label">Nom de Projet</label>
                        <select name="projet">
                            <option value=""></option>
                            <?php
                            $idClient = $_POST['paiement'];
                            obtenirDonne($idClient);
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="montantTranche" class="form-label">Modaliter</label>
                        <select name="modaliter">
                            <option value="espèce">espèce</option>
                            <option value="cheque">cheque</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="idDemande" name="client" placeholder="Votre demande" value="<?php echo $idClient; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary">Ajouter</button>
                    <button type="button" class="btn btn-secondary" onclick="annulerAjout()">Annuler</button>
                </form>
            </div>
        </div>

        <?php if (isset($payers) && !empty($payers)) { ?>
    <?php foreach ($payers as $payer) { ?>
        <div id="popupContainerRecu<?php echo $payer['id_paiement']; ?>" style="z-index: 1; display: none; position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 500px; height: 400px; background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
    
            <div id="formulaireRecu<?php echo $payer['id_paiement']; ?>" style="display: none;padding:10px 0px 10px 0px; margin-bottom:20px;"">
			<div id="con_recu<?php echo $payer['id_paiement']; ?>">
                <h3>Reçu</h3>
                <table >
				<tr>
                        
                       <td style="text-align: center;">
    <img src="img/avatars/onligne.jpg" alt="Icône" class="icone-image" style="width: 100px; height: 50px;padding:10px 0px 10px 0px; margin-bottom:20px;""">
</td>

                    </tr>
                    <tr>
                        <td>Nom du Client:</td>
						<td> </td>
                        <td style="font-weight: bold;font-size: 16px;"><?php echo $payer['nom']; ?></td>
                    </tr>
					<tr>
					   <td> </br> </td>
					</tr>
                    <tr>
                        <td>Nom du Projet:</td>
						<td> </br> </td>
                        <td style="font-weight: bold;font-size: 16px;"><?php echo $payer['nom_projet']; ?></td>
                    </tr>
					<tr>
					   <td> </br> </td>
					</tr>
                    <tr>
                        <td>Montant de la Tranche:</td>
						<td> </td>
                        <td style="font-weight: bold;font-size: 16px;"><?php echo $payer['montant_tranche']; ?></td>
                    </tr>
					<tr>
					   <td> </br> </td>
					</tr>
                    <tr>
                        <td>Date de la Tranche:</td>
						<td> </td>
                        <td style="font-weight: bold;font-size: 16px;"><?php echo $payer['date_paiement']; ?></td>
                    </tr>
					<tr>
					   <td> </br> </td>
					</tr>
                </table>
				</div>
				
                <button type="button" class="btn btn-primary" onclick="imprimerContenuRecu(<?php echo $payer['id_paiement']; ?>)">Imprimer</button>
                <button type="button" class="btn btn-secondary" onclick="annulerRecu(<?php echo $payer['id_paiement']; ?>)">Annuler</button>
            
			 </div>
        </div>
    <?php } ?>
<?php } ?>




        <?php if (isset($_POST['affiche_modif']) && $_POST['affiche_modif']) { ?>
    <div id="popupContainermd<?php echo $payer['id_paiement']; ?>" style=" z-index:1;position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); background-color: white; padding: 20px; border-radius: 5px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);">
        <div id="formulaireModifier<?php echo $payer['id_paiement']; ?>">
            <h3>Vos données à Modifier</h3>
            <form method="POST" action="modifier_contenu_paiement.php">
                <div class="mb-3">
                    <label for="tranche" class="form-label">Montant Tranche</label>
                    <input type="text" class="form-control" name="tranche" value="<?php echo $_POST['tranche']; ?>">
                </div>
                <input type="hidden" name="clt" value='<?php echo $_POST['paiement']; ?>' />
                <input type="hidden" name="id_pa" value='<?php echo $_POST['id_pa']; ?>' />
                <button type="submit" name="modif" value="modifier">Modifier</button>
                <!-- Fix the onclick attribute to pass the id_paiement -->
                <button type="button" class="btn btn-secondary" onclick="annulerModification(<?php echo $payer['id_paiement']; ?>)">Annuler</button>
            </form>
        </div>
    </div>
<?php } ?>
        <button class="icon-button" onclick="afficherFormulaire('formulaireAjout')">
            <img src="img/icons/aj.png" alt="Ajouter" /> Ajouter
        </button>
		<div></br></div>
		<div class="col-12 col-md-10 col-xxl-9 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Paiement des clients</h5>
								</div>
								<?php   
			 include 'stat.php';
			 ?>
							</div>
						</div>
    </main>

</body>

</html>

<?php
$conn->close();
?>

<script>
    function afficherFormulaire(formulaireId) {
        var popupContainer = document.getElementById("popupContaineraj");
        var formulaire = document.getElementById(formulaireId);
        formulaire.style.display = "block";
        popupContainer.style.display = "block";
    }

    function annulerAjout() {
        var formulaire = document.getElementById("formulaireAjout");
        var popupContainer = document.getElementById("popupContaineraj");
        formulaire.style.display = "none";
        popupContainer.style.display = "none";
    }

    function afficherFormulaireModification(paiementId) {
        document.getElementById("formulaireModifierPaiement" + paiementId).submit();
    }

     function annulerModification(paiementId) {
        var formulaire = document.getElementById("formulaireModifier" + paiementId);
        var popupContainer = document.getElementById("popupContainermd" + paiementId);
        formulaire.style.display = "none";
        popupContainer.style.display = "none";
    }

    function afficherFormulaireRecu(paiementId) {
        var popupContainer = document.getElementById("popupContainerRecu" + paiementId);
        var formulaire = document.getElementById("formulaireRecu" + paiementId);
        popupContainer.style.display = "block";
        formulaire.style.display = "block";
    }

    function annulerRecu(paiementId) {
        var popupContainer = document.getElementById("popupContainerRecu" + paiementId);
        var formulaire = document.getElementById("formulaireRecu" + paiementId);
        popupContainer.style.display = "none";
        formulaire.style.display = "none";
    }
	function imprimerRecu(idPaiement) {
    // Afficher la popup du reçu
    var popupContainer = document.getElementById('popupContainerRecu' + idPaiement);
    var formulaireRecu = document.getElementById('formulaireRecu' + idPaiement);
    popupContainer.style.display = 'block';
    formulaireRecu.style.display = 'block';

    // Cacher les autres éléments de la page lors de l'impression
    var elementsToHide = document.querySelectorAll('body > :not(#popupContainerRecu' + idPaiement + ')');
    for (var i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].classList.add('hidden-for-print');
    }

    // Déclencher l'impression
    window.print();

    // Rétablir l'affichage des autres éléments après l'impression
    for (var i = 0; i < elementsToHide.length; i++) {
        elementsToHide[i].classList.remove('hidden-for-print');
    }

    // Cacher la popup du reçu après l'impression
    popupContainer.style.display = 'none';
    formulaireRecu.style.display = 'none';
}

function annulerRecu(idPaiement) {
    // Cacher la popup du reçu si l'utilisateur annule
    var popupContainer = document.getElementById('popupContainerRecu' + idPaiement);
    var formulaireRecu = document.getElementById('formulaireRecu' + idPaiement);
    popupContainer.style.display = 'none';
    formulaireRecu.style.display = 'none';
}
function imprimerContenuRecu(idPaiement) {
    var contenuRecu = document.getElementById('con_recu' + idPaiement).innerHTML;
    var popupWindow = window.open('', '_blank', 'width=900,height=900');
    popupWindow.document.open();
    popupWindow.document.write('<html><head><title>Reçu</title></head><body>' + contenuRecu + '</body></html>');
    popupWindow.document.close();
    popupWindow.print();
}

</script>
