<?php
$db = new mysqli('localhost', 'root', '', 'gestion_client');

if ($db->connect_errno) {
    echo "Failed to connect to MySQL: " . $db->connect_error;
    exit();
}

$sql_stat_demande_projet = "SELECT p.libelle, COUNT(d.id_demande) AS total_demandes
                            FROM projet p
                            LEFT JOIN demande d ON p.id_projet = d.id_projet
                            GROUP BY p.libelle";

$result_stat_demande_projet = $db->query($sql_stat_demande_projet);
if ($result_stat_demande_projet === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$stat_demande_projet_data = array();

// Fetching and storing the result in an associative array
while ($row_stat_demande_projet = $result_stat_demande_projet->fetch_assoc()) {
    $libelle = $row_stat_demande_projet['libelle'];
    $total_demandes = $row_stat_demande_projet['total_demandes'];

    // Storing the data in the associative array
    $stat_demande_projet_data[$libelle] = $total_demandes;
}

// Statistiques du nombre de demandes avec l'état "devis"
$sql_stat_demande_devis = "SELECT COUNT(id_demande) AS total_devis
                           FROM demande
                           WHERE etat = 'devis'";

$result_stat_demande_devis = $db->query($sql_stat_demande_devis);

if ($result_stat_demande_devis === false) {
    echo "Error executing query: " . $db->error;
    exit();
}

$row_stat_demande_devis = $result_stat_demande_devis->fetch_assoc();
$total_demande_devis = $row_stat_demande_devis['total_devis'];

$db->close();
?>

<!-- Affichage du graphique en barres pour les statistiques des demandes par projet -->
<div id="barChart"></div>

<!-- Affichage du nombre de demandes avec l'état "devis" -->
<div>
    <h3>Statistiques pour les demandes avec l'état "devis"</h3>
<p>Nombre de demandes avec l'état "devis" : <span style="color: red; font-weight: bold; font-size: 25px;"><?php echo $total_demande_devis; ?></span></p>

</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#barChart"), {
        series: [{
            data: <?php echo json_encode(array_values($stat_demande_projet_data)); ?>
        }],
        chart: {
            height: 350,
            type: 'bar',
            toolbar: {
                show: true
            }
        },
        xaxis: {
            categories: <?php echo json_encode(array_keys($stat_demande_projet_data)); ?>
        }
    }).render();
});
</script>
