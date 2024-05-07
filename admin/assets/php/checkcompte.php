<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the SQL table
$sql = "SELECT * FROM interpret";
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {

        echo "<tr>";
        echo "<th scope='row'><a href='#'>#" . $row['id_interpret'] . "</a></th>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['photo'] . "</td>";

        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['telephone'] . "</td>";
        echo "<td>" . $row['pays'] . "</td>";
        echo "<td>" . $row['association'] . "</td>";
        echo "<td>" . $row['login'] . "</td>";


        echo '<td><button class="btn btn-danger" onclick="deleteRow(\''.$row['id_interpret'].'\')">Supprimer</button></td>'
;

      echo "</tr>";

    }
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
    xhttp.open("POST", "assets/php/delete2.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("delete_id=" + id);
  }
}


