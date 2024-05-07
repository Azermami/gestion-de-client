<?php

$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$id_client_connecte = $_SESSION['id_client'];

// Compter le nombre de projets payés pour le client connecté
$sql_projets_payes = "SELECT COUNT(DISTINCT d.id_demande) AS total_payes,d.prix,d.etat
                      FROM demande d
                      INNER JOIN paiement p ON d.id_demande = p.id_demande
                      WHERE d.id_client = $id_client_connecte
                      GROUP BY d.id_demande
                      HAVING SUM(p.tranche) >= d.prix and d.etat='client'";

$result_projets_payes = $db->query($sql_projets_payes);

if ($result_projets_payes === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$total_projets_payes = $result_projets_payes->num_rows;

// Compter le nombre de projets restants pour le client connecté
$sql_projets_restants = "SELECT COUNT(DISTINCT d.id_demande) AS total_restants,d.prix,d.etat
                         FROM demande d
                         LEFT JOIN paiement p ON d.id_demande = p.id_demande
                         WHERE d.id_client = $id_client_connecte
                         GROUP BY d.id_demande
                         HAVING SUM(p.tranche) < d.prix OR SUM(p.tranche) IS NULL and d.etat='client'";

$result_projets_restants = $db->query($sql_projets_restants);

if ($result_projets_restants === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$total_projets_restants = $result_projets_restants->num_rows;

$db->close();
?>

<!-- Affichage du graphique en donut -->
<div id="donutChart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
        series: [
            <?php echo $total_projets_payes; ?>,
            <?php echo $total_projets_restants; ?>
        ],
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
        },
        labels: ['Nombre de projets payés', 'Nombre de projets restants'],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(0);
            }
        }
    }).render();
});
</script>
