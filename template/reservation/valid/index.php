<?php
require_once '../../../src/service/Bdd.php';
use Service\Bdd;
$bdd = new Bdd();
$errors = [];
$date;
$id;
$nom;
$email;
$tel;
$type;
$creneau;
    session_start();
    if (isset($_POST['date']) && isset($_POST['creneau']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['tel'])) {
        $id = $_POST['creneau'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $tel = $_POST['tel'];
        $type = $_POST['typeDeSoin'];
        
        
        $query = $bdd->getConnection()->prepare("SELECT * FROM creneaux WHERE id = :id");
        $query->execute(['id' => $id]);
        $creneau = $query->fetch( PDO::FETCH_ASSOC );
        $_SESSION['post'] = $_POST;
        
        if ($creneau && $creneau['id_utilisateur'] == NULL) {
            if (!preg_match('/^\+?[0-9]{10,15}$/', $tel)) {
                $errors[] = 'le numéro de téléphone est incorrect';
                $_SESSION['errors'] = $errors;
                header('Location: ../../../template/reservation/');
                exit;
            }
            else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'l\'email est incorrect';
                $_SESSION['errors'] = $errors;
                header('Location: ../../../template/reservation/');
                exit;
            }
            else {
                $query = $bdd->getConnection()->prepare("SELECT * FROM utilisateurs WHERE tel = :tel");
                $query->execute(['tel' => $tel]);
                $user = $query->fetch( PDO::FETCH_ASSOC );
                if (!$user) {
                    $query = $bdd->getConnection()->prepare("INSERT INTO utilisateurs (nom, email, tel) VALUES (:nom, :email, :tel)");
                    $query->execute(['nom' => $nom, 'email' => $email, 'tel' => $tel]);
                    $user['id'] = $bdd->getConnection()->lastInsertId();
                }
                $user['nom'] = $nom;
                $user['email'] = $email;
                $user['tel'] = $tel;

                $query = $bdd->getConnection()->prepare("UPDATE creneaux SET id_utilisateur = :id_utilisateur, id_type = :type, valide = 1, etat = 'Reserve' WHERE id = :id");
                $query->execute(['id_utilisateur' => $user['id'], 'id' => $id, 'type' => $type]);
                unset($_SESSION['post']);
                $query = $bdd->getConnection()->prepare("SELECT * FROM type WHERE id = :type");
                $query->execute(['type' => $type]);
                $type = $query->fetch( PDO::FETCH_ASSOC );
            }

        }
        else {
            $errors[] = 'Ce creneau est deja pris';
            $_SESSION['errors'] = $errors;
            header('Location: ../../../template/reservation/');
            exit;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>

        <style>
            @font-face {
                font-family: Outfit;
                font-style: normal;
                font-weight: 400;
                font-display: fallback;
                src: url("/assets/images/Outfit-VariableFont_wght.ttf") format("truetype");
                font-stretch: normal;
            }

            @font-face {
                font-family: Outfit;
                font-style: bold;
                font-weight: 400;
                font-display: fallback;
                src: url("/assets/images/Outfit-VariableFont_wght.ttf") format("truetype");
                font-stretch: normal;
            }
            * {
                font-family: "Outfit", sans-serif;
            }
            html {
                scroll-behavior: smooth;
            }

            @media(min-width: 767px) {
                .w-md-25 {
                    width: 25% !important;
                }
            }

            a {
                text-decoration: none;
                color: inherit;
                filter: opacity(1) contrast(1);
            }
            a:hover {
                filter: opacity(0.8) contrast(1.5);
                color: #702060 !important;
                background-color: #6fafa2 !important;
                transition: 0.5s all 0.05s;
            }

            @media(min-width: 767px) {
                .w-md-35 {
                    width: 35% !important;
                }
                .fs-md-3rem {
                    font-size: 3rem !important;
                }
                .rounded-md-4 {
                    border-radius: 1rem !important;
                }
            }
            input[type="radio"] ~ label {
                transition: 0.5s all 0.05s;
                background: var(--bs-gray-200);
            }
            input[type="radio"]:checked ~ label {
                transition: 0.5s all 0.05s;
                background: linear-gradient(135deg, rgb(176, 56, 155) 1%, rgb(42, 156, 131) 100%);
            }
        </style>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"/>
    </head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 flex-column">
        <img src="/assets/images/cropped-Logo-Touche-Magique.jpeg" class="w-75 w-md-25" alt="logo">
        <div class="w-100 w-md-50 bg-white rounded-4 p-4">
            <h3 class="text-center fw-bold">Merci pour votre reservation</h3>
            <p class="text-center">Vous avez reserve un creneau le <span class="fw-bold"><?= date('d/m/Y', strtotime($creneau['date'])) ?></span> a <span class="fw-bold"><?= date('H', strtotime($creneau['heure'])).'h'.date('i', strtotime($creneau['heure'])) ?></span> pour <br> un soin: <span class="fw-bold"><?= $type['libelle'] ?></span>.</p>
            <p class="text-center">Voici les informations de la réservation:</p>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">Nom: <span class="fw-bold"><?= $nom ?></span></li>
                <li class="list-group-item">Telephone: <span class="fw-bold"><?= $tel ?></span></li>
                <li class="list-group-item">Email: <span class="fw-bold"><?= $email ?></span></li>
                <li class="list-group-item">Type de soin: <span class="fw-bold"><?= $type['libelle'] ?>€</span></li>
                <li class="list-group-item">Date: <span class="fw-bold"><?= date('d/m/Y', strtotime($creneau['date'])) ?></span></li>
                <li class="list-group-item">Heure: <span class="fw-bold"><?= date('H', strtotime($creneau['heure'])).'h'.date('i', strtotime($creneau['heure'])) ?></span></li>
                <li class="list-group-item">Cout: <span class="fw-bold"><?= $type['prix'] ?>€</span></li>
            </ul>
            <p class="text-center">L'adresse du salon est: <span class="fw-bold"><a href="https://www.google.com/maps/search/?api=1&query=monaddresse" target="_blank" class="text-decoration-none">monaddresse</a></span></p>
            <p class="text-center">Pour toutes annulations/effacement des données <br> merci d'appeler le: <span class="fw-bold">0606060606</span></p>
            
            <div class="d-flex justify-content-center">
                <a href="../../../" class="btn btn-outline-dark">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>