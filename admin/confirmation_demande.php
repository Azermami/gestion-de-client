<?php
include "db_connexion.php";
require 'C:\XAMPP\PHPMailer\PHPMailer\src\PHPMailer.php';
require 'C:\XAMPP\PHPMailer\PHPMailer\src\SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $descriptif = $_FILES["descriptif"]["name"];
  $cahierCharge = $_FILES["cahier"]["name"];
  $demande = $_POST['id_demande'];
  if(isset($_POST['password'])){ $mot_de_passe = $_POST['password'];}
  $prix = $_POST['prix'];

  $descriptifDestination = "C:/XAMPP/htdocs/gestion_client/document/" . $descriptif;
  move_uploaded_file($_FILES["descriptif"]["tmp_name"], $descriptifDestination);

  $cahierChargeDestination = "C:/XAMPP/htdocs/gestion_client/document/" . $cahierCharge;
  move_uploaded_file($_FILES["cahier"]["tmp_name"], $cahierChargeDestination);

  // Obtention des URLs des documents
  $descriptifURL = "http://localhost/gestion_client/document/" . $descriptif;
  $cahierChargeURL = "http://localhost/gestion_client/document/" . $cahierCharge;

  // Modification de l'état de la demande et mise à jour des documents
  $updateQuery = "UPDATE demande 
                 SET descriptif = '$descriptifURL', cahier_charge = '$cahierChargeURL', prix = '$prix', etat = 'encour'
                 WHERE id_demande = '$demande'";

  if ($conn->query($updateQuery) === TRUE) {
	  // testb etat client//
    // Insertion du mot de passe dans la table client
	if(isset($_POST['password'])){
    $insertPasswordQuery = "UPDATE client 
                            SET mot_de_passe = '$mot_de_passe' WHERE id_client = (SELECT id_client FROM demande 
                              WHERE id_demande = '$demande' AND etatc = 'devis')";

    if ($conn->query($insertPasswordQuery) === TRUE) {
      // Récupération de l'adresse e-mail depuis la base de données
     echo $emailQuery = "SELECT `e-mail` FROM client WHERE id_client = (SELECT id_client FROM demande 
               WHERE id_demande = '$demande')";
      $result = $conn->query($emailQuery);

      if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo $email = $row["e-mail"];

        // Envoi de l'e-mail avec PHPMailer
        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
          // Paramètres SMTP
          $mail->isSMTP();
          $mail->Host = 'localhost';
          $mail->SMTPAuth = false;

          $mail->Port = 25;
          $email='azer854@yahoo.com';
          // Destinataire et contenu
          $mail->setFrom('azermami8@gmail.com', 'azer');
          $mail->addAddress($email);
          $mail->isHTML(true);
          $mail->Subject = 'Réponse à votre demande';
          $mail->Body = 'Votre demande a été confirmée avec succès.';

          $mail->send();
          echo "Demande confirmée avec succès. Un e-mail de confirmation a été envoyé.";
        } catch (Exception $e) {
          echo "Erreur lors de l'envoi de l'e-mail de confirmation : " . $mail->ErrorInfo;
        }
      } else {
        echo "Adresse e-mail non trouvée dans la base de données.";
      }
    } else {
      echo "Erreur lors de l'insertion du mot de passe : " . $conn->error;
    }
  } }
  
  
  else {
    echo "Erreur lors de la confirmation de la demande : " . $conn->error;
  }
  
}
header("Location: /gestion_client/admin/liste_demande.php"); 
?>
<?php
$smtpServer = 'smtp.gmail.com';
$smtpPort = 587; // Port 587 pour TLS ou 465 pour SSL/TLS
$timeout = 30;

$smtpConn = fsockopen($smtpServer, $smtpPort, $errno, $errstr, $timeout);

if (!$smtpConn) {
    echo "Échec de la connexion au serveur SMTP de Gmail : $errstr ($errno)";
} else {
    echo "Connexion au serveur SMTP de Gmail réussie.";
    fclose($smtpConn);
}
?>