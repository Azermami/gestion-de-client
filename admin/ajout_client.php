<?php
include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (
        isset($_POST['nomAjout']) && isset($_POST['prenomAjout']) && isset($_POST['mailAjout']) &&
        isset($_POST['telephoneAjout']) && isset($_POST['adresseAjout']) && isset($_POST['typeAjout']) &&isset($_POST['etat']) &&
        isset($_POST['mot_de_passe'])
    ) {
        $nom = $_POST['nomAjout'];
        $prenom = $_POST['prenomAjout'];
        $email = $_POST['mailAjout'];
        $telephone = $_POST['telephoneAjout'];
        $adresse = $_POST['adresseAjout'];
        $type = $_POST['typeAjout'];
		$etat = $_POST['etat'];
        $mot_de_passe = $_POST['mot_de_passe'];

        $sql = "INSERT INTO client (nom, prenom, `e-mail`, telephone, adress, type_client,etatc, mot_de_passe)
                VALUES ('$nom', '$prenom', '$email', '$telephone', '$adresse', '$type','$etat', '$mot_de_passe')";

        if ($conn->query($sql) === TRUE) {
            header("Location: liste_client.php"); 
            exit(); 
        } else {
            echo "Erreur lors de l'ajout du client : " . $conn->error;
        }
    } else {
        echo "Veuillez rempli les champs du formulaire";
    }
}

$sql = "SELECT * FROM client";
$result = $conn->query($sql);
$clients = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $clients[] = $row;
    }
}

$conn->close();
?>
