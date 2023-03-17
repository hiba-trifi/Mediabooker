<?php
require_once '../includes/dbh.inc.php';
error_reporting(E_ERROR | E_PARSE);
session_start();
if (isset($_POST["connecter"])) {
    $email = $_POST["email"];
    $mot_pass = $_POST["mot_pass"];

    $errors = array();

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors["email"] = "Veuillez saisir un email correct";
    } elseif (empty($mot_pass)) {
        $errors["mot_pass"] = "Vous n'avez pas saisi le mot de passe correct";
    } else {
        $stmt_email = $pdo->prepare("SELECT * FROM admin WHERE email_adm = ?");
        $stmt_email->execute([$email]);
        $row_l = $stmt_email->fetch(PDO::FETCH_ASSOC);

        $stmt_mot_pass = $pdo->prepare("SELECT * FROM admin WHERE email_adm = ?");
        $stmt_mot_pass->execute([$email]);
        $row_p = $stmt_mot_pass->fetch(PDO::FETCH_ASSOC);

        if (!($row_l) || password_verify($mot_pass, $row_l["mdp_adm"]) === false) {
            $errors["mot_pass_inc"]  = " Mot de passe saisi est un incorrect";
        } else {
           
            header("Location:./accueil.php");
        }
    }
}
$_SESSION["Email_adm"] = $email;
$_SESSION["Id_adm"] = $row_l["id_adm"];

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
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
                <ul class="navbar-nav  ">
                    <a href="./landing_page_admin.php" class="button  btn  btn-lg  rounded-pill mx-5 "><i
                            class="fa-solid fa-arrow-left"></i></a>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container d-flex justify-content-center">
        <div class="log_in rounded ">
            <div class="form_bkg  ">
    
                <h2 class="text-center pt-5  ">Bievenue a ton espace Admin</h2>
                            
    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger p-0
         mx-5" role="alert">
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
                <form class=" mx-5" action="" method="POST">
                    <label class="mt-5 fs-4" for="email"> Email : </label>
                    <input type="email" name="email" id="email" class="form_input my-4">
                    <span class="error text-danger   mt-2">
                        <?php echo $email_err ?>
                    </span> <br>


                    <label class="mt-5  fs-4" for="psw"> Mot de passe : </label>
                    <input type="password" name="mot_pass" id="psw" class="form_input my-4">
                    <span class="error text-danger   mt-2">
                        <?php echo $mot_pass_err; ?>
                    </span> <br>


                    <div class=" d-flex flex-column justify-content-center align-items-center mt-5 ">
                        <input type="submit" name="connecter" value="Se connecter"
                            class="button  btn  btn-lg w-25 my-5  rounded-pill ">

                    </div>
                </form>
            </div>
        </div>

    </div>
    <script src="./script.js"></script>
</body>

</html>