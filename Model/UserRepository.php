<?php

namespace Model;
use Util\Connection;

class UserRepository
{
    public static function verificaCredenziali($username, $password): bool
    {
        $pdo = Connection::getInstance();
        $sql = 'SELECT password, username
            FROM user 
            WHERE username = :username';
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['username' => $username]);
        $result = $stmt->fetch();

        // Se non viene trovato alcun utente con lo username fornito
        if (!$result) {
            return false;
        }

        // Verifica se la password fornita corrisponde all'hash memorizzato nel database
        if (password_verify($password, $result['password'])) {
            return true;
        } else {
            return false;
        }
    }



    public static function registrazione($email, $username, $password)
    {
        $pdo = Connection::getInstance();
        $sql = 'INSERT INTO user(username, password, email) 
            VALUES (:username, :password, :email)';
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':email' => $email,
            ':username' => $username,
            ':password' => $password
        ]);

    }




}
