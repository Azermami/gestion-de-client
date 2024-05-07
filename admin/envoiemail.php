<?php
// Remplacez contact@example.com par votre adresse email de réception réelle
$receiving_email_address = 'azermami8@gmail.com';

// Vérifiez si le fichier de la bibliothèque existe
if (file_exists($php_email_form = '../assets/vendor/php-email-form/php-email-form.php')) {
    include($php_email_form);
} else {
    die('Impossible de charger la bibliothèque "PHP Email Form" !');
}

// Crée une instance de la classe PHP_Email_Form
$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Ajoute les informations au message
$contact->add_message($_POST['name'], 'Nom');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

// Essaye d'envoyer l'email et affiche le résultat
echo $contact->send();
?>
