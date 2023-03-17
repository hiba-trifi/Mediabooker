<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);

if (isset($_POST["inscription"])) {
    $nom = $_POST["nom"];
    $surnom = $_POST["surnom"];
    $tel = $_POST["tel"];
    $address = $_POST["address"];
    $date_n = $_POST["date_n"];
    $type = $_POST["type"];
    $cin = $_POST["cin"];
    $email = $_POST["email"];
    $mot_pass = $_POST["mot_pass"];
    $cnf_mot_pass = $_POST["cnf_mot_pass"];

    $errors = array();

    if (!preg_match("/^[a-zA-Z-' ]*$/", $nom) or strlen($nom) < 3) {
        $errors["nom"] = "Le nom doit contenir plus que trois lettres";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $surnom) or strlen($surnom) < 3) {
        $errors["surnom"] = "Le surnom doit contenir plus que trois lettres";
    } elseif (!preg_match("/^[a-zA-Z-' ]*$/", $address) or strlen($address) < 4) {
        $errors["address"] = "Veuillez saisir une adresse correcte";
    } elseif (!isset($date_n) or empty($date_n)) {
        $errors["date_n"] = "Veuillez saisir la date de naissance";
    } elseif (!isset($type) or empty($type)) {
        $errors["type"] = "Veuillez saisir un type";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Veuillez saisir un email correct";
    } elseif (!preg_match("/^[a-zA-Z]{2}\d{4}$/", $cin)) {
        $errors["cin"] = "Le C.I.N doit être composé de 2 lettres suivies de 4 chiffres.";
    } elseif (!preg_match("/^[0-9]*$/", $tel) or strlen($tel) < 9 or strlen($tel) > 11) {
        $errors["tel"] = "Veuillez saisir un téléphone correct";
    } else {
        $check_email_query = "SELECT COUNT(*) FROM membre WHERE email_mb = :email";
        $stmt = $pdo->prepare($check_email_query);
        $stmt->execute(['email' => $email]);
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $errors["exist_mail"] = "Cet email existe déjà, veuillez saisir un autre";
        } elseif ($mot_pass != $cnf_mot_pass) {
            $errors["confirm_mot_pass"] = "Vous n'avez pas saisi le même mot de passe";
        } else {
            $mot_pass = password_hash($mot_pass, PASSWORD_DEFAULT);
            $ajout_membre = "INSERT INTO `membre` (`nom_mb`, `surnom_mb`, `tel_mb` ,`adresse_mb`,`dateN__mb`,`type_mb`,`cin_mb`, `email_mb`, `mdp_mb` , `date_cmt` ) VALUES (:nom,:surnom,:tel,:address,:date_n, :type , :cin ,  :email, :mot_pass , NOW())";
            $stmt = $pdo->prepare($ajout_membre);
            $stmt->execute(['nom' => $nom, 'surnom' => $surnom, 'tel' => $tel, 'address' => $address, 'date_n' => $date_n, 'type' => $type, 'cin' => $cin, 'email' => $email, 'mot_pass' => $mot_pass]);
            $_SESSION["Email"] = $email;
            $_SESSION["Id"] = $pdo->lastInsertId();
            $_SESSION["nom"] = $nom;
            $_SESSION["surnom"] = $surnom;
            $_SESSION["MotPasse"] = $mot_pass;
            $_SESSION["tel"] = $tel;

            header("Location:./accueil.php");

        }
    }

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


    <nav class="navbar navbar-expand-lg mb-1 ">

        <div class="container_nav rounded container">
            <img class="navbar-brand " src="../logo/logo.png" alt="">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span> <br>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav  ">
                    <li class="nav-item mx-3 fw-bold fs-5  ">
                        <a class="nav-link text-light" href="./landing_page_user.php">Réseaux sociaux</a>
                    </li>
                    <li class="nav-item mx-3 fw-bold fs-5  ">
                        <a class="nav-link text-light" href="./landing_page_user.php">Galerie</a>
                    </li>
                    <li class="nav-item mx-3  fw-bold fs-5  ">
                        <a class="nav-link  text-light" aria-current="page" href="./landing_page_user.php">À propos</a>
                    </li>
                    <a href="./landing_page_user.php" class="button  btn  btn-lg  rounded-pill mx-5 "><i
                            class="fa-solid fa-arrow-left"></i></a>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container d-flex justify-content-center">

        <div class="log_in rounded ">

            <div class="form_bkg  ">
                <?php if (!empty($errors)): ?>
                    <div class="alert alert-danger p-0 mx-5" role="alert">
                        <h4 class="alert-heading">Erreur!</h4>
                        <ul>
                            <?php foreach ($errors as $error): ?>
                                <li>
                                    <?php echo $error; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <h2 class="text-center pt-5  ">Bienvenue</h2>

                <form class=" mx-5" action="" method="POST">
                    <label class="mt-5 fs-4" for="nom"> nom : </label>
                    <input type="text" name="nom" id="nom" class="form_input mt-4 ">


                    <label class="mt-5 fs-4" for="surnom"> Surnom : </label>
                    <input type="text" name="surnom" id="surnom" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="tel"> N° de teletéléphone : </label>
                    <input type="tel" name="tel" id="tel" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="address"> Address : </label>
                    <input type="text" name="address" id="address" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="date_n"> Date de Naissance : </label>
                    <input type="date" name="date_n" id="date_n" class="form_input mt-4 ">


                    <label class="mt-5 fs-4" name="type" for="type"> Type : </label>
                    <select class="mt-5" name="type" aria-label="Default select example">
                        <option value="none">Choisie un Type </option>
                        <option value="Etudiant">Etudiant</option>
                        <option value="Fonctionnaire">Fonctionnaire</option>
                        <option value="Employé">Employé</option>
                        <option value="Femme_au_foyer">Femme au foyer</option>
                    </select>


                    <label class="mt-5 fs-4" for="cin"> C.I.N : </label>
                    <input type="text" name="cin" id="cin" class="form_input mt-4 ">


                    <label class="mt-5 fs-4" for="email"> Email : </label>
                    <input type="email" name="email" id="email" class="form_input mt-4 ">


                    <label class="mt-5  fs-4" for="psw"> Mot de passe : </label>
                    <input type="password" name="mot_pass" id="psw" class="form_input mt-4 ">


                    <label class="mt-5  fs-4" for="psw">Confirmer le Mot de passe : </label>
                    <input type="password" name="cnf_mot_pass" id="psw" class="form_input mt-4 ">



                    <div class=" d-flex flex-column justify-content-center align-items-center mt-5 ">
                        <input type="submit" name="inscription" value="S'inscrire"
                            class="button  btn  btn-lg w-25 my-5  rounded-pill ">
                        <div class="d-flex">
                            <p class="form_info">Avez vous déjà un compte ?</p>
                            <a class="form_toogle mx-2" href="connecter.php">Connectez-vous ici</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

    <script src="../script.js"></script>
</body>

</html>