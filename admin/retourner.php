<?php
require_once '../includes/dbh.inc.php';
session_start();
// error_reporting(E_ERROR | E_PARSE);
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
    <!-- Header -->
    <header>
        <div class="container">
            <div class="intro-text">
                <div class="intro-lead-in">Bonjour </div>
                <div class="intro-heading">Bien venue a ton espace adhérent.</div>
            </div>
        </div>
    </header>
    <div class="ms-5 d-flex flex-column  justify-content-center align-items-center  ">
        <h2 class="mt-4">Retour d'ouvrage </h2>
        <form class="mt-2 mx-5" action="" class='d-flex' method="GET">
            <input type="text" name="code_res" id="	nom_adm" class="rounded-pill p-1 my-3 border border-4  p-2 "
                placeholder="Code de réeservation ... ">
            <input type="submit" name="rechercher_ov" value="Chercher" class="button  btn  btn-lg  rounded-pill ">
        </form>
    </div>

    <div class="container d-flex justify-content-center align-items-center">

        <?php

        if (isset($_GET['code_res'])) {
            $code_res = $_GET['code_res'];

            $stmt = $pdo->prepare("SELECT * FROM ouvrage WHERE id_ov IN (SELECT id_ov FROM reservation WHERE code_res=:code_res)");
            $stmt->bindParam(':code_res', $code_res);
            $stmt->execute();

            $ouvrage = $stmt->fetch(PDO::FETCH_ASSOC);


            if ($ouvrage) {
                echo "
         
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
<form method='POST' >
<input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
<button type='submit' name='Retourner' class='book-card-button'>Retourner </button>
</form>
        </div>
    </div>
   
    ";
            } else {
                echo " <br><span class='error text-danger mt-5 '>Ce code de réservation n'existe pas </span> <br>";
            }
            if (isset($_POST['Retourner'])) {
                $stmt = $pdo->prepare("
                        SELECT r.*, o.titre_ov, e.date_retour
                        FROM reservation r
                        INNER JOIN ouvrage o ON o.id_ov = r.id_ov
                        INNER JOIN emprunt e ON e.id_res = r.id_res
                        WHERE r.code_res = :code_res
                    ");
                $stmt->bindParam(':code_res', $code_res);
                $stmt->execute();

                $reservation = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($reservation) {
                    if ($reservation['validation_res'] == 2) {
                        echo "<script> alert('Ce emprunt a deja etais retourner')</script>";
                    } else {
                        $stmt = $pdo->prepare("UPDATE reservation SET validation_res = 2 WHERE code_res = :code_res");
                        $stmt->bindParam(':code_res', $code_res);
                        $stmt->execute();

                        // Get the id_res of the reservation
                        $id_res = $reservation['id_res'];

                        // Update the date_eff column in the emprunt table
                        $stmt2 = $pdo->prepare("UPDATE emprunt SET date_eff = NOW() WHERE id_res = :id_res");
                        $stmt2->bindParam(':id_res', $id_res);
                        $stmt2->execute();


                        // Compare date_eff and date_retour and update penalite_mb if necessary
                        $date_eff = new DateTime();
                        $date_retour = new DateTime($reservation['date_retour']);
                        if ($date_eff > $date_retour) {
                            $stmt3 = $pdo->prepare("UPDATE membre SET penalite_mb = penalite_mb + 1 WHERE id_mb = :id_mb");
                            $stmt3->bindParam(':id_mb', $reservation['id_mb']);
                            $stmt3->execute();
                        }
                        header("Location:./accueil.php");
                    echo "L'ouvrage a ete retournre avec succee ";

                    }
                }
            }
        }
        ?>
       
    </div>

    <script src="../script.js"></script>
</body>

</html>