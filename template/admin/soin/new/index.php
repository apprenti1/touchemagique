<?php
require_once '../../../../src/service/Authenticator.php';
use Service\Bdd;
use Service\Authenticator;
if (!Authenticator::isAuthenticated()) {
    header('Location: /template/login/');
    exit;
}
if (isset($_POST['libelle']) && isset($_POST['prix'])) {

    
    $libelle = $_POST['libelle'];
    $prix = $_POST['prix'];

    $bdd = new Bdd();
    $query = $bdd->getConnection()->prepare('INSERT INTO type (libelle, prix) VALUES (:libelle, :prix)');
    $query->bindParam(':libelle', $libelle, PDO::PARAM_STR);
    $query->bindParam(':prix', $prix, PDO::PARAM_STR);
    $query->execute();
    header('Location: ../');
    exit;
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Soin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center text-center p-5">
        <div class="d-flex flex-column justify-content-center align-items-center" style="width: fit-content;">
            <h1>Nouveau Soin</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="libelle" class="form-label">Libelle</label>
                    <input type="text" class="form-control" id="libelle" name="libelle" placeholder="" value="<?= isset($_POST['libelle']) ? $_POST['libelle'] : ''?>" required>
                    
                </div>
                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input type="number" class="form-control" id="prix" name="prix" step="0.01" value="<?= isset($_POST['prix']) ? $_POST['prix'] : ''?>" required>
                </div>
                <div class="row justify-content-center">
                <button type="submit" class="m-2 btn btn-primary" style="width: fit-content">Créer</button>
                <a href="../" class="m-2 btn btn-secondary" style="width: fit-content">
                    <i class="bi bi-arrow-left"></i> Retour
                </a>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>