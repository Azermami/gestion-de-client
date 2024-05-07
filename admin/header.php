<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle js-sidebar-toggle">
          <i class="hamburger align-self-center"></i>
        </a>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
        <div class="position-relative">
            <i class="align-middle" data-feather="bell"></i>
            <span class="indicator">
                <?php
                include "db_connexion.php";
                
                $query = "SELECT COUNT(*) AS count FROM demande WHERE etat = 'devis'";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo $row['count'];
                } else {
                    echo '0';
                }
                
                $conn->close();
                ?>
            </span>
        </div>
    </a>
    <?php
    include "db_connexion.php";
    
    $query = "SELECT * FROM demande WHERE etat = 'devis'";
    $result = $conn->query($query);
    
    if ($result->num_rows > 0) {
        echo '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">';
        echo '<div class="dropdown-menu-header">' . $result->num_rows . ' Nouvelles notifications</div>';
        echo '<div class="list-group">';
        
        while ($row = $result->fetch_assoc()) {
            echo '<a href="#" class="list-group-item">';
            echo '<div class="row g-0 align-items-center">';
            echo '<div class="col-2">';
            echo '<i class="text-primary" data-feather="home"></i>';
            echo '</div>';
            echo '<div class="col-10">';
            echo '<div class="text-dark">Nouvelles notifications</div>';
            echo '<div class="text-muted small mt-1">' . $row['descriptif'] . '</div>';
            echo '<div class="text-muted small mt-1">' . $row['date_creation'] . '</div>';
            echo '</div>';
            echo '</div>';
            echo '</a>';
        }
        
        echo '</div>';
        echo '<div class="dropdown-menu-footer">';
        echo '<a href="#" class="text-muted">Voir Toute les notifications</a>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="alertsDropdown">';
        echo '<div class="dropdown-menu-header">No New Notifications</div>';
        echo '</div>';
    }
    
    $conn->close();
    ?>
</li>

						<li class="nav-item dropdown">
    <a class="nav-icon dropdown-toggle" href="#" id="messagesDropdown" data-bs-toggle="dropdown">
        <div class="position-relative">
            <i class="align-middle" data-feather="message-square"></i>
        </div>
    </a>
    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end py-0" aria-labelledby="messagesDropdown">
        <div class="dropdown-menu-header">
            <div class="position-relative">
                <?php
                include "db_connexion.php";
                
                $query = "SELECT COUNT(*) AS count FROM demande WHERE etat = 'devis'";
                $result = $conn->query($query);
                
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    echo $row['count'] . ' nouveau message';
                } else {
                    echo 'Aucun nouveau trouvé';
                }
                
                $conn->close();
                ?>
            </div>
        </div>
        <div class="list-group">
            <?php
include "db_connexion.php";

$query = "SELECT demande.descriptif, demande.date_creation, client.nom, client.prenom, client.photo 
          FROM demande 
          INNER JOIN client ON demande.id_client = client.id_client 
          WHERE demande.etat = 'devis'";
$result = $conn->query($query);
$conteur=0;
if ($result->num_rows > 0) {
	
	$conteur++;
    while ($row = $result->fetch_assoc()) {
        echo '<a href="#" class="list-group-item">';
        echo '<div class="row g-0 align-items-center">';
        
        echo '<div class="col-10 ps-2">';
        echo '<div class="text-dark">' . $row['prenom'] . ' ' . $row['nom'] . '</div>';
        echo '<div class="text-muted small mt-1">' . $row['descriptif'] . '</div>';
        echo '<div class="text-muted small mt-1">' . $row['date_creation'] . '</div>';
        echo '</div>';
        echo '</div>';
        echo '</a>';
		if ($conteur==5) break;
    }
} else {
    echo '<a href="#" class="list-group-item">';
    echo '<div class="row g-0 align-items-center">';
    echo '<div class="col-12">';
    echo 'Aucun message trouvé.';
    echo '</div>';
    echo '</div>';
    echo '</a>';
}

$conn->close();
?>

        </div>
        <div class="dropdown-menu-footer">
            <a href="#" class="text-muted">Voir Toute les messages</a>
        </div>
    </div>
</li>

						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <img src="img/avatars/avatar.jpg" class="avatar img-fluid rounded me-1" alt="Charles Hall" /> <span class="text-dark">Azer</span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<div class="d-grid gap-2 mt-3">
											<a href="connexion.php" class="btn btn-lg btn-primary">Se Déconnecter</a>
										</div>
							</div>
						</li>
					</ul>
				</div>
			</nav>