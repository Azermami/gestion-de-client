<?php
$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$sql_total_clients = "SELECT COUNT(id_demande) AS total FROM demande";
$result_total_clients = $db->query($sql_total_clients);

if ($result_total_clients === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_clients = $result_total_clients->fetch_assoc();
$total_clients = $row_total_clients['total'];

$sql_clients_devis = "SELECT COUNT(id_demande) AS total FROM demande WHERE etat = 'devis'";
$result_clients_devis = $db->query($sql_clients_devis);

if ($result_clients_devis === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_clients_devis = $result_clients_devis->fetch_assoc();
$total_clients_devis = $row_clients_devis['total'];

$db->close();
?>

<!-- Display the donut chart -->
<div id="donutChart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
        series: [<?php echo $total_clients; ?>, <?php echo $total_clients_devis; ?>],
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
        },
        labels: ['Nombre total des demandes', 'Nombre des demandes en devis'],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(0);
            }
        }
    }).render();
});
</script>
