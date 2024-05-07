<?php
include "db_connexion.php";

if (isset($_POST['projetId'])) {
  $projet_id = $_POST['projetId'];

  // Effectuez une requête pour obtenir l'historique de paiement pour le projet spécifié
  $paiement_query = "SELECT date_paiement, tranche FROM paiement WHERE id_demande IN (SELECT id_demande FROM demande WHERE id_projet = ?)";
  $stmt_paiement = $conn->prepare($paiement_query);
  $stmt_paiement->bind_param("i", $projet_id);
  $stmt_paiement->execute();
  $paiement_result = $stmt_paiement->get_result();

  if (!$paiement_result) {
    die("Erreur dans la requête : " . mysqli_error($conn));
  }
?>
    
    <table class="table table-striped"  >
	<thead>
        <tr>
          <th scope="col">Date paiement</th>
          <th scope="col">Tranche</th>
		   </tr>
      </thead>
  <?php if (mysqli_num_rows($paiement_result) > 0) {?>
  

    
   <?php while ($paiement_row = mysqli_fetch_array($paiement_result)) {?>
     <tr>
      <td> <?php echo $paiement_row['date_paiement'] ?></td>
      <td> <?php echo $paiement_row['tranche']?> </td>
      </tr>
    <?php } 
    
  } else {
    echo "<tr>
      <td colspan=2> Aucun paiement trouvé pour ce projet</td>
      
      </tr>";
  }echo "</table>";
}
?>