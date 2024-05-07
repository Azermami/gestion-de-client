

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
                $id_client = $_SESSION['id_client'];
                $query = "SELECT COUNT(*) AS count FROM demande WHERE etat = 'encour'and id_client = $id_client";
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
         $id_client = $_SESSION['id_client'];
    
    $query = "SELECT * FROM demande WHERE etat = 'encour' and id_client = $id_client";
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
            echo '<div class="text-dark">New Devis Request</div>';
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
										4 New Messages
									</div>
								</div>
								<div class="list-group">
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-5.jpg" class="avatar img-fluid rounded-circle" alt="Vanessa Tucker">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Vanessa Tucker</div>
												<div class="text-muted small mt-1">Nam pretium turpis et arcu. Duis arcu tortor.</div>
												<div class="text-muted small mt-1">15m ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-2.jpg" class="avatar img-fluid rounded-circle" alt="William Harris">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">William Harris</div>
												<div class="text-muted small mt-1">Curabitur ligula sapien euismod vitae.</div>
												<div class="text-muted small mt-1">2h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-4.jpg" class="avatar img-fluid rounded-circle" alt="Christina Mason">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Christina Mason</div>
												<div class="text-muted small mt-1">Pellentesque auctor neque nec urna.</div>
												<div class="text-muted small mt-1">4h ago</div>
											</div>
										</div>
									</a>
									<a href="#" class="list-group-item">
										<div class="row g-0 align-items-center">
											<div class="col-2">
												<img src="img/avatars/avatar-3.jpg" class="avatar img-fluid rounded-circle" alt="Sharon Lessman">
											</div>
											<div class="col-10 ps-2">
												<div class="text-dark">Sharon Lessman</div>
												<div class="text-muted small mt-1">Aenean tellus metus, bibendum sed, posuere ac, mattis non.</div>
												<div class="text-muted small mt-1">5h ago</div>
											</div>
										</div>
									</a>
								</div>
								<div class="dropdown-menu-footer">
									<a href="#" class="text-muted">Show all messages</a>
								</div>
							</div>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                <i class="align-middle" data-feather="settings"></i>
              </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                <?php
         include "db_connexion.php";       
         $id_client = $_SESSION['id_client'];
         $sql = "SELECT photo FROM client WHERE id_client = $id_client";
         $res = mysqli_query($conn, $sql);

         if (mysqli_num_rows($res) > 0) {
          $row = mysqli_fetch_assoc($res);
          $photo = $row['photo'];
		  
          if (!empty($photo)) {
            echo '<img width="30px" height="30px" alt="Profile" src="espace_client/uploads/' . $photo . '" class="rounded-circle">';
          } else {
            echo '<img width="30px" height="30px" src="assets/img/img-profil.png" alt="Profile" class="rounded-circle">';
          }
        }

        mysqli_close($conn);
        ?> <span class="text-dark"><?php echo "bienvenue, " . $nomc;?></span>
              </a>
							<div class="dropdown-menu dropdown-menu-end">
								<a class="dropdown-item" href="profil.php"><i class="align-middle me-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="pie-chart"></i> Analytics</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="index.php"><i class="align-middle me-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="#"><i class="align-middle me-1" data-feather="help-circle"></i> Help Center</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="connexion.php">Se déconnecter</a>
							</div>
						</li>
					</ul>
				</div>
			</nav>