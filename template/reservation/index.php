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

        <form action="/template/reservation/valid/" method="post" class="container text-center my-4 d-flex flex-column justify-content-center align-items-center">
            <h1>Réservation Séance Touchemagique</h1>
            <a href="../../">
                <img src="../../assets/images/cropped-Logo-Touche-Magique.jpeg" class="rounded-4" style="width: 20rem" alt="">
            </a>
            <div class="row g-3">

                <div class="col-12 p-3 col-md-6">
                    <div class="d-flex flex-column h-100 p-5 bg-light rounded-3 align-items-center">
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input type="text" name="date" id="date" class="form-control" value="24/10/1984" placeholder="jj/mm/aaaa">
                        </div>
                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="mb-3">
                            <label for="tel" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" name="tel" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="typeDeSoin" class="form-label">Type de Soin</label>
                            <select id="typeDeSoin" name="typeDeSoin" class="form-select" required>
                                <option value="" disabled selected>Choisir un type de soin</option>
                                <?php
                                require_once '../../src/service/Bdd.php';
                                use Service\Bdd;
                                $bdd = new Bdd();
                                $stmt = $bdd->getConnection()->prepare('SELECT id, libelle, prix FROM type ORDER BY libelle ASC');
                                $stmt->execute();
                                foreach ($stmt as $typeDeSoin) {
                                    echo '<option value="' . $typeDeSoin['id'] . '">' . $typeDeSoin['libelle'] . ' (' . $typeDeSoin['prix'] . ' &euro;)</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12 p-3 col-md-6">
                    <div class="d-flex flex-column h-100 p-5 rounded-3 text-white" style="background-color: #1c1917">
                        <div class="text-center">
                            <i class="bi bi-clock" style="font-size: 5rem"></i>
                        </div>
                        <h3 class="text-center">Créneaux disponibles&nbsp;</h3>
                        <p class="p-3 text-center">
                            <em>Choisissez une date pour voir les créneaux disponibles</em>
                        </p>
                        <div id="creneaux" class="flex-grow-1"></div>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="m-2 btn border-white text-white border-2 rounded-0 p-3 d-flex align-items-center fw-bold" style="width: fit-content; font-family: 'Outfit', sans-serif; background: linear-gradient(135deg, rgb(176, 56, 155) 1%, rgb(42, 156, 131) 100%);">
                    Valider ma reservation
                    <i class="bi bi-arrow-right-short ms-2 fs-2"></i>
                </button>
                <a href="../../" class="m-2 btn bg-secondary border-white text-white border-2 rounded-0 p-3 d-flex align-items-center fw-bold" style="width: fit-content; font-family: 'Outfit', sans-serif;">
                    Retour
                </a>
            </div>
            <p>
                En validant vous acceptez notre politique de confidentialité<br>
                (email, tel., nom)
            </p>

        </form>


        <script>
            <?php

            $result = $bdd->getConnection()->query('SELECT DISTINCT date FROM creneaux WHERE id_utilisateur IS NULL');
            $validDates = [];
            while ($row = $result->fetch()) {
                $validDates[] = $row['date'];
            }
            ?>
                            const validDates = [<?php echo '"' . implode('", "', $validDates) . '"'; ?>];
                            
                            function isDateValid(date) {
                                const formattedDate = moment(date).format('YYYY-MM-DD');
                                return validDates.includes(formattedDate);
                            }
            
                            function getcreneaux(start) {
                                $.ajax({
                                    url: ('ajax?date='+start.format('YYYY-MM-DD')),
                                    success: function(data) {
                                        console.log(data);
                                        const creneaux = data.creneaux;
                                        $('#creneaux').empty();
                                        creneaux.forEach(creneau => {
                                            const div = document.createElement('div');
                                            div.classList.add('form-check', 'p-0');
                                            div.innerHTML = `
                                            <input type="radio" class="form-check-input visually-hidden" name="creneau" value="${creneau.id}" id="creneau-${creneau.heure}" required>
                                            <label for="creneau-${creneau.heure}" class="btn w-100">${creneau.heure.split(':')[0]}:${creneau.heure.split(':')[1]}</label>
                                            `;
                            
                                            $('#creneaux').append(div);
                                        });
                                        
                                    }
                                });
                            }
                            
                            $(function() {
                              $('input[name="date"]').daterangepicker({
                                singleDatePicker: true,
                                showDropdowns: true,
                                locale: {
                                    format: 'DD/MM/YYYY',
                                    daysOfWeek: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                                    firstDay: 1 // Lundi
                                },
                                minDate: new Date(),
                                startDate: new Date(),
                                maxDate: moment().add(6, 'months').toDate(),
                                isInvalidDate: function(date) {
                                    return !isDateValid(date);
                                }
                            
                            
                              }, function(start, end, label) {
                                getcreneaux(start);
                              });
                            });
            
                            document.addEventListener('DOMContentLoaded', function() {
                                
                                getcreneaux(moment());
                            })
                            </script>
                            


                                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
                            
                            </body>
                            </html>

