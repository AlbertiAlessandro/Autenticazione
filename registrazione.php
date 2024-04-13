<?php
require 'vendor/autoload.php';

use Model\UserRepository;

$template = new League\Plates\Engine('templates', 'tpl');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['email'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Esegui la registrazione
    UserRepository::registrazione($email, $username, $password);

    // Reindirizza alla pagina di successo
    header("Location: success.php");
    exit(); // Assicura che lo script termini dopo il reindirizzamento
}

echo $template->render('registrazione', []);
