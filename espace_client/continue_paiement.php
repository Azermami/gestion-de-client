<!-- Assurez-vous d'inclure jQuery et jQuery UI -->
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<?php
include "db_connexion.php";

$query = "SELECT p.id_projet, p.libelle AS libelle_projet, d.prix
          FROM projet p
          INNER JOIN demande d ON p.id_projet = d.id_projet
          WHERE d.etat='client' AND d.id_client = ?";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $client_id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result) {
  die("Erreur dans la requête : " . mysqli_error($conn));
}
?>

<main class="content">
<div class="pagetitle">
        <h1>Mon Historique de paiement</h1>
    </div>
  <div class="container-fluid p-0">
  
    <table class="table table-striped" border="3"  <?php if(isset($projet_id)&&$projet_id!="") {echo $projet_id;?>  style="display:none"<?php }?>>
      <thead>
        <tr>
          <th scope="col">Libellé projet</th>
          <th scope="col">Prix</th>
          <th scope="col">Montant payé</th>
          <th scope="col">Montant restant</th>
          <th scope="col">Historique de paiement</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        while ($row = mysqli_fetch_array($result)) {
          $projet_id = $row['id_projet'];

          // Effectuez une requête pour obtenir le montant payé pour le projet spécifié
          $paiement_query = "SELECT SUM(tranche) AS montant_paye FROM paiement WHERE id_demande IN (SELECT id_demande FROM demande WHERE id_projet = ?)";
          $stmt_paiement = $conn->prepare($paiement_query);
          $stmt_paiement->bind_param("i", $projet_id);
          $stmt_paiement->execute();
          $paiement_result = $stmt_paiement->get_result();
          $paiement_row = mysqli_fetch_array($paiement_result);
          $montant_paye = $paiement_row['montant_paye'];

          // Calculer le montant restant
          $montant_restant = $row['prix'] - $montant_paye;
        ?>
          <tr>
            <td><?php echo $row['libelle_projet']; ?></td>
            <td><?php echo $row['prix']; ?></td>
            <td><?php echo $montant_paye; ?></td>
            <td><?php echo $montant_restant; ?></td>
            <td>
              <!-- Utilisez une fonction JavaScript pour afficher la popup modale avec l'historique de paiement pour le projet spécifié -->
              <button class="icon-button" onclick="showPaymentHistory(<?php echo $projet_id; ?>)">Voir l'historique de paiement</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php   
			 include 'stat_paiement.php';
			 ?>
</main>

<!-- Div pour afficher la popup modale -->
<div id="dialog" title="Historique de paiement"></div>

<script>
  function showPaymentHistory(projetId) {
    $.ajax({
      url: "affiche_continue_paiement.php",
      method: "POST",
      data: { projetId: projetId },
      success: function(response) {
        // Afficher le contenu de la popup avec les données de paiement "
        $("#dialog").html(response);
        $("#dialog").dialog({
          modal: true,
          width: "400px",
          buttons: {
            Fermer: function() {
              $(this).dialog("close");
            }
          }
        });
      },
      error: function(error) {
        console.log(error);
      }
    });
  }
</script>

