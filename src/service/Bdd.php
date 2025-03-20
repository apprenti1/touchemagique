<?php
namespace Service;
require_once $_SERVER['DOCUMENT_ROOT'] . '/' . 'vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
use PDO;
use PDOException;

class Bdd
{
    public static function getConnection()
    {
        $dotenv = new Dotenv();
        $dotenv->usePutenv()->load(__DIR__ . '/../../.env');

        $dsn = "mysql:host=" . $_ENV['DB_HOST'] . ";port=" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'];
        $username = $_ENV['DB_USER'];
        $password = $_ENV['DB_PASSWORD'];

        try {
            return new PDO($dsn, $username, $password);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}

