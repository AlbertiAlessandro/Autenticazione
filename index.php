<?php
require 'vendor/autoload.php';

use Model\UserRepository;

$template = new League\Plates\Engine('templates', 'tpl');

// Controlla se sono stati inviati dati dal modulo di accesso
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Se le credenziali sono corrette, reindirizza alla stessa pagina
    if (UserRepository::verificaCredenziali($username, $password)) {
        // Avvia la sessione per memorizzare lo stato di accesso
        session_start();
        $_SESSION['username'] = $username;

        // Reindirizza alla stessa pagina
        header("Location: success.php");
        exit();
    } else {
        // Se le credenziali non sono corrette, mostra un messaggio di errore
        echo $template->render('login', [
            'error' => 'Credenziali non valide. Riprova.'
        ]);
        exit();
    }
} else {
    // Se non sono stati inviati dati dal modulo di accesso, mostra il modulo di accesso
    echo $template->render('login', [

    ]);
}
