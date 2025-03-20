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
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Créneaux</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css"
    />
    <link
      rel="stylesheet"
      href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css"
    />
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <style>
        * {
            line-height: 1rem;
        }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <h1 class="text-center m-2">Créneaux</h1>
      <div class="row justify-content-center align-items-center m-3">
        <a
          href="/template/admin/creneau/new"
          class="btn btn-primary d-flex justify-content-center align-items-center rounded-circle p-4 m-2"
          style="width: 50px; height: 50px"
        >
          <i
            class="bi bi-plus text-center"
            style="font-size: 2rem"
          ></i>
        </a>
          <a
            href="/template/admin"
            class="btn btn-secondary d-flex justify-content-center align-items-center rounded-circle p-4 m-2"
            style="width: 50px; height: 50px"
          >
            <i
              class="bi bi-arrow-left text-center"
              style="font-size: 2rem"
            ></i>
          </a>
      </div>
      <div class="row">
        <div class="col">
          <table id="myTable" class="display w-100">
            <thead>
              <tr>
                <th class="col-4">Date - Heure (Durée)</th>
                <th class="col-4">Nom</th>
                <th class="col-4">Tel</th>
                <th class="d-none d-md-table-cell">Email</th>
                <th class="d-none d-md-table-cell">Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php
                            $bdd = new Bdd();
                            $result = $bdd->getConnection()->query('SELECT *
              FROM creneaux left join utilisateurs on creneaux.id_utilisateur =
              utilisateurs.id'); while ($row = $result->fetch()) { ?>
              <tr>
                <td class="text-center">
                    <p class="m-0 d-flex">
                        <?= date('d/m/Y', strtotime($row['date']))?><i class="d-none d-md-block">&nbsp;-&nbsp;</i><br class="d-md-none d-block"><?=$row['heure'] . '<br class="d-md-none d-table-cell"> (' . $row['duree'] . 'h)' ?>
                    </p>
                </td>
                <td><?= $row['nom'] ?></td>
                <td><?= $row['tel'] ?></td>
                <td class="d-none d-md-table-cell"><?= $row['email'] ?></td>
                <td class="d-none d-md-table-cell">
                  <form
                    action="/template/admin/creneau/delete"
                    method="post"
                    onsubmit='return confirm("Voulez-vous vraiment supprimer ce créneau ?")'
                  >
                    <input type="hidden" name="id" value="<?= $row[0] ?>" />
                    <button type="submit" value="Supprimer" class="btn btn-danger"> 
                        
                    <i class="bi bi-trash" style="font-size: 1.2rem"></i></button>
                  </form>
                </td>
              </tr>
              <?php
                }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
    <script>
      $(document).ready(function () {
        let table = new DataTable("#myTable", {
          language: {
            sEmptyTable: "Aucune donnée disponible dans le tableau",
            sInfo:
              "Affichage de l'élément _START_ à _END_ sur _TOTAL_ éléments",
            sInfoEmpty: "Affichage de l'élément 0 à 0 sur 0 élément",
            sInfoFiltered: "(filtré à partir de _MAX_ éléments au total)",
            sInfoThousands: ",",
            sLengthMenu: "Afficher _MENU_ éléments",
            sLoadingRecords: "Chargement...",
            sProcessing: "Traitement...",
            sSearch: "Rechercher :",
            sZeroRecords: "Aucun élément correspondant trouvé",
            oPaginate: {
              sFirst: "Premier",
              sLast: "Dernier",
              sNext: "Suivant",
              sPrevious: "Précédent",
            },
            oAria: {
              sSortAscending:
                ": activer pour trier la colonne par ordre croissant",
              sSortDescending:
                ": activer pour trier la colonne par ordre décroissant",
            },
            select: {
              rows: {
                _: "%d lignes sélectionnées",
                0: "Aucune ligne sélectionnée",
                1: "1 ligne sélectionnée",
              },
            },
          },
        });
      });
    </script>
  </body>
</html>
