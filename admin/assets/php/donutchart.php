<?php
// Connect to your database
$db = new mysqli('localhost', 'root', '', 'sourd');

// Fetch the data from the signe table
$sql = "SELECT tag, COUNT(*) as total FROM signe GROUP BY tag";
$result = $db->query($sql);

// Compute the percentage for each tag
$tags = array();
$total = 0;
while ($row = $result->fetch_assoc()) {
    $tags[$row['tag']] = $row['total'];
    $total += $row['total'];
}

$percentages = array();
foreach ($tags as $tag => $count) {
    $percentages[$tag] = round($count / $total * 100, 2);
}

// Create the data for the donut chart
$labels = array_keys($percentages);
$values = array_values($percentages);

// Convert the data to JSON format
$labels_json = json_encode($labels);
$values_json = json_encode($values);
?>

<!-- Display the donut chart -->
<div id="donutChart"></div>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    new ApexCharts(document.querySelector("#donutChart"), {
      series: <?php echo $values_json ?>,
      chart: {
        height: 350,
        type: 'donut',
        toolbar: {
          show: true
        }
      },
      labels: <?php echo $labels_json ?>,
    }).render();
  });
</script>
