<?php
include "db_connexion.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];
  $id_projet = $_POST['projet'];
  $etat= $_POST['etat'];
  $etatc='devis';
  $date_creation = date("Y-m-d");
  $descriptif = $message;
  $reqverif="SELECT * FROM `client` WHERE `e-mail`='$email'";
  $verif = $conn->query($reqverif);
  if ($verif->num_rows == 0) {
  $query1 = "INSERT INTO client (nom, `e-mail`,etatc) VALUES ('$name', '$email','$etatc')";

  if ($conn->query($query1) === TRUE) {
  $client_id = $conn->insert_id;}
  }
  else{
	   $row = $verif->fetch_assoc();
	   $client_id=$row['id_client'];}

    $query3 = "INSERT INTO demande (date_creation, descriptif, id_client, id_projet,etat) VALUES ('$date_creation', '$descriptif', '$client_id', '$id_projet', '$etat')";

    if ($conn->query($query3) === TRUE) {
      echo "success";
    } else {
      echo "Erreur lors de l'enregistrement de la demande dans la base de données.";
    }
  
  $conn->close();
}

?>
