<?php
// Step 1: Create a database connection
$servername = "localhost"; // Replace with your server name
$username = "root"; // Replace with your database username
$password = ""; // Replace with your database password
$dbname = "sourd"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Step 2: Retrieve data from the form
$IDinter = $_POST['IDinter'];
$nom = $_POST['inputNom'];
$prenom = $_POST['Prenom'];
$email = $_POST['email'];
$telephone = $_POST['inputNumber'];
$mot_de_passe = $_POST['password'];
$photo = $_POST['formFile'];
$pays = $_POST['inputpays'];
$association = $_POST['inputassociation'];
$telephone = $_POST['inputNumber'];
$login=$nom.$prenom;
// Step 3: Insert data into MySQL database
$sql = "INSERT INTO interpret (id_interpret,nom, prenom, photo, email, telephone, pays, association,login, mot_de_passe)
VALUES ('$IDinter','$nom', '$prenom', '$photo', '$email', '$telephone', '$pays', '$association', '$login', '$mot_de_passe')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Step 4: Close the database connection
$conn->close();
header('Location: ../../creation_compte_inter.php');

?>
