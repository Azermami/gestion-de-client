<?php
// Check if the "Valider" button was clicked
if (isset($_POST['valider'])) {
    // Connect to the database
    $conn = mysqli_connect('localhost', 'root', '', 'sourd');
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Get the selected interpreter ID and demande ID from the form data
    $id_interpret = $_POST['id_interpret'];
    $id_demande = $_POST['id_demande'];

    // Insert a new row into the affectation table with the selected interpreter ID and demande ID
    $sql = "INSERT INTO `affectation`(`id_demande`, `id_interpret`, `date_affectation`, `etat`, `video_recu`) VALUES ('$id_demande', '$id_interpret', NOW(), 'En cours', 'vide')";
    if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
