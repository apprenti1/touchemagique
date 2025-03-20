<?php
    namespace Service;
    require_once '../../../src/service/Authenticator.php';
    use Service\Authenticator;
    if (!Authenticator::isAuthenticated()) {
        header('Location: /template/login');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning</title>
    <link
      rel="icon"
      type="image/svg+xml"
      href="./assets/images/cropped-Logo-Touche-Magique.jpeg"
    />

    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />

    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <style>
        body {
            height: 100vh;
            display: flex;
            align-items: center;
            flex-direction: column;
        }
        p {
            margin: 0;
            padding: 0;
        }

        @media (min-width: 767px) {
            .position-md-relative {
                position: relative !important;
            }
        }

    </style>
</head>
<body>
    <div class="container text-center pt-3 flex-grow-1 d-flex flex-column">
        <div class="row justify-content-center align-items-center position-md-relative position-fixed w-100 z-2" style="left: 0;">
            <button class="btn btn-secondary m-1" style="width: fit-content; font-size: 1.3rem;" onclick="document.getElementById('date').stepDown(screen.width > 767 ? 7 : 1); getPlanning();">
                <i class="bi bi-arrow-left"></i>
            </button>
            <input id="date" type="date" data-date-format="dd/mm/yyyy" class="form-control col-2" style="width: fit-content" />
            <button class="btn btn-secondary m-1" style="width: fit-content; font-size: 1.3rem;" onclick="document.getElementById('date').stepUp(screen.width > 767 ? 7 : 1);  getPlanning();">
                <i class="bi bi-arrow-right"></i>
            </button>
            <a href="/template/admin" class="btn btn-secondary m-1" style="width: fit-content; font-size: 1.3rem;">
                <i class="bi bi-house"></i>
            </a>

        </div>
        <div class="row flex-grow-1 position-relative overflow-hidden bg-light justify-content-around align-items-stretch rounded-4 mb-4 d-none d-md-flex">
            <div class="col-6 rounded-4 h-100 row p-0">
                <div class="col-3 d-flex flex-column p-0" style="border-right: solid 3px black ">
                <p class="p-0" style="border-bottom: solid 3px black">Planning</p>


                <?php for ($i = 9; $i < 21; $i++): ?>
                <div class="flex-grow-1">
                    <span style="border-bottom: solid 1px #0003; width: 100%; position: absolute; left: 0; opacity: 0.5; pointer-events: none;"></span>
                    <p><?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>h</p>
                </div>
                <?php endfor; ?>
                </div>
                <?php foreach (['Lundi', 'Mardi', 'Mercredi'] as $jour): ?>
                    <div class="col-3 border-1 planning p-0" style="border-right: 1px solid #000a">
                        <p class="p-0" style="border-bottom: solid 3px black"><?= $jour ?></p>
                        <div id="<?= strtolower($jour) ?>" class="d-flex flex-column h-100 px-1">
                            
                        </div>
                    </div>
                <?php endforeach; ?>           
            </div>
            <div class="col-6 bg-light h-100 row p-0">
                <?php foreach (['Jeudi', 'Vendredi', 'Samedi', 'Dimanche'] as $jour): ?>
                    <div class="col-3 border-1 planning p-0" style="border-right: 1px solid #000a">
                        <p class="p-0" style="border-bottom: solid 3px black"><?= $jour ?></p>
                        <div id="<?= strtolower($jour) ?>" class="d-flex flex-column h-100 px-1">

                        </div>
                    </div>
                <?php endforeach; ?>           
            </div>
        </div>
        <div class="row position-relative bg-light justify-content-around align-items-stretch rounded-4 mb-4 d-md-none d-flex" style="height: 200vh;">
            <div class="col-12 rounded-4 h-100 row p-0 d-flex flex-column">
                <p class="p-2 position-fixed" style="left:0; margin-top: 3rem; border-bottom: solid 3px black">Lundi</p>
                    <div id="" class="d-flex flex-column h-100 px-1">
                    </div>
            </div>
        </div>
    </div>
    <div class="position-absolute w-100 bg-dark p-3 d-flex justify-content-center align-items-center" style="z-index: 1000; visibility: hidden; background-color: rgba(0, 0, 0, 0.5) !important;">
        <div id="detail" class="bg-light rounded-4 p-5">

        </div>
    </div>
    <script>

        function hideDetail() {
            document.querySelector('#detail').parentNode.style.visibility = 'hidden';
        }


function creneauDetails(creneau) {
    fetch('./planning/ajax?id=' + creneau)
        .then(response => response.json())
        .then(data => {
            const detailDiv = document.getElementById('detail');
            if (data.length > 0) {
                const creneauData = data[0];
                detailDiv.innerHTML = `
                    <h2>Détails du créneau</h2>
                    <p><strong>Durée:</strong> ${creneauData.duree} minutes</p>
                    <p><strong>Date:</strong> ${new Date(creneauData.date).toLocaleDateString()}</p>
                    <p><strong>Heure:</strong> ${creneauData.heure.substr(0, 5)}</p>
                    <p><strong>État:</strong> ${creneauData.etat}</p>
                    <p><strong>Email:</strong> ${creneauData.email || 'N/A'}</p>
                    <p><strong>Téléphone:</strong> ${creneauData.tel || 'N/A'}</p>
                    <p><strong>Nom:</strong> ${creneauData.nom || 'N/A'}</p>
                    <p><strong>Prénom:</strong> ${creneauData.prenom || 'N/A'}</p>
                    <button class="btn btn-secondary" onclick="hideDetail()">Fermer</button>
                `;
            } else {
                detailDiv.innerHTML = '<p>Aucun détail trouvé pour ce créneau.</p>';
            }
            detailDiv.parentElement.style.visibility = "visible";
        });
}

        function getPlanning() {

            const isMobile = window.innerWidth < 768;
            const date = document.getElementById('date').value;
            
            if (isMobile) {
                fetch('./planning/ajax?type=d&date=' + date)
                .then(response => response.text())
                .then(data => {
                    const planning = JSON.parse(data);
                    
                    for (const jour of Object.keys(planningDivs)) {
                        planningDivs[jour].innerHTML = '';
                    }
                    for (const creneau of planning) {
                        const jour = new Date(creneau.date).getDay();
                        const button = document.createElement('button');
                        const div = document.createElement('div');
                        const [heure, minutes, seconds] = creneau.heure.split(':').map(v => parseInt(v));
                        const decimale = heure + minutes/60 + seconds/3600;
                        const flexdiv = [...planningDivs[jour].children].reduce((acc, element)=>{
                            const style = element && element.style;
                            const flex = style ? style.flex.split(' ')[0] : 0;
                            return acc + parseFloat(flex);
                        }, 0);
                        console.log(flexdiv);
                        div.style.flex = ((decimale - 8) / 13)*1.03 - flexdiv;
                        div.classList.add('p-0', 'border-0');
                        button.classList.add('bg-primary', 'w-100', 'rounded-2', 'p-0', 'border-0', 'text-white', 'btn');
                        button.style.flex = creneau.duree/60/13*1.03;
                        button.style.fontSize = '0.8rem';
                        button.style.lineHeight = '0.6rem';
                        button.style.fontWeight = 'bold';
                        button.onclick = function() {
                            creneauDetails(creneau.idcreneau);
                        };
                        button.textContent = `${creneau.heure.substr(0, 5)} (${creneau.duree})`;
                        planningDivs[jour].appendChild(div);
                        planningDivs[jour].appendChild(button);
                    }
                });
            }
            else {
                fetch('./planning/ajax?type=w&date=' + date)
                .then(response => response.text())
                .then(data => {
                    const planning = JSON.parse(data);
                    const planningDivs = {
                        1: document.getElementById('lundi'),
                        2: document.getElementById('mardi'),
                        3: document.getElementById('mercredi'),
                        4: document.getElementById('jeudi'),
                        5: document.getElementById('vendredi'),
                        6: document.getElementById('samedi'),
                        7: document.getElementById('dimanche')
                    };
                    for (const jour of Object.keys(planningDivs)) {
                        planningDivs[jour].innerHTML = '';
                    }
                    for (const creneau of planning) {
                        const jour = new Date(creneau.date).getDay();
                        const button = document.createElement('button');
                        const div = document.createElement('div');
                        const [heure, minutes, seconds] = creneau.heure.split(':').map(v => parseInt(v));
                        const decimale = heure + minutes/60 + seconds/3600;
                        const flexdiv = [...planningDivs[jour].children].reduce((acc, element)=>{
                            const style = element && element.style;
                            const flex = style ? style.flex.split(' ')[0] : 0;
                            return acc + parseFloat(flex);
                        }, 0);
                        console.log(flexdiv);
                        div.style.flex = ((decimale - 8) / 13)*1.03 - flexdiv;
                        div.classList.add('p-0', 'border-0');
                        button.classList.add('bg-primary', 'w-100', 'rounded-2', 'p-0', 'border-0', 'text-white', 'btn');
                        button.style.flex = creneau.duree/60/13*1.03;
                        button.style.fontSize = '0.8rem';
                        button.style.lineHeight = '0.6rem';
                        button.style.fontWeight = 'bold';
                        button.onclick = function() {
                            creneauDetails(creneau.idcreneau);
                        };
                        button.textContent = `${creneau.heure.substr(0, 5)} (${creneau.duree})`;
                        planningDivs[jour].appendChild(div);
                        planningDivs[jour].appendChild(button);
                    }
                });
            }
        }
        document.getElementById('date').addEventListener('change', getPlanning);
        
        document.addEventListener('keyup', function(event) {
            if (event.key === "Escape") {
                hideDetail();
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const isMobile = window.innerWidth < 768;
            const today = new Date();
            const lastMonday = new Date(today.setDate(today.getDate() - (today.getDay() === 0 ? 6 : today.getDay() - 1)));
            document.getElementById('date').value = isMobile ? new Date().toISOString().slice(0, 10) : lastMonday.toISOString().slice(0, 10);
            getPlanning();
        });

        let change = true;
        window.addEventListener('resize', function() {
            const isMobile = window.innerWidth < 768;

            if((isMobile && change) || (!isMobile && !change)) {
                change = !change;
                getPlanning();
            }
        });
        
    </script>
</body>
</html>