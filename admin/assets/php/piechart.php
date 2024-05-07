<?php
// connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sourd";
$conn = mysqli_connect($servername, $username, $password, $dbname);

// check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// retrieve the number of affectations in each state
$sql = "SELECT
          SUM(CASE WHEN etat='sent' THEN 1 ELSE 0 END) AS envoyees,
          SUM(CASE WHEN etat='received' THEN 1 ELSE 0 END) AS recues,
          SUM(CASE WHEN etat='validate' THEN 1 ELSE 0 END) AS validees
        FROM affectation";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$envoyees = $row['envoyees'];
$recues = $row['recues'];
$validees = $row['validees'];

// close the database connection
mysqli_close($conn);
?>

<!-- display the pie chart using ApexCharts -->
<div id="pieChart"></div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#pieChart"), {
      series: [<?= $envoyees ?>, <?= $recues ?>, <?= $validees ?>],
      chart: {
        height: 350,
        type: 'pie',
        toolbar: {
          show: true
        }
      },
      labels: ['Affectations envoyées', 'Affectations reçues', 'Affectations validées',]
    }).render();
  });
</script