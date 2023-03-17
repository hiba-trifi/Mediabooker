<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
$id_mb = $_SESSION["Id"];
$stmt = $pdo->prepare("SELECT * FROM membre WHERE id_mb =:id_mb ");
$stmt->bindParam(':id_mb', $id_mb);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
$surnom = isset($_POST["surnom"]) ? $_POST["surnom"] : "";
$nom = isset($_POST["Nom"]) ? $_POST["Nom"] : "";
$adresse = isset($_POST["adresse"]) ? $_POST["adresse"] : "";
$tel = isset($_POST["tel"]) ? $_POST["tel"] : "";
$mot_pass = isset($_POST["mot_pass"]) ? $_POST["mot_pass"] : "";
$pass = password_hash($mot_pass, PASSWORD_DEFAULT);

if (isset($_POST["edit"])) {
    $stmt = $pdo->prepare("UPDATE `membre` SET `nom_mb`=:nom, `surnom_mb`=:surnom, `mdp_mb`=:pass, `tel_mb`=:tel , `adresse_mb`=:adresse WHERE id_mb=:id_mb ");
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':surnom', $surnom);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':tel', $tel);
    $stmt->bindParam(':id_mb', $id_mb);
    $stmt->execute();
    header('location:/accueil.php');
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

            <form action="" method="POST" class="p-5"
                style="background-color:var(--White-color);height:80vh;width:70% ;border-top-right-radius: 25px ; border-bottom-right-radius: 25px ;">

                <label class="mt-5 fs-4" for="email"> Email : </label>
                <input type="email" disabled name="email" id="email" class="form_input mt-2 "
                    value="<?php echo $row['email_mb'] ?>">

                <label class="mt-5 fs-4" for="surnom"> Surnom : </label>
                <input type="text" name="surnom" id="surnom" class="form_input mt-2 "
                    value="<?php echo $row['surnom_mb'] ?>">

                <label class="mt-5 fs-4" for="tel"> N° de teletéléphone : </label>
                <input type="tel" name="tel" id="tel" class="form_input mt-2 " value="<?php echo $row['tel_mb'] ?>">

                <label class="mt-5 fs-4" for="adresse"> adresse : </label>
                <input type="text" name="adresse" id="adresse" class="form_input mt-2 "
                    value="<?php echo $row['adresse_mb'] ?>">

                <label class="mt-5 fs-4" for="psw"> Changer le Mot de passe : </label>
                <input type="password" name="mot_pass" id="psw" class="form_input mt-2 ">

                <a class="" href="./edit_profile.php">
                    <input type="submit" name="edit" value="Editer" class="button btn btn-lg ms-5 my-5">
                </a>

            </form>
        </div>

    </div>

    <script src="../script.js"></script>
</body>

</html>