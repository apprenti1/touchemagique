<?php

    namespace Service;
    require_once '../../../../src/service/Authenticator.php';
    require_once '../../../../src/service/Bdd.php';
    use Service\Authenticator;
    use Service\Bdd;
    use PDO;
    if (!Authenticator::isAuthenticated()) {
        header('Location: /template/login');
        exit;
    }
    header('Content-Type: application/json');
    if (isset($_GET['date']) && isset($_GET['type'])) {
        $date = $_GET['date'];
        $bdd = new Bdd();
        // par semaine
        if ($_GET['type'] == "w") {
            $query = $bdd->getConnection()->prepare('SELECT creneaux.id as idcreneau, creneaux.*, utilisateurs.* FROM creneaux LEFT JOIN utilisateurs ON creneaux.id_utilisateur = utilisateurs.id WHERE WEEKOFYEAR(date) = WEEKOFYEAR(:date) ORDER BY date ASC, heure ASC ');
            $query->bindParam(':date', $date, PDO::PARAM_STR);
            $query->execute();
            $creneaux = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($creneaux);
        }
        // par jours
        else if ($_GET['type'] == "d") {
            $query = $bdd->getConnection()->prepare('SELECT creneaux.id as idcreneau, creneaux.*, utilisateurs.* FROM creneaux left join utilisateurs on creneaux.id_utilisateur = utilisateurs.id WHERE date = :date ORDER BY date ASC');
            $query->bindParam(':date', $date, PDO::PARAM_STR);
            $query->execute();
            $creneaux = $query->fetchAll(PDO::FETCH_ASSOC);
            echo json_encode($creneaux);
        }
    }
    else if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $bdd = new Bdd();
        $query = $bdd->getConnection()->prepare('SELECT creneaux.id as idcreneau, creneaux.*, utilisateurs.* FROM creneaux LEFT JOIN utilisateurs ON creneaux.id_utilisateur = utilisateurs.id WHERE creneaux.id = :id');
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $creneaux = $query->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($creneaux);
    }
?>