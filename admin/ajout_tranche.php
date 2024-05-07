<?php

include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['projet']) && isset($_POST['client'])) {
        $tranche = $_POST['tranche'];

       

        
                $client=$_POST["client"];
				$projet=$_POST["projet"];
                
               $sumQuery="SELECT SUM(tranche) AS total,prix,d.id_demande as id_demande
                  FROM demande d
                LEFT JOIN paiement p ON d.id_demande = p.id_demande
                 WHERE id_client = $client and id_projet=$projet";
                
                $sumResult = $conn->query($sumQuery);
                $sumRow = $sumResult->fetch_assoc();
                $totalPaid = $sumRow['total'];
                $prix_projet = $sumRow["prix"];
                if ($tranche > ($prix_projet - $totalPaid)) {
                   echo '<script>alert("Impossible de dépasser le montant à payer.");</script>';
                } elseif ($totalPaid == $prix_projet) {
                    echo '<script>alert("Le montant total du projet a déjà été payé.");</script>';
                } else {
                    $datejour = date("Y-m-d");
                    $modaliter = $_POST['modaliter'];
					$id_demande=$sumRow['id_demande'];
                    $insertQuery = "INSERT INTO paiement (tranche, id_demande, date_paiement, modaliter_paiement) VALUES ($tranche,$id_demande,'$datejour','$modaliter')";
                   if ($conn->query($insertQuery) === TRUE) {
                      header("Location: suivie_paiement.php");
                       exit();
                    } 
					else {
                       echo "Erreur lors de l'ajout de la tranche : " . $conn->error;
}
                }
            
        
           
    
}
}
$conn->close();
?>
