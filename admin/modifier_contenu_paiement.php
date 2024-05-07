<?php
include "db_connexion.php";


if (isset($_POST['id_pa']) && isset($_POST['tranche'])) {
    $id = $_POST['id_pa'];
    $tranche = $_POST['tranche'];

    $sql_total = "SELECT d.prix AS total_prix
                  FROM paiement p
                  JOIN demande d ON p.id_demande = d.id_demande
                  WHERE p.id_paiement='$id'";

    $result_total = $conn->query($sql_total);

    if ($result_total->num_rows > 0) {
        $row_total = $result_total->fetch_assoc();
        $total_prix = $row_total['total_prix'];

        
        if ($tranche > $total_prix) {
              echo '<script>alert("Impossible de modifier le montant de la tranche. Le montant de la tranche ne peut pas être supérieur au total du prix.");</script>';
        } else {
           
            $montant_restant = $total_prix - $tranche;

           
            if ($montant_restant < 0) {
                echo '<script>alert("Impossible de modifier le montant de la tranche. Il reste un montant supérieur au total du prix.");</script>';
            } else {
                
                $sql_update = "UPDATE paiement SET tranche='$tranche' WHERE id_paiement='$id'";
                if ($conn->query($sql_update) === TRUE) {
                    
                    header("Location: suivie_paiement.php?id_paiement=$id&message=ok");
                    exit();
                } else {
                    echo "Erreur lors de la modification du paiement: " . $conn->error;
                }
            }
        }
    } else {
        echo "Erreur: Le paiement avec l'ID '$id' n'a pas été trouvé.";
    }
}

$conn->close();
?>

