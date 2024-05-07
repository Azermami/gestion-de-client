<?php
session_start();
$id_client = $_SESSION['id_client'];
include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $query = "SELECT * FROM client WHERE id_client = $id_client";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : $row['nom'];
        $prenom = isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : $row['prenom'];
        $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : $row['e-mail'];
        $telephone = isset($_POST['telephone']) ? htmlspecialchars($_POST['telephone']) : $row['telephone'];
        // Requête de mise à jour des informations de l'utilisateur
        $updateQuery = "UPDATE client SET nom='$nom', prenom='$prenom', `e-mail`='$email', telephone='$telephone' WHERE id_client='$id_client'";
        $updateResult = mysqli_query($conn, $updateQuery);

        if ($updateResult) {
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;
            echo '<meta http-equiv="refresh" content="0;URL=profil.php">';
        } else {
            echo "Erreur lors de la mise à jour des champs : " . mysqli_error($conn);
        }
    } else {
        echo "Aucune donnée trouvée dans la base de données.";
    }
}
?>
