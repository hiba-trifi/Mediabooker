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
            $id_mb = $_SESSION["Id"];
            $stmt = $pdo->prepare("SELECT * FROM ouvrage WHERE id_ov IN (SELECT id_ov FROM reservation WHERE id_mb=:id_mb and validation_res = 2)");
            $stmt->bindParam(':id_mb', $id_mb);
            $stmt->execute();
            $ouvrages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($ouvrages as $ouvrage) {
                $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_mb=:id_mb AND id_ov=:id_ov");
                $stmt->bindParam(':id_mb', $id_mb);
                $stmt->bindParam(':id_ov', $ouvrage['id_ov']);
                $stmt->execute();
                $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);

                echo " <div> 
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
                      
                         </div> 
                         </div> 
                         </div> ";

            }


            ?>
        </div>
    </div>
 
    <script src="../script.js"></script>
</body>

</html>