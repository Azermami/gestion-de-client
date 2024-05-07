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
        echo " <form method='POST' action='Ajout_sign_copy.php'>";

        echo "<tr>";
        if ($row['etat'] == 'validate') {
            echo "<th scope='row'>  ".$row['id_demande']." <input type='hidden' name='id_demande' value= '".$row['id_demande']."'  ></th>";
            echo "<td>  ".$row['id_interpret']." <input type='hidden' name='id_interpret' value= '".$row['id_interpret']."'  ></td>";

            echo "<td>  ".$row['video_recu']." <input type='hidden' name='video_recu' value= '".$row['video_recu']."'  ></td>";

            echo "<td>" . $row['date_affectation'] . "</td>";
            echo "<td><span class='badge bg-success'>" . $row['etat'] . "</span></td>";
            echo "<td><button class='btn btn-primary '>Passer à signe</button></td>";

        }
        echo "</tr>";        echo "</form>";

    }
} else {
    echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
}

// Close the database connection
mysqli_close($conn);

?>
