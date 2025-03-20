<?php
require_once '../../vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->usePutenv()->load(__DIR__ . '/../../.env');
if (!isset($_ENV['LOGIN']) || !isset($_ENV['PASSWORD']) || $_ENV['LOGIN'] == '' || $_ENV['PASSWORD'] == '') {
    ?>
    <form action="" method="post">
        <label for="login">Login</label>
        <input type="text" name="login" id="login"><br>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password"><br>
        <input type="submit" value="Enregistrer">
    </form>
    <?php
    if (isset($_POST['login']) && isset($_POST['password'])) {
        $loginHash = str_replace('$', '\$', password_hash( $_POST['login'], PASSWORD_DEFAULT));
        $passwordHash = str_replace('$', '\$', password_hash( $_POST['password'], PASSWORD_DEFAULT));
        file_put_contents(__DIR__ . '/../../.env', "\nLOGIN=\"$loginHash\"\nPASSWORD=\"$passwordHash\"\n", FILE_APPEND);
        header('Location: ../../');
        exit();
    }
} else {
    header('Location: ../../');
    exit();
}
