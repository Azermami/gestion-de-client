<?php

include "db_connexion.php";

if (isset($_POST['demandeId'])) {
  $demandeId = $_POST['demandeId'];
  $clientid = $_POST['clientid']; // Suppression du 'echo' ici

  // Mettre à jour l'état de la demande dans la base de données
  $query = "UPDATE demande SET etat = 'client' WHERE id_demande = $demandeId";
  $result = mysqli_query($conn, $query); // Exécuter la requête avec mysqli_query

  // Récupérer l'étatc du client
  $queryy = "SELECT etatc FROM client WHERE id_client = $clientid"; 
  $result = mysqli_query($conn, $queryy);

  // Vérifier si la requête SELECT s'est bien exécutée
  if ($result) {
    $row = mysqli_fetch_assoc($result);
    $etatc = $row['etatc'];

    // Test si etatc est différent de 'client', alors mettre à jour l'étatc du client
    if ($etatc !== 'client') {
      $queryy = "UPDATE client SET etatc = 'client' WHERE id_client = $clientid";
      $result = mysqli_query($conn, $queryy); // Exécuter la requête pour mettre à jour l'étatc du client
      if ($result) {
        echo "L'état de la demande a été mis à jour avec succès.";
      } else {
        echo "Erreur lors de la mise à jour de l'étatc du client : " . mysqli_error($conn);
      }
    } else {
      echo "L'étatc du client est déjà à 'client'.";
    }
  } else {
    echo "Erreur lors de la récupération de l'étatc du client : " . mysqli_error($conn);
  }

  $conn->close();
} else {
  echo "Identifiant de demande non fourni.";
}
?>
