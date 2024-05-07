<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the SQL table
$sql = "SELECT * FROM demande where statut = 'en cours' " ;
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo " <form method='POST' action='assets/php/accepter.php'>";
        echo '';

        echo "<th scope='row'>  ".$row['id_demande']." <input type='hidden' name='id_demande' value= '".$row['id_demande']."'  ></th>";
        echo "<td>  ".$row['mot']." <input type='hidden' name='mot' value= '".$row['mot']."'  ></td>";
        echo "<td>  ".$row['date_ajout']." <input type='hidden' name='date_ajout' value= '".$row['date_ajout']."'  ></td>";
        echo "<td>  ".$row['id_parent']." <input type='hidden' name='id_parent' value= '".$row['id_parent']."'  ></td>";
        echo "<td><span class='badge bg-" . ($row['statut'] == 'en cours' ? 'success' : ($row['statut'] == 'accompli' ? 'warning' : 'danger')) . "'>" . $row['statut'] . "</span></td>";


       echo "</form>";





      //  echo '<td><button type="submit" class="btn btn-primary">Accepter</button></td>';
       // echo '<td><button  class="btn btn-primary" onclick="deleteRow('.$row['id_demande'].')">Supprimer</button></td>';
        echo "</form>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>Aucune demande trouvée.</td></tr>";
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
}




</script>