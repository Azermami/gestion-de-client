<?php
include "db_connexion.php";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $message = $_POST['message'];
  $id_projet = $_POST['projet'];
  $etat = $_POST['etat'];
  $date_creation = date("Y-m-d");
  $descriptif = $message;
  $client_id = $_POST['client_id'];
  print_r($_POST);

  $query3 = "INSERT INTO demande (date_creation, descriptif, id_client, id_projet, etat) VALUES ('$date_creation', '$descriptif', '$client_id', '$id_projet', '$etat')";
  if ($conn->query($query3) === TRUE) {
    echo "success";
  }
  else {
    echo "Erreur lors de l'enregistrement de la demande dans la base de données.";
  }
 header("Location: passation_commande.php");  
  $conn->close();
}
?>

<main class="content">
<div class="pagetitle">
        <h1>Passation d'une nouvelle demande</h1>
    </div>
  <div class="container-fluid p-0">
    <form action="continue_commande.php" method="post" role="form" class="php-email-form">
      <div class="mb-3">
        <label for="name">Projet</label>
        <select name="projet" class="form-select">
          <option value=""></option>
          <?php
          include "db_connexion.php";
          $rep = "SELECT projet.id_projet, projet.libelle FROM projet";
          $req = $conn->query($rep);
          while ($row = mysqli_fetch_array($req)) {
            echo '<option value="' . $row['id_projet'] . '">' . $row['libelle'] . '</option>';
          }
          ?>
        </select>
      </div>

     
	  <div class="row" style="padding:10px 0px 10px 0px; margin-bottom:20px;">
    <div class="mb-3">
        <label for="montantTranche" class="form-label">Etat</label>
        <select name="etat" class="form-select" >
          <option value="devis">devis</option>
        </select>
      </div>

      <div class="form-group">
        <label for="name">Message</label>
        <textarea class="form-control" name="message" rows="10" required></textarea>
      </div>
      <div> <input type="hidden" name="client_id" value="<?php echo $client_id ?>" /> </div>
      <div class="row">
		<div class="col-md-6" style="margin-left:75%;margin-top:20px">
        <button type="submit" class="btn btn-secondary">Envoyer le message</button>
        <button type="reset" class="btn btn-secondary" name="annuler">Annuler</button>
      </div>
	  </div>
    </form>
  </div>
</main>
