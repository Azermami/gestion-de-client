<?php
$id_interpret = '';
if (isset($_POST['remplir_id'])) {
    // Fetch data from the SQL table
    $sql = "SELECT * FROM interpret";

    $result = mysqli_query($conn, $sql);

    // Output the data as an HTML table
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {
            if  ($row['id_interpret'] == $_POST['remplir_id']) {

            $id_interpret =   $row['id_interpret'];
            $nom =$row['nom'];
            $prenom =$row['prenom'];
            $photo =$row['photo'];
            $email =$row['email'];
            $telephone =$row['telephone'];
            $pays =$row['pays'];
            $association =$row['association'];
            $login =$nom.$prenom;
            $mot_de_passe =$row['password'];
        } }
    } else {
        echo "<tr><td colspan='5'>Aucune demande trouvée.</td></tr>";
    }
}
