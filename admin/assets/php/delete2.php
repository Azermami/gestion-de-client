<?php

$conn = mysqli_connect('localhost', 'root', '', 'sourd');
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM interpret WHERE id_interpret=$delete_id";
    mysqli_query($conn, $sql);
}

mysqli_close($conn);

?>

