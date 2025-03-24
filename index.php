<?php
require_once './vendor/autoload.php';
use Symfony\Component\Dotenv\Dotenv;
$dotenv = new Dotenv();
$dotenv->usePutenv()->load(__DIR__ . '/.env');
if (!isset($_ENV['LOGIN']) || !isset($_ENV['PASSWORD']) || $_ENV['LOGIN'] == '' || $_ENV['PASSWORD'] == '') {
  header('Location: /template/setup');
  exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <style>
      @font-face {
        font-family: Outfit;
        font-style: normal;
        font-weight: 400;
        font-display: fallback;
        src: url("./assets/images/Outfit-VariableFont_wght.ttf") format("truetype");
        font-stretch: normal;
      }

      @font-face {
        font-family: Outfit;
        font-style: bold;
        font-weight: 400;
        font-display: fallback;
        src: url("./assets/images/Outfit-VariableFont_wght.ttf") format("truetype");
        font-stretch: normal;
      }
      * {
        font-family: "Outfit", sans-serif;
      }
      html {
        scroll-behavior: smooth;
      }

      @media (min-width: 767px) {
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

      @media (min-width: 767px) {
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
    </style>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Touche Magique Accueil</title>
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
  </head>

  <body>
    <!-- Bannière -->
    <header
      class="bg"
      style="
        background: url(./assets/images/banner.png);
        background-size: cover;
        background-position: bottom;
        height: 40rem;
      "
    >
      <div
        class="bg text-white text-center w-100 d-flex flex-column justify-content-center align-items-center"
        style="
          background: #00000033;
          background-size: cover;
          background-position: bottom;
          height: 40rem;
          padding-bottom: 10rem;
        "
      >
        <img
          src="./assets/images/touchemagique.svg"
          alt="Logo"
          width="200"
          height="200"
          style="border-radius: 50px; background: #fff8"
        />
        <h1
          style="
            font-weight: 700;
            font-size: clamp(40px, 2.5rem + ((1vw - 3.2px) * 2.727), 64px);
            font-style: normal;
            font-family: 'Outfit', sans-serif;
          "
        >
          Touche Magique
        </h1>
        <p style="font-size: 1.2rem; font-weight: 400">
          Soins corporels pour les femmes
        </p>
        <a
          href="template/reservation/"
          class="btn border-white border-2 rounded-0 p-3 text-white fw-bold"
          style="font-family: 'Outfit', sans-serif; background: #00000033"
          >Réserver</a
        >
      </div>
    </header>

    <!-- Navbar -->
    <nav class="navbar navbar-light bg-light">
      <div class="container">
        <a
          href="template/reservation/"
          class="navbar-brand col-12 col-md-3 d-flex flex-md-row flex-column justify-content-center align-items-center"
        >
          <img
            src="./assets/images/cropped-Logo-Touche-Magique.jpeg"
            alt="Logo"
            width="150"
            height="150"
            class="m-1"
          />
        </a>
        <div
          class="d-flex flex-md-row flex-column justify-content-center align-items-center col-12 col-md-8"
        >
          <a
            href="template/reservation/"
            class="m-2 btn border-black border-2 rounded-0 p-3 d-flex align-items-center fw-bold"
            style="font-family: 'Outfit', sans-serif; background: #ffffffa8"
          >
            <i class="bi bi-calendar2-event me-2" style="font-size: 1.5rem"></i>
            Réserver ma séance
          </a>
          <a
            href="#contact"
            class="m-2 btn border-black border-2 rounded-0 p-3 d-flex align-items-center fw-bold"
            style="font-family: 'Outfit', sans-serif; background: #ffffffa8"
          >
            <i class="bi bi-envelope me-2" style="font-size: 1.5rem"></i>
            Nous contacter
          </a>
          <a
            href="#contact"
            class="m-2 btn border-black border-2 rounded-0 p-3 d-flex align-items-center fw-bold"
            style="font-family: 'Outfit', sans-serif; background: #ffffffa8"
          >
            <i class="bi bi-info-square me-2" style="font-size: 1.5rem"></i>
            Informations
          </a>
        </div>
      </div>
    </nav>

    <!-- Section Présentation -->
    <section class="container my-5 text-center">
      <h2>Qui sommes-nous ?</h2>
      <p>
        Touche Magique est un espace dédié à la transformation et au bien-être
        des femmes.
      </p>
    </section>

    <!-- Section Services -->
    <hr style="width: 70%; margin: auto" />
    <div
      class="container my-5 d-flex flex-column flex-md-row flex-md-wrap justify-content-center align-items-center text-center"
    >
      <div class="col-md-4 m-2">
        <img
          src="./assets/images/calendrier.png"
          class="img-fluid rounded"
          alt="Avant-après"
          height="50px"
          width="50px"
        />
        <p class="mb-0 mt-2"><strong>7j/7</strong></p>
        <h3 class="m-0 p-0 fw-bold" style="font-size: 1.3rem">
          Ouvert tout les jours
        </h3>
      </div>

      <div class="col-md-4 m-2">
        <img
          src="./assets/images/emplacement-de-la-carte.png"
          class="img-fluid rounded"
          alt="Avant-après"
          height="50px"
          width="50px"
        />
        <p class="mb-0 mt-2"><strong>93</strong></p>
        <h3 class="m-0 p-0 fw-bold" style="font-size: 1.3rem">
          Le Blanc-Mesnil
        </h3>
      </div>

      <div class="col-md-4 m-2">
        <img
          src="./assets/images/utilisateur.png"
          class="img-fluid rounded"
          alt="Avant-après"
          height="50px"
          width="50px"
        />
        <p class="mb-0 mt-2"><strong>100%</strong></p>
        <h3 class="m-0 p-0 fw-bold" style="font-size: 1.3rem">
          Pour les femmes
        </h3>
      </div>

      <div class="col-md-4 m-2">
        <img
          src="./assets/images/interdit.png"
          class="img-fluid rounded"
          alt="Avant-après"
          height="50px"
          width="50px"
        />
        <p class="mb-0 mt-2"><strong>Le combo 0</strong></p>
        <h3 class="m-0 p-0 fw-bold" style="font-size: 1.3rem">
          0 cicatrice, 0 douleur
        </h3>
      </div>
    </div>
    <hr style="width: 70%; margin: auto" />

    <!-- Fonction -->
    <div
      class="container p-4 pt-5 d-flex flex-column flex-md-row align-items-center"
    >
      <div class="col-md-6">
        <h2 class="text-start" style="font-weight: 700; font-size: 1.7rem">
          Transformer votre corps sans chirurgie
        </h2>
      </div>
      <div class="col-md-6">
        <h2 class="text-start" style="font-weight: 700; font-size: 1rem">
          Grâce à des technologies de pointe
        </h2>
        <div class="border-start border-black border-4 ps-3">
          <p class="text-start text-muted">
            Découvrez les solutions non invasives qui transforment votre corps
            sans douleur, cicatrice ni longue récupération.
          </p>
        </div>
      </div>
    </div>
    <!--
    <div class="container py-2 pb-5">
      <img
        src="./assets/images/Summer-body-1536x768.png"
        class="img-fluid rounded"
        alt="Présentation"
      />
    </div>
    -->
    <hr style="width: 70%; margin: auto" />

    <!-- Carrousel -->
    <section
      class="d-flex flex-column justify-content-center align-items-center pt-4"
    >
      <h1>Nos services</h1>

      <a
        href="template/reservation/"
        class="m-2 btn border-white text-white border-2 rounded-0 p-3 ps-4 d-flex align-items-center fw-bold"
        style="
          font-family: 'Outfit', sans-serif;
          background: linear-gradient(
            135deg,
            rgb(176, 56, 155) 1%,
            rgb(42, 156, 131) 100%
          );
        "
      >
        Réserver une séance
        <i class="bi bi-arrow-right-short ms-2 fs-2"></i>
      </a>
      <div
        id="carousel"
        class="carousel slide pt-4 w-md-35"
        data-bs-ride="carousel"
      >
        <div class="carousel-inner">

          <div class="carousel-item active" style="overflow: hidden">
            <img
            src="./assets/images/Zone-intime-1024x1024.png"
            class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Radiofréquence (zone intime)</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Procédé destiné à tonifier et rajeunir la zone intime via la
              chaleur des ondes.
              <br />
              <i>À partir de 50€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Cryolipolyse-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Cryolipolyse</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Technique non invasive qui utilise le froid pour détruire les
              cellules graisseuses de manière ciblée.
              <br />
              <i>À partir de 70€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Endospshere-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Endosphère</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Massage mécanique combinant microvibrations pour améliorer la
              circulation et raffermir la peau.
              <br />
              <i>À partir de 60€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Cavitation-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Cavitation</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Méthode qui utilise des ultrasons pour briser les amas graisseux
              et réduire la cellulite.
              <br />
              <i>À partir de 50€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Radiofrequence-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Radiofréquence (corps)</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Traitement utilisant des ondes pour stimuler le collagène et
              raffermir la peau.
              <br />
              <i>À partir de 50€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Lipolaser-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Lipolaser</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Technologie laser visant à liquéfier la graisse pour faciliter son
              élimination naturelle.
              <br />
              <i>À partir de 50€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Lifting-colombien-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Lifting colombien</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Massage par ventouses pour sculpter et rehausser les fesses
              naturellement.
              <br />
              <i>À partir de 50€</i>
            </p>
          </div>

          <div class="carousel-item" style="overflow: hidden">
            <img
              src="./assets/images/Maderotherapie-1024x1024.png"
              class="d-block w-100 rounded-md-4"
              style="border-radius: 0"
              alt=""
            />
            <h3 class="p-4 pb-0">Madérothérapie</h3>
            <p class="p-4 pt-0" style="height: 7rem">
              Massage manuel avec des outils en bois pour réduire la cellulite
              et tonifier la silhouette.
              <br />
              <i>À partir de 60€</i>
            </p>
          </div>
        </div>
        <button
          class="carousel-control-prev col-6"
          type="button"
          data-bs-target="#carousel"
          data-bs-slide="prev"
        >
          <span
            class="carousel-control-prev-icon p-2"
            style="background-color: #0000003a; border-radius: 100px"
            aria-hidden="true"
          ></span>
        </button>
        <button
          class="carousel-control-next col-6"
          type="button"
          data-bs-target="#carousel"
          data-bs-slide="next"
        >
          <span
            class="carousel-control-next-icon p-2"
            style="background-color: #0000003a; border-radius: 100px"
            aria-hidden="true"
          ></span>
        </button>
      </div>
    </section>

    <section style="background-color: #fafaf9">
      <div class="container p-md-5">
        <div class="row align-items-center m-5">
          <div class="col-12 col-md-6 order-2 order-md-1">
            <h3 class="text-start">La cure magique</h3>
            <p class="text-start">
              <em
                >Le combo parfait pour un effet amincissant, raffermissant et
                drainant.</em
              >
            </p>
            <p>
              La formule se compose de 5 séances de 90 min dont 2 séances par
              cryolipolyse et 3 séances par Endosphère, Radiofréquence,
              Cavitation et Lipolaser.
            </p>
            <p class="text-start">
              <strong><em>Prix :&nbsp;500€</em></strong>
            </p>
            <div class="d-flex justify-content-start">
              <a
                href="template/reservation/"
                class="m-2 btn border-white text-white border-2 rounded-0 p-3 ps-4 d-flex align-items-center fw-bold"
                style="
                  font-family: 'Outfit', sans-serif;
                  background: linear-gradient(
                    135deg,
                    rgb(176, 56, 155) 1%,
                    rgb(42, 156, 131) 100%
                  );
                "
              >
                Je veux ma cure
                <i class="bi bi-arrow-right-short ms-2 fs-2"></i>
              </a>
            </div>
          </div>
          <div class="col-12 col-md-6 order-1 order-md-2">
            <img
              src="http://touchemagique.fr/wp-content/uploads/2024/12/Tour-de-taille-1024x1024.png"
              alt=""
              class="img-fluid rounded-4"
            />
          </div>
        </div>
      </div>
    </section>

    <section style="height: 90vh">
      <div class="container p-md-5 p-1 h-100">
        <div
          class="bg-light p-md-5 p-3 rounded-3 position-relative text-center h-100"
        >
          <img
            src="http://touchemagique.fr/wp-content/uploads/2024/12/Summer-body.png"
            class="img-fluid rounded-4 h-100"
            style="object-fit: cover"
            style="position: sticky"
            alt=""
          />
          <div
            class="text-center position-absolute top-50 start-50 translate-middle text-white rounded"
          >
            <h3
              class="fw-bold text-white fs-md-3rem"
              style="font-weight: bold !important; font-size: 2rem"
            >
              Prête pour votre <br> “Summer Body” ?
            </h3>
            <p class="">
              Le corps de rêve pour les vacances d’été se construit maintenant.
              Optez pour des techniques modernes et non invasives pour une
              transformation sans effort.
            </p>
            <div class="d-flex justify-content-center">
              <a
                href="template/reservation/"
                class="m-2 btn border-white text-white border-2 rounded-0 p-3 ps-4 d-flex align-items-center fw-bold"
                style="
                  font-family: 'Outfit', sans-serif;
                  background: linear-gradient(
                    135deg,
                    rgb(176, 56, 155) 1%,
                    rgb(42, 156, 131) 100%
                  );
                "
              >
                Je réserve
                <i class="bi bi-arrow-right-short ms-2 fs-2"></i>
              </a>
            </div>
            <div class="background-white p-3 rounded-4 w-75 d-flex"></div>
          </div>
        </div>
      </div>
    </section>

    <footer>
      <div class="container mb-4">
        <div class="row g-3">
          <div class="col-12 p-3 col-md-6">
            <div
              class="d-flex flex-column h-100 p-5 rounded-3 text-white"
              style="background-color: #1c1917"
            >
              <div class="text-center">
                <i class="bi bi-clock" style="font-size: 5rem"></i>
              </div>
              <h3 class="text-center">Horaires d’ouverture&nbsp;</h3>
              <p class="p-3 text-center flex-grow-1">
                <strong>Lundi</strong>&nbsp;: 09:00-18:30 <br />
                <strong>Mardi</strong>&nbsp;: 09:00-18:30 <br />
                <strong>Mercredi</strong>&nbsp;: 09:00-18:30 <br />
                <strong>Jeudi</strong>&nbsp;: 09:00-18:30 <br />
                <strong>Vendredi</strong>&nbsp;: 09:00-18:30 <br />
                <strong>Samedi</strong>&nbsp;: 14:00-18:30 <br />
                <strong>Dimanche</strong>&nbsp;: 14:00-18:30
              </p>
            </div>
          </div>

          <div id="contact" class="col-12 p-3 col-md-6">
            <h
              class="d-flex flex-column h-100 p-5 bg-light rounded-3 align-items-center"
            >
              <div class="d-flex justify-content-center">
                <i class="bi bi-chat-dots me-2" style="font-size: 5rem"></i>
              </div>
              <h3 class="text-center">Contactez-nous&nbsp;</h3>
              <p class="text-center text-secondary">
                Pour toute question, nous restons à votre disposition à
                l’adresse mail suivante :
              </p>
              <h3 class="text-center">
                <a
                  href="mailto:contact@touchemagique.fr"
                  class="text-dark fw-bold text-decoration-none p-3 rounded-3"
                  style="transition: 0.6s all 0s; font-size: 1.2rem"
                  >contact@touchemagique.fr</a
                >                
              </h3>
              <h3>
                <a
                  href="tel:+330606060606"
                  class="text-dark fw-bold text-decoration-none p-3 rounded-3"
                  style="transition: 0.6s all 0s; font-size: 1.2rem"
                >
                  06 06 06 06 06
                </a>
              </h3>
              <h3>
                <a
                  href="https://www.google.com/maps/search/?api=1&query=21+avenue+de+Flandres,93150+Le+Blanc-Mesnil"
                  target="_blank"
                  class="text-dark fw-bold text-decoration-none p-3 rounded-3 text-center d-flex"
                  style="transition: 0.6s all 0s; font-size: 1.2rem"
                >
                    21, avenue de Flandres <br />
                    93150 Le Blanc-Mesnil
                </a>
              </h3>
            </div>
          </div>
        </div>
      </div>

      <div class="w-100 bg-dark text-white text-center p-3">
        <img
          src="./assets/images/cropped-Logo-Touche-Magique.jpeg"
          alt="Logo"
          class="m-3 rounded-circle"
          width="150"
          height="150"
        />
        <p class="m-0">© 2025 Touche Magique - Tous droits réservés</p>
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
