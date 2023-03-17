<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_SESSION["Id"])) {
} else {
    header('location:./landing_page_user.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../main-css.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Se connecter</title>
</head>

<body>
     
    <?php
    require_once './head.php';
    ?>

    <div class=" container pb-5 mb-3 " style="background-color:var(--OPWhite-color);margin-top:10%;">

        <!-- Filter form start -->
        <form action="" method="POST" class="filters">
            <div class="filter">
                
                <label for="type">Type:</label>
                <select id="type" name="type">
                    <option value="tout_type">Tout les Type </option>
                    <option value="Livre"> Livre</option>
                    <option value="Revue">Revue</option>
                    <option value="Roman">Roman</option>
                    <option value="Cassettes vidéo">Cassettes vidéo</option>
                    <option value="CD">CD</option>
                    <option value="DVD">DVD</option>
                    <option value="Mémoire de recherche">Mémoire de recherche</option>
                    <option value="Magazine">Magazine</option>
                </select>
            </div>
            <div class="filter">
                <label for="etat">Etat:</label>
                <select id="etat" name="etat">
                    <option value="tout_etat"> Tout État </option>
                    <option value="Neuf">Neuf</option>
                    <option value="Bon état">Bon état</option>
                    <option value="Acceptable">Acceptable</option>
                    <option value="Assez usé">Assez usé</option>
                    <option value="Déchiré">Déchiré</option>
                </select>
            </div>
            <div class="filter">
                <button type="submit" name="fillter" id="fillter">Filter</button>
            </div>
        </form>
        <!-- Filter form end -->

        <!-- Display start -->
        <div class=" d-flex grid gap-3 align-items-center justify-content-around flex-wrap">
            <?php
            // Check if penalite_mb has reached 3
            $stmt = $pdo->prepare(" SELECT penalite_mb FROM membre WHERE id_mb = :id_mb");
            $stmt->bindParam(':id_mb', $reservation['id_mb']);
            $stmt->execute();
            $penalite_mb = $stmt->fetch(PDO::FETCH_ASSOC)['penalite_mb'];
            if ($penalite_mb >= 3) {
                $id_mb = $_SESSION["Id"];
                // Lock member's account for 30 days
                $stmt = $pdo->prepare(" UPDATE membre SET lock_cmp = 'locked', date_lock = DATE_ADD(NOW(), INTERVAL 30 DAY)WHERE id_mb = :id_mb");
                $stmt->bindParam(':id_mb', $reservation['id_mb']);
                $stmt->execute();
                echo "<script> alert('Votre compte a été bloqué pour 30 jours car vous avez dépassé la date de retour 3 fois. Veuillez contacter l\'administrateur pour plus d\'informations.')</script>";
                echo "<h3 class='fs-3 text-danger'> <i class='fa-solid fa-user-lock'></i> Votre compte a été bloqué pour 30 jours car vous avez dépassé la date de retour 3 fois.</h3>";
            } elseif (isset($_POST['fillter'])) {

                    $query = "SELECT * FROM ouvrage";
                    $selected = false;

                    if (isset($_POST["type"]) && $_POST["type"] !== 'tout_type') {
                        $query .= " WHERE type_ov=:type";
                        $selected = true;
                    }

                    if (isset($_POST["etat"]) && $_POST["etat"] != 'tout_etat') {
                        if ($selected) {
                            $query .= " AND ";
                        } else {
                            $query .= " WHERE ";
                            $selected = true;
                        }
                        $query .= "etat_ov=:etat";
                    }

                    $stmt = $pdo->prepare($query);

                    if (isset($_POST["type"]) && $_POST["type"] !== 'tout_type') {
                        $stmt->bindValue(':type', $_POST["type"]);
                    }

                    if (isset($_POST["etat"]) && $_POST["etat"] != 'tout_etat') {
                        $stmt->bindValue(':etat', $_POST['etat']);
                    }
                    $stmt->execute();
                    $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    include('./display.php');
                } else {
                    $stmt = $pdo->prepare("SELECT MIN(id_ov) AS id_ov, titre_ov, auteur_ov, type_ov, etat_ov, dateEdt_ov, img_ov FROM ouvrage GROUP BY titre_ov");
                    $stmt->execute();
                    $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);        
                    $results_per_page = 12;
                    $total_results = count($ouvrages);
                    $total_pages = ($total_results > 0 && $results_per_page > 0) ? ceil($total_results / $results_per_page) : 1;
                    $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
                    $offset = ($page - 1) * $results_per_page;
                    $stmt = $pdo->prepare("SELECT MIN(id_ov) AS id_ov, titre_ov, auteur_ov, type_ov, etat_ov, dateEdt_ov, img_ov FROM ouvrage GROUP BY titre_ov LIMIT :offset, :limit");
                    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                    $stmt->bindParam(':limit', $results_per_page, PDO::PARAM_INT);
                    $stmt->execute();
                    $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    include('./display.php');
                    $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM (SELECT MIN(id_ov), titre_ov, auteur_ov, type_ov, etat_ov, dateEdt_ov, img_ov FROM ouvrage GROUP BY titre_ov) as ouvrages");
                    $stmt->execute();
                    $total_results = $stmt->fetchColumn();
                    $total_pages = ceil($total_results / $results_per_page);
                    
                    echo "</div>
                <div class='pagination'>";
                    for ($i = 1; $i <= $total_pages; $i++) {
                        echo "<a href='?page=$i'>$i</a>";
                    }
                    echo "</div>";
                }

            ?>
        </div>
    </div>
    <!-- Display end -->
    <!-- <script>
$(document).ready(function() {
  $('.book-card-button').click(function() {
    var titre = $(this).data('titre');
    var modalBody = $('#exampleModal' + $(this).data('id') + ' .modal-body');
    modalBody.html('<ul class="list-group"><li class="list-group-item">Chargement en cours...</li></ul>');
    $.ajax({
      url: 'fetch_books.php',
      type: 'POST',
      data: { titre: titre },
      success: function(data) {
        modalBody.html(data);
      },
      error: function() {
        modalBody.html('<ul class="list-group"><li class="list-group-item">Une erreur est survenue.</li></ul>');
      }
    });
  });
});
</script> -->
    <script>
       
        // SEARCH 
        // var input = document.getElementById('recherche')
        // var ouvrages = document.querySelectorAll('.ouvrage-section');
        // input.addEventListener('keyup', () => {
        //     var searchTerm = input.value.toUpperCase();
        //     ouvrages.forEach(ouvrage => {
        //         var title = ouvrage.querySelector('h3').innerText.toUpperCase();
        //         var author = ouvrage.querySelector('h4').innerText.toUpperCase();
        //         if (title.indexOf(searchTerm) > -1 || author.indexOf(searchTerm) > -1) {
        //             ouvrage.style.display = "block";
        //         } else {
        //             ouvrage.style.display = "none";
        //         }
        //     });
        // });
    
    </script>
   <script src="../script.js"></script>
</body>

</html>