<?php

include "db_connexion.php";

if (isset($_POST['demandeId'])) {
  $demandeId = $_POST['demandeId'];

  // Mettre à jour l'état de la demande dans la table demande
  $updateDemandeQuery = "UPDATE demande SET etat = 'client' WHERE id_demande = $demandeId";
  $conn->query($updateDemandeQuery);

  // Mettre à jour l'étatc du client dans la table client
  $updateClientQuery = "UPDATE client SET etatc = 'client' WHERE id_client = (SELECT id_client FROM demande WHERE id_demande = $demandeId)";
  $conn->query($updateClientQuery);

  // Redirection vers la même page pour rafraîchir les données
  header("Location: ".$_SERVER['PHP_SELF']);
  exit();
}

$query = "SELECT c.id_client, c.nom, p.libelle, d.prix, d.etat, d.cahier_charge, d.descriptif,d.id_demande FROM demande d
          INNER JOIN client c ON d.id_client = c.id_client
          INNER JOIN projet p ON d.id_projet = p.id_projet
          WHERE c.id_client = $client_id ";

$result = $conn->query($query);

if (!$result) {
  die("Erreur dans la requête : " . $conn->error);
}

$conn->close();
?>

<main class="content">
<div class="pagetitle">
        <h1>Mes Demandes</h1>
    </div>
  <div class="container-fluid p-0">
    <table class="table table-striped" border="3">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Nom</th>
          <th scope="col">Libellé projet</th>
          <th scope="col">Cahier de charge</th>
          <th scope="col">Déscriptif</th>
          <th scope="col">Prix</th>
          <th scope="col">Statut</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while ($row = mysqli_fetch_array($result)) { ?>
          <tr>
            <th scope="row"><?php echo $row['id_client']; ?></th>
            <td><?php echo $row['nom']; ?></td>
            <td><?php echo $row['libelle']; ?></td>
            <td>
              <a href="<?php echo $row['cahier_charge']; ?>" target="_blank">Cahier de charge</a>
            </td>
            <td>
              <a href="<?php echo $row['descriptif']; ?>" target="_blank">Descriptif</a>
            </td>
            <td><?php echo $row['prix']; ?></td>
            <td><?php echo $row['etat']; ?></td>
            <td>
              <button class="icon-button" onclick="validerDemande(<?php echo $row['id_demande']; ?>,<?php echo $row['id_client']; ?>)">Valider</button>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <?php   
			 include 'stat_demande.php';
			 ?>
  
</main>


