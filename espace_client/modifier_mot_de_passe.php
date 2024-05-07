<?php
session_start();
$id_client = $_SESSION['id_client'];
include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['current-password'];
    $newPassword = $_POST['new-password'];
    $confirmPassword = $_POST['confirm-password'];

    // Vérifier si le mot de passe actuel est correct
    $query = "SELECT mot_de_passe FROM client WHERE id_client = $id_client";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $currentPasswordHash = $row['mot_de_passe'];

        if ($currentPassword==$currentPasswordHash) {
                // Vérifier si le nouveau mot de passe correspond à la confirmation
            if ($newPassword == $confirmPassword) {
                // Générer le hash du nouveau mot de passe
                //$newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

                // Mettre à jour le mot de passe dans la base de données
                $updateQuery = "UPDATE client SET mot_de_passe = '$newPassword' WHERE id_client = $id_client";
                $updateResult = mysqli_query($conn, $updateQuery);

                if ($updateResult) {
                    echo "Le mot de passe a été modifié avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour du mot de passe : " . mysqli_error($conn);
                }
            } else {
                echo "Le nouveau mot de passe ne correspond pas à la confirmation.";
            }
        } else {
            echo "Le mot de passe actuel est incorrect.";
        }
    } else {
        echo "Aucune donnée trouvée dans la base de données.";
    }
}
?>
