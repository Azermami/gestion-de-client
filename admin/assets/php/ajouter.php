<?php

// Retrieve the row information from the URL parameters
$id_interpret = $_GET['id'];
$nom = $_GET['nom'];
$prenom = $_GET['prenom'];
$photo = $_GET['photo'];
$email = $_GET['email'];
$telephone = $_GET['telephone'];
$pays = $_GET['pays'];
$association = $_GET['association'];
$login = $_GET['login'];
$mot_de_passe = $_GET['mot_de_passe'];

?>

<form>
  <div class="row mb-3">
    <label for="inputNom" class="col-sm-2 col-form-label">Nom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputNom" value="<?php echo $nom; ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPrenom" class="col-sm-2 col-form-label">Prenom</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="inputPrenom" value="<?php echo $prenom; ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputEmail" class="col-sm-2 col-form-label">E-mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" value="<?php echo $email; ?>">
    </div>
  </div>
  <div class="row mb-3">
    <label for="inputPassword" class="col-sm-2 col-form-label" id="password-input">Mot de Passe</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" value="<?php echo $mot_de_passe; ?>">
      <br>
      <button type="button" class="btn btn-primary" id="generate-button">Generate</button>
      <input class="form-check-input" type="checkbox" id="show-password-checkbox">
      <label class="form-check-label" for="show-password-checkbox">
        Show
      </label>
    </div>
  </div>
  <div class="row mb-3">
    <div class="col-sm-10">
    </div>
    <div class="row mb-3">
      <label for="inputNumber" class="col-sm-2 col-form-label">Telephone</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" value="<?php echo $telephone; ?>">
      </div>
    </div>
    <div class="row mb-3">
      <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
      <div class="col-sm-10">
        <input class="form-control" type="file" id="formFile">
      </div>
    </div>
    <div class="row mb-3">
      <div class="col-sm-12 text-center">
        <button type="submit" class="btn btn-primary">Submit Form</button>
      </div>
    </div>
</form>
