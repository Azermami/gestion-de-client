<main class="content">
<div class="container-fluid p-0">

					<h1 class="h3 mb-3"><strong>Menu</strong> Admin</h1>

					

					<div class="row">
						<div class="col-12 col-md-6 col-xxl-6 d-flex order-2 order-xxl-3">
							<div class="card flex-fill w-100">
								<div class="card-header">

									<h5 class="card-title mb-0">Statistiques Clients</h5>
								</div>
								<?php   
			 include 'piechart.php';
			 ?>
							</div>
						</div>
						
						<div class="col-12 col-md-12 col-xxl-6 d-flex order-1 order-xxl-1">
							<div class="card flex-fill">
								<div class="card-header">

									<h5 class="card-title mb-0">Calendar</h5>
								</div>
								<div class="card-body d-flex">
									<div class="align-self-center w-100">
										<div class="chart">
											<div id="datetimepicker-dashboard"></div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					

					

				</div>
			</main>