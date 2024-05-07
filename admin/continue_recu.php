<?php
include "db_connexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomClient = $_POST["nom_client"];
    $nomProjet = $_POST["nom_projet"];
    $dateTranche = $_POST["date_tranche"];

    echo "Reçu généré pour le client : " . $nomClient . "<br>";
    echo "Projet : " . $nomProjet . "<br>";
    echo "Date de la tranche : " . $dateTranche . "<br>";
} else {
    echo "Erreur : méthode de requête invalide.";
}
?>
