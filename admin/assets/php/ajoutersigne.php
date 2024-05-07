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

$inputMotArabe = $_POST['inputMotArabe'];
$inputMotFrancais = $_POST['inputMotFrancais'];
$inputimage = "assets/img/portfolio/".$_POST['inputimage'];
$inputVideo ="assets/video/". $_POST['inputVideo'];
$idinterpret = $_POST['idinterpret'];
$inputtag = $_POST['inputtag'];

// Step 3: Insert data into MySQL database
$sql = "INSERT INTO signe (mot_ar, mot_fr, image, video, tag, id_interpret)
VALUES ('$inputMotArabe', '$inputMotFrancais', '$inputimage', '$inputVideo', '$inputtag', '$idinterpret ')";


if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

// Step 4: Close the database connection
$conn->close();
header('Location: ../../Ajout_sign.php');

?>
