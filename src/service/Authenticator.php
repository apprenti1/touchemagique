<?php

namespace Service;
require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'src/service/Bdd.php';
use Symfony\Component\Dotenv\Dotenv;
use Service\Bdd;
session_start();

class Authenticator
{
    public static function generateToken(): string
    {
        return bin2hex(random_bytes(32));
    }
    public static function authenticate(string $username, string $password): bool
    {

        $dotenv = new Dotenv();
        $dotenv->usePutenv()->load($_SERVER['DOCUMENT_ROOT'] . '/' . '.env');   

        $usernameref = $_ENV['LOGIN'];
        $passwordref = $_ENV['PASSWORD'];
        $bdd = new Bdd();
        if (password_verify($username, $usernameref) && password_verify($password, $passwordref)) {
            $_SESSION['token'] = self::generateToken();
            $req = $bdd->getConnection()->prepare('INSERT INTO connexion (token, date_connexion) VALUES (:token, NOW())');
            $req->execute(['token' => $_SESSION['token']]);
            return true;
        }
        else {
            if (session_status() == PHP_SESSION_ACTIVE) {
                session_destroy();
            }
            $req = $bdd->getConnection()->prepare('INSERT INTO connexion (token, date_connexion) VALUES (:token, NOW())');
            $req->execute(['token' => null]);
            return false;
        }
    }
    public static function isAuthenticated(): bool
    {
        if (isset($_SESSION['token'])) {
            $bdd = new Bdd();
            $req = $bdd->getConnection()->prepare('SELECT token FROM connexion WHERE token = :token AND date_connexion > DATE_SUB(CURDATE(), INTERVAL 3 DAY)');
            $req->execute(['token' => $_SESSION['token']]);
            if ($req->rowCount() == 0) {
                session_destroy();
                return false;
            }
            else {
                return true;
            }
        }
        else {
            return false;
        }
    }
}
