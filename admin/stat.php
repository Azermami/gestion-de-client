<?php
$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

// Total des clients ayant terminé tous les paiements
$sql_total_clients_payes = "SELECT COUNT(DISTINCT id_client) AS total_payes
                            FROM demande
                            WHERE id_demande IN (
                                SELECT id_demande
                                FROM paiement
                                GROUP BY id_demande
                                HAVING SUM(tranche) = prix
                            )";
$result_total_clients_payes = $db->query($sql_total_clients_payes);

if ($result_total_clients_payes === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_clients_payes = $result_total_clients_payes->fetch_assoc();
$total_clients_payes = $row_total_clients_payes['total_payes'];

// Total des clients n'ayant pas encore terminé tous les paiements
$sql_total_clients_encour = "SELECT COUNT(DISTINCT id_client) AS total_encour
                             FROM demande
                             WHERE id_demande IN (
                                 SELECT id_demande
                                 FROM paiement
                                 GROUP BY id_demande
                                 HAVING SUM(tranche) < prix
                             )";
$result_total_clients_encour = $db->query($sql_total_clients_encour);

if ($result_total_clients_encour === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_clients_encour = $result_total_clients_encour->fetch_assoc();
$total_clients_encour = $row_total_clients_encour['total_encour'];

$db->close();
?>

<!-- Affichage du graphique en donut -->
<div id="donutChart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
        series: [<?php echo $total_clients_payes; ?>, <?php echo $total_clients_encour; ?>],
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
        },
        labels: ['Clients ayant terminé tous les paiements', 'Clients n\'ayant pas terminé tous les paiements'],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(0);
            }
        }
    }).render();
});
</script>
