<?php

$conn = mysqli_connect('localhost', 'root', '', 'sourd');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql1 = " DELETE FROM affectation WHERE id_demande = $delete_id";
    $sql2 = "DELETE FROM demande WHERE id_demande=$delete_id";


    mysqli_query($conn, $sql1);

    mysqli_query($conn, $sql2);
}

mysqli_close($conn);
header('Location: ../../index.php');

?>
