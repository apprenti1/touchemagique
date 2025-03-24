<?php
require_once '../../src/service/Authenticator.php';
use Service\Authenticator;
if (Authenticator::isAuthenticated()) {
    header('Location: /template/admin/');
    exit();
}
else {
    if (isset($_POST['login']) && isset($_POST['password'])) {
        if (Authenticator::authenticate($_POST['login'], $_POST['password'])) {
            header('Location: /template/admin/');
            exit();
        }
        else {
            $error = 'Login ou mot de passe incorrect';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4">
                <div class="d-flex justify-content-center align-items-center flex-column text-center">
                    <h2 class="card-title">Connexion</h2>
                    <?php
                    if (isset($error)) {
                        echo '<div class="alert alert-danger">' . $error . '</div>';
                    }
                    ?>
                    <form action="" class="p-2" method="post">
                        <div class="form-group mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" id="login" class="form-control">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input type="password" name="password" id="password" class="form-control">
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <button type="submit" class="btn btn-primary m-2 p-2">Connexion</button>
                            <a href="../../" class="btn btn-secondary m-2 p-2">Retour</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</form>
</body>
</html>


