<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the validate button was clicked
if (isset($_GET['id_dema'])) {
    $id_demande = $_GET['id_dema'];
    $sql = "UPDATE affectation SET etat='validate' WHERE id_demande=$id_demande";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

// Fetch data from the SQL table
$sql = "SELECT * FROM affectation";
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        if ($row['etat'] == 'received') {
            echo "<th scope='row'><a href='#'>#" . $row['id_demande'] . "</a></th>";
            echo "<td>" . $row['id_interpret'] . "</td>";
            echo "<td>" . $row['video_recu'] . "</td>";
            echo "<td>" . $row['date_affectation'] . "</td>";
            echo "<td><span class='badge bg-success'>" . $row['etat'] . "</span></td>";
            echo "<td><button class='btn btn-danger' onclick='deleteRow(".$row['id_demande'].")'>Supprimer</button></td>";
            echo "<td><button class='btn btn-primary '>Visualiser</button></td>";
            echo '<td><a href="a_recu.php?id_dema=' . $row['id_demande'] . '"><button type="button" class="btn btn-primary">Valider</button></a></td>';

        }
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
}

// Close the database connection
mysqli_close($conn);

?>
