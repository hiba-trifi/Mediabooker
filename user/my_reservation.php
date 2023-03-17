<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
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
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../main-css.css">
    <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon">
    <title>Se connecter</title>
</head>

<body>
    <?php
    require_once './head.php';
    ?>
    <div class=" container   p-0  rounded ">
        <div class=" d-flex my-3 justify-content-center  ">
            <?php
            if ($penalite_mb >= 3) {
                $id_mb = $_SESSION["Id"];
                // Lock member's account for 30 days
                $stmt = $pdo->prepare(" UPDATE membre SET lock_cmp = 'locked', date_lock = DATE_ADD(NOW(), INTERVAL 30 DAY)WHERE id_mb = :id_mb");
                $stmt->bindParam(':id_mb', $reservation['id_mb']);
                $stmt->execute();
                echo "<script> alert('Votre compte a été bloqué pour 30 jours car vous avez dépassé la date de retour 3 fois. Veuillez contacter l\'administrateur pour plus d\'informations.')</script>";
                echo "        
                <h3 class='fs-3 text-danger'>   <i class='fa-solid fa-lock text-danger '></i> Votre compte a été bloqué pour 30 jours car vous avez dépassé la date de retour 3 fois.</h3>";
            } else {

                $id_mb = $_SESSION["Id"];


                $stmt = $pdo->prepare("SELECT * FROM ouvrage WHERE id_ov IN (SELECT id_ov FROM reservation WHERE id_mb=:id_mb and validation_res = 0)");
                $stmt->bindParam(':id_mb', $id_mb);
                $stmt->execute();
                $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);
                foreach ($ouvrages as $ouvrage) {
                    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_mb=:id_mb AND id_ov=:id_ov");
                    $stmt->bindParam(':id_mb', $id_mb);
                    $stmt->bindParam(':id_ov', $ouvrage['id_ov']);
                    $stmt->execute();
                    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo " <form method='POST'> 
                    <div class='book-card'>
                    <div class='book-card-image'>
                      <img class='card_img' src='$ouvrage[img_ov]' alt='Book cover image'>
                    </div>
                    <div class='book-card-content'>
                      <h3 class='book-card-title'> $ouvrage[titre_ov]</h3>
                      <p class='book-card-author'>$ouvrage[auteur_ov]</p>
                      <p class='book-card-info'>
                        <span class='book-card-type' >$ouvrage[type_ov]</span>
                        <span class='book-card-status'>$ouvrage[etat_ov]</span>
                        <span class='book-card-edition'>$ouvrage[dateEdt_ov]</span>
                      </p>
                     
                                ";

                    if (count($reservations) > 0) {
                        foreach ($reservations as $reservation) {
                            echo "
                           
            <input type='hidden' name='id_res' value='$reservation[id_res]' />
            <h6 class='mt-2 aligh-seld-end fw-semibold'>Code de réservation: $reservation[code_res]</h6> ";

                            $_SESSION['id_res'] = $reservation['id_res'];
                        }
                        echo " 
                        <button type='submit' name='annuler' class='book-card-button'>Anuuler</button>
                         </form> 
                         </div>

           
    </div>
   ";




                    }
                }
            }
            if (isset($_POST['annuler'])) {
                $id_res = $_POST['id_res'];
                $stmt = $pdo->prepare("DELETE FROM reservation WHERE `reservation`.`id_res` = :id_res AND id_mb = :id_mb");
                $stmt->bindParam(':id_res', $id_res);
                $stmt->bindParam(':id_mb', $id_mb);
                $stmt->execute();
            }
            ?>
        </div>
    </div>

    <script src="../script.js"></script>
</body>

</html>