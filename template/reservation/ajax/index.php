<?php
header('Content-Type: application/json');
require_once '../../../src/service/Bdd.php';

use Service\Bdd;
$date = $_GET["date"];

$bdd = new Bdd();
$result = $bdd->getConnection()->prepare(
    'SELECT id, heure FROM creneaux WHERE id_utilisateur IS NULL AND date = :date'
);
$result->execute(['date' => $date]);

$creneaux = $result->fetchAll();

echo json_encode(["creneaux" => $creneaux]);
