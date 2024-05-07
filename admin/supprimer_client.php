<?php
include "db_connexion.php";
//print_r($_POST);

 
     $id = $_GET['client'];
     $sql = "DELETE FROM client WHERE id_client='$id'";
    
   if ($conn->query($sql) === TRUE) {
        header("Location: liste_client.php");
        echo "Le client a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du client : " . $conn->error;
    }

$conn->close();
?>

