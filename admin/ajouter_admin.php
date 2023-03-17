<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
$errors = array();

if (isset($_POST["ajouter_adm"])) {
    $nom_adm = $_POST["nom_adm"];
    $email_adm = $_POST["email_adm"];
    $mdp_adm = $_POST["mdp_adm"];
    if (!preg_match("/^[a-zA-Z-' ]*$/", $nom_adm) or strlen($nom_adm) < 3) {
        $errors["nom"] = "Le nom doit contenir plus que trois lettres";
    } elseif (!filter_var($email_adm, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Veuillez saisir un email correct";
    } 
    $mdp_adm = password_hash($mdp_adm, PASSWORD_DEFAULT);
    $ajoute_ov = "INSERT INTO `admin` (`nom_adm`, `email_adm`, `mdp_adm` ) VALUES (:nom_adm, :email_adm, :mdp_adm)";
    $stmt = $pdo->prepare($ajoute_ov);
    $stmt->bindParam(':nom_adm', $nom_adm);
    $stmt->bindParam(':email_adm', $email_adm);
    $stmt->bindParam(':mdp_adm', $mdp_adm);
    $stmt->execute();

    header("Location:./accueil.php");
}
if (!empty($errors)) {
    echo "<div class='alert alert-danger'>";
    echo "<ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul>";
    echo "</div>";
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/62ff79fbfd.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../main-css.css">
    <link rel="shortcut icon" href="../logo/logo.png" type="image/x-icon">
    <title>Se connecter</title>
</head>

<body>

<?php
    require_once './head.php';
    ?>
   
    <div class="container d-flex justify-content-center my-5">
        <div class="log_in rounded ">
            <div class="form_bkg  ">
                <h2 class="text-center py-5  ">Ajouter un Admin </h2>
                <form class="mt-5 mx-5" action="" method="POST">
                    <label class="mt-5 fs-4" for="nom_adm"> Nom : </label>
                    <input type="text" name="nom_adm" id="	nom_adm" class="form_input mt-4  ">

                    
                    <label class="mt-5 fs-4" for="email_adm"> Email : </label>
                    <input type="email" name="email_adm" id="email_adm" class="form_input mt-4 " >

                    <label class="mt-5  fs-4" for="mdp_adm"> Mot de passe : </label>
                    <input type="password" name="mdp_adm" id="mdp_adm" class="form_input mt-4 " >



                    <div class=" d-flex flex-column justify-content-center align-items-center mt-5 ">
                        <input type="submit" name="ajouter_adm" value="Ajouter" class="button  btn  btn-lg w-25 mt-5  rounded-pill ">

                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="../script.js"></script>
</body>

</html>