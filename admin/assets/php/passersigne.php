<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $inputid_interpete=$_POST['id_interpret'];
    $inputid_demande = $_POST['id_demande'];

    echo $inputid_interpete;
    echo $inputid_demande;
    //header('Location: ../../Ajout_signe.php');



}

