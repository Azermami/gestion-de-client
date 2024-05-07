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

// Query the database
$sql = "SELECT tag, COUNT(*) AS count FROM signe GROUP BY tag ORDER BY id_signe ASC" ;
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
  $result = $stmt->get_result();

  // Prepare the data for the bar chart
  $data = array();
  while ($row = $result->fetch_assoc()) {
    $data[] = $row['count'];}
    $data_str = implode(',', $data);
  // Output the chart code
  echo <<<EOT
                                                <div id="barChart"></div>
                                                <script>
                                                 document.addEventListener("DOMContentLoaded", () => {
                                                new ApexCharts(document.querySelector("#barChart"), {
                                                    series: [{
                                                      data: [${data_str}]
                                                    }],
                                                    chart: {
                                                        type: 'bar',
                                                        height: 350
                                                    },
                                                    plotOptions: {
                                                        bar: {
                                                            borderRadius: 4,
                                                            horizontal: true,
                                                        }
                                                    },
                                                    dataLabels: {
                                                        enabled: false
                                                    },
                                                    xaxis: {
                                                        categories: [
            EOT;


  // Query the database again to get the unique tag values
  $sql = "SELECT DISTINCT tag FROM signe";
  $stmt = $conn->prepare($sql);
  if ($stmt->execute()) {
    $result = $stmt->get_result();

    // Prepare the tag values for the chart
    $tags = array();
    while ($row = $result->fetch_assoc()) {
      $tags[] = $row['tag'];
    }
    echo "'" . implode("', '", $tags) . "'],";
  }

  echo <<<EOT
                                                },
                                            }, {
                                                title: {
                                                    text: 'Number of signes'
                                                },
                                                yaxis: {
                                                    title: {
                                                        text: 'Number of signes'
                                                    }
                                                },
                                                colors: ['#008FFB', '#00E396', '#FEB019', '#FF4560', '#775DD0']
                                            }).render();
                                        });
                                        </script>
  <!-- End Bar Chart -->
  EOT;

  $stmt->close();
} else {
  // Handle errors here
  echo "Error executing query: " . $stmt->error;
}

// Close the database connection
$conn->close();

?>
