<?php
include "db_connexion.php";


    if (
        isset($_POST['id']) && isset($_POST['nom']) && isset($_POST['prenom']) &&
        isset($_POST['mail']) && isset($_POST['telephone']) && isset($_POST['adresse']) &&
        isset($_POST['type_client'])
    ) {
        $id = $_POST['id'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $email = $_POST['mail']; 
        $telephone = $_POST['telephone'];
        $adresse = $_POST['adresse'];
        $type = $_POST['type_client'];

         $sql = "UPDATE client SET nom='$nom', prenom='$prenom', `e-mail`='$email', telephone='$telephone', adress='$adresse', type_client='$type' WHERE id_client='$id'";
        
        if ($conn->query($sql) === TRUE) {?>
		<form id="retour" method="post" action="liste_client.php">
		<input type="hidden" name="id_c" value=""/>
		</form>
		<script>
		document.getElementById("retour").submit();
		</script>
		<?php
            //header("Location: liste_client.php?message=ok");
            exit();
        } else {
            echo "Erreur lors de la modification du client : " . $conn->error;
        }
    } 


$conn->close();
?>
