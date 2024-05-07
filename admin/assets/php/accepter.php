<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $id_demande = $_POST['id_demande'];
    $date_ajout = $_POST['date_ajout'];
    $id_interpret = $_POST['interpert'];
        $etat="sent";
        $video_recu = "aa";

        $mot = $_POST['mot'];
     $id_parent = $_POST['id_parent'];






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
    // Step 3: Insert data into MySQL database
    $sql = "INSERT INTO affectation (id_demande, id_interpret, date_affectation, etat, video_recu)
    VALUES ('$id_demande','$id_interpret', '$date_ajout', '$etat', '$video_recu')";

$sql2 = "update demande set statut ='en cours' where id_demande= $id_demande " ;

if ($conn->query($sql2) === TRUE) {
    echo "New record update successfully";
  } else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
  }

    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Step 4: Close the database connection
    $conn->close();

    header('Location: ../../index.php');



}

?>
