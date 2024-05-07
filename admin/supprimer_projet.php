<?php
include "db_connexion.php";
print_r($_POST);

 
    echo $id = $_GET['projet'];
    echo $sql = "DELETE FROM projet WHERE id_projet='$id'";
    
   if ($conn->query($sql) === TRUE) {
        header("Location: liste_projet.php");
        echo "Le projet a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du projet : " . $conn->error;
    }

$conn->close();
?>

