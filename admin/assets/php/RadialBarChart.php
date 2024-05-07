<?php

// Your database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sourd";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Query the database to get the total number of signe
$sql_signe = "SELECT COUNT(*) AS total_signe FROM signe";
$result_signe = $conn->query($sql_signe);
$row_signe = $result_signe->fetch_assoc();
$total_signe = $row_signe['total_signe'];

// Query the database to get the total number of interpret
$sql_interpret = "SELECT COUNT(*) AS total_interpret FROM interpret";
$result_interpret = $conn->query($sql_interpret);
$row_interpret = $result_interpret->fetch_assoc();
$total_interpret = $row_interpret['total_interpret'];

// Query the database to get the total number of parent
$sql_parent = "SELECT COUNT(*) AS total_parent FROM parent";
$result_parent = $conn->query($sql_parent);
$row_parent = $result_parent->fetch_assoc();
$total_parent = $row_parent['total_parent'];

// Output the chart code
echo <<<EOT
<!-- Radial Bar Chart -->
<div id="radialBarChart"></div>
<script>
  document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#radialBarChart"), {
      series: [$total_signe, $total_interpret, $total_parent],
      chart: {
        height: 350,
        type: 'radialBar',
        toolbar: {
          show: true
        }
      },
      plotOptions: {
        radialBar: {
          dataLabels: {
            name: {
              fontSize: '22px',
            },
            value: {
              fontSize: '16px',
              formatter: function(val) {
                return val;
              }
            },
            total: {
              show: true,
              label: 'Total',
              formatter: function(w) {
                return [$total_signe, $total_interpret, $total_parent].reduce((a,b) => a+b, 0);
              }
            }
          }
        }
      },
      labels: ['Total des signes', 'Total des interprètes', 'Total des parents'],
    }).render();
  });
</script>
<!-- End Radial Bar Chart -->
EOT;

// Close the database connection
$conn->close();

?>
