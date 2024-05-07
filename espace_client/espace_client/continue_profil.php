
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Mon Profil</h1>
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <?php
                        include "db_connexion.php";
                        $id_client = $_SESSION['id_client'];
                        $sql = "SELECT photo FROM client WHERE id_client = $id_client";
                        $res = mysqli_query($conn, $sql);

                        if (mysqli_num_rows($res) > 0) {
                            $row = mysqli_fetch_assoc($res);
                            $photo = $row['photo'];

                            if (!empty($photo)) {
                                echo '<img width="120px" height="120px" src="espace_client/uploads/' . $photo . '" alt="Profile" class="rounded-circle">';
                            } else {
                                echo '<img width="120px" height="120px" src="assets/img/img-profil.png" alt="Profile" class="rounded-circle">';
                            }
                        }

                        mysqli_close($conn);
                        ?>
                        <h2><?php echo $_SESSION['nom'] . " " . $_SESSION['prenom']; ?></h2>
                        <h3>client</h3>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                      
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <a href="#profile-tab" class="nav-link active" data-bs-toggle="tab">Profil</a>
                            </li>
                            <li class="nav-item">
                                <a href="#edit-tab" class="nav-link" data-bs-toggle="tab">Modifier</a>
                            </li>
                            <li class="nav-item">
                                <a href="#password-tab" class="nav-link" data-bs-toggle="tab">Mot de passe</a>
                            </li>
                        </ul><!-- End Bordered Tabs -->

                        <!-- Tab Content -->
                        <div class="tab-content pt-3">
                            <!-- Profile Tab -->
                            <div class="tab-pane fade show active" id="profile-tab">
                                <h4>Informations personnelles</h4>
                                <div class="profile-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="nom" class="form-label">Nom</label>
                                                <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['nom']; ?>" readonly>
                                            </div>
                                            <div class="mb-3">
                                                <label for="prenom" class="form-label">Prénom</label>
                                                <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom']; ?>" readonly>
                                            </div>
											  <div class="mb-3">
												<label for="telephone" class="form-label">Téléphone</label>
												<input type="number" class="form-control" id="telephone" name="telephone" value="<?php echo $_SESSION['telephone']; ?>"readonly>
											</div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" name="email"value="<?php echo $_SESSION['e-mail']; ?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Edit Tab -->
                            <div class="tab-pane fade" id="edit-tab">
                                <h4>Modifier les informations</h4>
								
                                <div class="profile-form">
                                    <div class="row">
                                        <div class="col-md-6">
										 <!-- Profile Edit Form -->
                  <form method="post" action="upload1.php" enctype="multipart/form-data">
  <div class="row mb-3">
    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image de profil</label>
    <div class="col-md-8 col-lg-9">
      <?php
        include "db_connexion.php";
        $id_client = $_SESSION['id_client'];
        $sql = "SELECT photo FROM client WHERE id_client = $id_client";
        $res = mysqli_query($conn, $sql);

        if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $photo = $row['photo'];
          if (!empty($photo)) {
            echo '<img width="120px" height="120px" src="espace_client/uploads/' . $photo . '" alt="Profile" class="rounded-circle">';
          } else {
            echo '<img width="120px" height="120px" src="assets/img/img-profil.png" alt="Profile" class="rounded-circle">';
          }
        } else {
          echo '<img width="120px" height="120px" src="assets/img/img-profil.png" alt="Profile" class="rounded-circle">';
        }

        mysqli_close($conn);
      ?>
      <div class="pt-2">
        <input type="file" name="my_image" id="profileImage" style="display: none;">
        <label for="profileImage" class="btn btn-danger" title="Upload new profile image">
          <i class="bi bi-upload"></i>
        </label>
        <button type="submit" name="submit" class="btn btn-success">Modifier</button>
      </div>
    </div>
  </div>
</form>

                                            <form method="POST" action="modifier_profil.php">
                                                <div class="mb-3">
                                                    <label for="nom" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="nom" name="nom" value="<?php echo $_SESSION['nom']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="prenom" class="form-label">Prénom</label>
                                                    <input type="text" class="form-control" id="prenom" name="prenom" value="<?php echo $_SESSION['prenom']; ?>" required>
                                                </div>
												<div class="mb-3">
                                                    <label for="telephone" class="form-label">telephone</label>
                                                    <input type="number" class="form-control" id="telphone" name="telephone" value="<?php echo $_SESSION['telephone']; ?>" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email"value="<?php echo $_SESSION['e-mail']; ?>" readonly >
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Edit Tab -->
                            
                            <!-- Password Tab -->
                            <div class="tab-pane fade" id="password-tab">
                                <h4>Modifier le mot de passe</h4>
                                <div class="profile-form">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form method="POST" action="modifier_mot_de_passe.php">
                                                <div class="mb-3">
                                                    <label for="current-password" class="form-label">Mot de passe actuel</label>
                                                    <input type="password" class="form-control" id="current-password" name="current-password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="new-password" class="form-label">Nouveau mot de passe</label>
                                                    <input type="password" class="form-control" id="new-password" name="new-password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="confirm-password" class="form-label">Confirmer le mot de passe</label>
                                                    <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                                                </div>
                                                <div class="mb-3">
                                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><!-- End Profile Section -->
</main>
