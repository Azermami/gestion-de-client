<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the SQL table
$sql = "SELECT * FROM affectation";
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        if ($row['etat'] == 'sent') {
        echo "<tr>";
        echo "<th scope='row'><a href='#'>#" . $row['id_demande'] . "</a></th>";
        echo "<td>" . $row['id_interpret'] . "</td>";
        echo "<td>" . $row['video_recu'] . "</td>";
        echo "<td>" . $row['date_affectation'] . "</td>";

        echo "<td><span class='badge bg-" . ($row['etat'] == 'received' ? 'success' : ($row['etat'] == 'Pending' ? 'warning' : 'danger')) . "'>" . $row['etat'] . "</span></td>";
        echo "<td><button class='btn btn-danger' onclick='deleteRow(".$row['id_demande'].")'>Supprimer</button></td>";

        echo "</tr>";
    }}
} else if  (!$result) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
  }else {
    echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
}


// Close the database connection
mysqli_close($conn);

?>
<script>
function deleteRow(id) {
  if (confirm("Voulez-vous vraiment supprimer cette ligne?")) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var row = document.getElementById("row-" + id);
        row.parentNode.removeChild(row);
      }
    };
    xhttp.open("POST", "assets/php/delete3.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("delete_id=" + id);
  }
}</script>