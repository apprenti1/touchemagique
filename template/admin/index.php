<?php
namespace Service;
require_once '../../src/service/Authenticator.php';
use Service\Authenticator;
if (!Authenticator::isAuthenticated()) {
    header('Location: /template/login/');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pannel admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <style>
        a {
            transition: 0.5s all 0s;
        }
        a:hover {
            filter: opacity(0.8) contrast(1.5);
            color: #702060 !important;
            background-color: #6fafa2 !important;
        }
        h2{
            text-align: center;
            font-weight: bold;
        }
        .text-size-5 {
            font-size: 5rem;
        }
        @media (min-width: 767px) {
            .text-size-md-8 {
                font-size: 8rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row m-5 justify-content-center align-items-center">
            <h1 class="text-center">Pannel Admin</h1>
            <a href="../../" class="text-center">
                <i class="bi bi-eye-fill" style="font-size: 2rem;"></i>
            </a>
        </div>
        <div class="row align-items-stretch">
            <div class="col-md-3 col-12 p-3">
                <a href="./planning/" class="text-decoration-none bg-light rounded-4 W-100 h-100 p-md-5 p-2 d-flex jusitfy-content-center align-items-center flex-column">
                    <i class="bi bi-calendar-fill text-size-md-8 text-size-5"></i>
                    <h2>Planning</h2>
                </a>
            </div>
            <div class="col-md-3 col-12 p-3">
                <a href="./creneau/" class="text-decoration-none bg-light rounded-4 W-100 h-100 p-md-5 p-2 d-flex JUsitfy-content-center align-items-center flex-column">
                    <i class="bi bi-clock-fill text-size-md-8 text-size-5"></i>
                    <h2>Créneaux</h2>
                </a>
            </div>
            <div class="col-md-3 col-12 p-3">
                <a href="./soin/" class="text-decoration-none bg-light rounded-4 W-100 h-100 p-md-5 p-2 d-flex JUsitfy-content-center align-items-center flex-column">
                <i class="bi bi-boxes text-size-md-8 text-size-5"></i>
                <h2>Soins</h2>
                </a>
            </div>
            <div class="col-md-3 col-12 p-3">
                <a href="./logout/" class="text-decoration-none bg-light rounded-4 W-100 h-100 p-md-5 p-2 d-flex JUsitfy-content-center align-items-center flex-column">
                <i class="bi bi-box-arrow-right text-size-md-8 text-size-5"></i>
                <h2>Déconnexion</h2>
                </a>
            </div>
    </div>

</body>
</html>