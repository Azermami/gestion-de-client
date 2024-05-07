<?php
// Establish a database connection
$conn = mysqli_connect('localhost', 'root', '', 'sourd');


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Query to retrieve the interpretes
$sql = "SELECT id_interpret, tag  FROM signe";

$result = mysqli_query($conn, $sql);

// Generate the options for the select element
$options = "";
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    echo '<option value = "' . $row["id_signe"] . '">' . $row["tag"] . ' </option>';
  }
}

// Close the database connection
mysqli_close($conn);
?>


