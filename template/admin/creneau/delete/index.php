<?php
    namespace Service;
    require_once '../../../../src/service/Authenticator.php';
    require_once '../../../../src/service/Bdd.php';
    use Service\Authenticator;
    use Service\Bdd;

    if (!Authenticator::isAuthenticated()) {
        header('Location: ../../../../template/login/');
        exit;
    }
    if (isset($_POST['id'])) {
        $bdd = new Bdd();
        $query = $bdd->getConnection()->prepare('DELETE FROM creneaux WHERE id = :id');
        $query->execute(['id'=>$_POST['id']]);
        header('Location: ../../../../template/admin/creneau');
        exit;
    }
