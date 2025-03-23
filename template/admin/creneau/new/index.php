<?php
require_once '../../../../src/service/Authenticator.php';
use Service\Bdd;
use Service\Authenticator;
if (!Authenticator::isAuthenticated()) {
    header('Location: /template/login');
    exit;
}
if (isset($_POST['date']) && isset($_POST['heure']) && isset($_POST['duree'])) {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $duree = $_POST['duree'];
    
    $bdd = new Bdd();
    $query = $bdd->getConnection()->prepare('SELECT * FROM creneaux WHERE date = :date AND (:heure BETWEEN heure AND ADDTIME(heure, SEC_TO_TIME(duree * 60)))');
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':heure', $heure, PDO::PARAM_STR);
    $query->execute();
    if ($query->fetch()) {
        echo 'Ce créneau existe déjà';
    } else {
    $bdd = new Bdd();
    $query = $bdd->getConnection()->prepare('INSERT INTO creneaux (date, heure, duree, id_utilisateur) VALUES (:date, :heure, :duree, NULL)');
    $query->bindParam(':date', $date, PDO::PARAM_STR);
    $query->bindParam(':heure', $heure, PDO::PARAM_STR);
    $query->bindParam(':duree', $duree, PDO::PARAM_INT);
    $query->execute();
    header('Location: ../');
    exit;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Créneau</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center text-center p-5">
        <div class="d-flex flex-column justify-content-center align-items-center" style="width: fit-content;">
            <h1>Nouveau Créneau</h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" value="<?= isset($_POST['date']) ? $_POST['date'] : ''?>" id="date" name="date" required>
                </div>
                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="text" class="form-control" id="heure" name="heure" placeholder="HH:MM" step="900" value="<?= isset($_POST['heure']) ? $_POST['heure'] : ''?>" required pattern="[0-2][0-9]:[0-5][0-9]">
                    
                </div>
                <div class="mb-3">
                    <label for="duree" class="form-label">Durée (min)</label>
                    <input type="number" class="form-control" id="duree" name="duree" min="1" value="<?= isset($_POST['duree']) ? $_POST['duree'] : 30?>" required>
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