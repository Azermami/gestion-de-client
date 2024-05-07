<?php
$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

// Total des clients de type "individu"
$sql_total_clients_individu = "SELECT COUNT(*) AS total_individu
                               FROM client
                               WHERE type_client = 'individu'";
$result_total_clients_individu = $db->query($sql_total_clients_individu);

if ($result_total_clients_individu === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_clients_individu = $result_total_clients_individu->fetch_assoc();
$total_clients_individu = $row_total_clients_individu['total_individu'];

// Total des clients de type "société"
$sql_total_clients_societe = "SELECT COUNT(*) AS total_societe
                              FROM client
                              WHERE type_client = 'ste'";
$result_total_clients_societe = $db->query($sql_total_clients_societe);

if ($result_total_clients_societe === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_clients_societe = $result_total_clients_societe->fetch_assoc();
$total_clients_societe = $row_total_clients_societe['total_societe'];

$db->close();
?>

<!-- Affichage du graphique en donut -->
<div id="donutChart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
        series: [<?php echo $total_clients_individu; ?>, <?php echo $total_clients_societe; ?>],
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
        },
        labels: ['Individu', 'Société'],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(0);
            }
        }
    }).render();
});
</script>
