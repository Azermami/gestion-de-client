
<?php

$conn = mysqli_connect('localhost', 'root', '', 'sourd');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


if (isset($_POST['validate_id'])) {
    // Code to update the etat field in the database
    $id = $_POST['validate_id'];
    $sql = "UPDATE affectation SET etat='validate' WHERE id_demande=$id";
    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}

mysqli_close($conn);

?>
