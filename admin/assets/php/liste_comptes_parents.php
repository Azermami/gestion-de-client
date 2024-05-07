<?php

// Connect to the database
$conn = mysqli_connect('localhost', 'root', '', 'sourd');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch data from the SQL table
$sql = "SELECT * FROM parent";
$result = mysqli_query($conn, $sql);

// Output the data as an HTML table
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<th scope='row'><a href='#'>#" . $row['id_parent'] . "</a></th>";
        echo "<td>" . $row['nom'] . "</td>";
        echo "<td>" . $row['prenom'] . "</td>";
        echo "<td>" . $row['e-mail'] . "</td>";
        echo "<td>" . $row['telephone'] . "</td>";
        echo "<td>" . $row['image'] . "</td>";
        echo "<td>" . $row['login'] . "</td>";
        echo "<td>" . $row['mot_de_passe'] . "</td>";

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
