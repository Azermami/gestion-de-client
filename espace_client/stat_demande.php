<?php

$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$id_client_connecte = $_SESSION['id_client'];

$sql_total_demandes = "SELECT COUNT(id_demande) AS total FROM demande WHERE id_client = $id_client_connecte";
$result_total_demandes = $db->query($sql_total_demandes);

if ($result_total_demandes === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_total_demandes = $result_total_demandes->fetch_assoc();
$total_demandes = $row_total_demandes['total'];

$sql_clients_devis = "SELECT COUNT(id_demande) AS total FROM demande WHERE etat = 'client' AND id_client = $id_client_connecte";
$result_clients_devis = $db->query($sql_clients_devis);

if ($result_clients_devis === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_clients_devis = $result_clients_devis->fetch_assoc();
$total_clients_devis = $row_clients_devis['total'];

$sql_clients_encour = "SELECT COUNT(id_demande) AS total FROM demande WHERE etat = 'encour' AND id_client = $id_client_connecte";
$result_clients_encour = $db->query($sql_clients_encour);

if ($result_clients_encour === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_clients_encour = $result_clients_encour->fetch_assoc();
$total_clients_encour = $row_clients_encour['total'];

$db->close();
?>

<!-- Display the donut chart -->
<div id="donutChart"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
        series: [
            <?php echo $total_clients_devis; ?>,
            <?php echo $total_clients_encour; ?>
        ],
        chart: {
            height: 350,
            type: 'donut',
            toolbar: {
                show: true
            }
        },
        labels: ['Nombre des client', 'Nombre des demandes en cours'],
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return val.toFixed(0);
            }
        }
    }).render();
});
</script>
