<?php
include "db_connexion.php";
print_r($_POST);

    if (
        isset($_POST['id']) && isset($_POST['libelle']) 
    ) {
        $id = $_POST['id'];
        $libelle = $_POST['libelle'];
       

        echo $sql = "UPDATE projet SET libelle='$libelle' WHERE id_projet='$id'";
        
        if ($conn->query($sql) === TRUE) {?>
		<form id="retour" method="post" action="liste_projet.php">
		<input type="hidden" name="id_p" value=""/>
		</form>
		<script>
		document.getElementById("retour").submit();
		</script>
		<?php
            //header("Location: liste_projet.php");
            exit();
        } else {
            echo "Erreur lors de la modification du projet : " . $conn->error;
        }
    } 


$conn->close();
?>
