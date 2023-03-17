<?php
require_once '../includes/dbh.inc.php';
session_start();
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);
$id_adm = $_SESSION["Id_adm"];
if (isset($_POST["ajouter"])) {

    $titre_ov = $_POST["titre_ov"];
    $auteur_ov = $_POST["auteur_ov"];
    $dateEdt_ov = $_POST["dateEdt_ov"];
    $date_achat_ov = $_POST["date_achat_ov"];
    $page_ov = $_POST["page_ov"];
    $type_ov = $_POST["type_ov"];
    $etat_ov = $_POST["etat_ov"];

    // Check if the uploaded file is an image
    if (getimagesize($_FILES['image']['tmp_name']) !== false) {
        $image_name = uniqid() . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $image_path = '../img/' . $image_name;
        move_uploaded_file($_FILES['image']['tmp_name'], $image_path);
    }



    $sql = "INSERT INTO `ouvrage` (`titre_ov`, `auteur_ov`, `dateEdt_ov` ,`date_achat_ov`,`page_ov`,`type_ov`, `etat_ov` , `id_adm` , `img_ov` ) VALUES (:titre_ov, :auteur_ov, :dateEdt_ov, :date_achat_ov, :page_ov, :type_ov , :etat_ov , :id_adm , :image_path)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_adm', $id_adm);
    $stmt->bindParam(':titre_ov', $titre_ov);
    $stmt->bindParam(':image_path', $image_path);
    $stmt->bindParam(':auteur_ov', $auteur_ov);
    $stmt->bindParam(':dateEdt_ov', $dateEdt_ov);
    $stmt->bindParam(':date_achat_ov', $date_achat_ov);
    $stmt->bindParam(':page_ov', $page_ov);
    $stmt->bindParam(':type_ov', $type_ov);
    $stmt->bindParam(':etat_ov', $etat_ov);
    $stmt->execute();
    header("Location:./accueil.php");
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
    <title>Ajouter un ouvage</title>
</head>

<body>


<?php
    require_once './head.php';
    ?>
   
    <div class="container d-flex justify-content-center my-5">
        <div class="log_in rounded ">
            <div class="form_bkg  ">
                <h2 class="text-center py-5  ">Ajouter un ouvrage</h2>
                <form class="mt-5 mx-5" action="" method="POST" enctype="multipart/form-data">
                    <label class="mt-5 fs-4" for="titre_ov"> Titre : </label>
                    <input type="text" name="titre_ov" id="	titre_ov" class="form_input mt-4  ">


                    <label for="" class="custom-file-upload mt-5 fs-4"> Image de couverture : </label> <br>
                    <label for="image" class="custom-file-upload" style="color:var(--brown-color);"><i
                            class="fa fa-plus"></i></label>
                    <input class="visually-hidden" enctype="multipart/form-data" type="file" name="image" id="image"
                        class="form_input mt-4">
                    <img class="visually-hidden" enctype="multipart/form-data" id="image-preview" src=""
                        alt="Image Preview" width="200"><br>

                    <label class="mt-5 fs-4" for="auteur_ov"> Auteur : </label>
                    <input type="text" name="auteur_ov" id="auteur_ov" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="dateEdt_ov"> Date d'edition : </label>
                    <input type="date" name="dateEdt_ov" id="dateEdt_ov" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="date_achat_ov"> Date d'achat : </label>
                    <input type="date" name="date_achat_ov" id="date_achat_ov" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" for="page_ov"> Nombre de page : </label> <span>if it is availavle</span>
                    <input type="number" min="0" name="page_ov" id="page_ov" class="form_input mt-4 ">

                    <label class="mt-5 fs-4" name="type_ov" for="type_ov"> Type : </label>
                    <select class="mt-5" name="type_ov" aria-label="Default select example">
                        <option value="none">Choisie un Type </option>
                        <option value="Livre ">Livre </option>
                        <option value="Revue">Revue</option>
                        <option value="Roman ">Roman </option>
                        <option value="CD">CD</option>
                        <option value="DVD ">DVD </option>
                        <option value="Mémoire de recherche">Mémoire de recherche</option>
                        <option value="Magazine">Magazine</option>
                        <option value="Cassettes vidéo">Cassettes vidéo</option>
                    </select>


                    <label class="mt-5 fs-4" name="etat_ov" for="etat_ov"> Etat : </label>
                    <select class="mt-5" name="etat_ov" aria-label="Default select example">
                        <option value="none">Choisie un Type </option>
                        <option value="Neuf">Neuf</option>
                        <option value="Bon état">Bon état</option>
                        <option value="Acceptable  ">Acceptable </option>
                        <option value="Assez usé  ">Assez usé </option>
                        <option value="Déchiré">Déchiré</option>

                    </select>

                    <div class=" d-flex flex-column justify-content-center align-items-center mt-5 ">
                        <input type="submit" name="ajouter" value="Ajouter"
                            class="button  btn  btn-lg w-25 my-5  rounded-pill ">

                    </div>
                </form>
            </div>
        </div>

    </div>
    <?php
    // Check if the form has been submitted
    if (isset($_POST['submit'])) {

    }
    ?>
    <!-- 
<form method="post" enctype="multipart/form-data">
  <input type="file" name="image">
  <input type="submit" name="submit" value="Upload">
</form> -->

    <script>

        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('image-preview');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.addEventListener('load', function () {
                    imagePreview.setAttribute('src', reader.result);
                    imagePreview.classList.remove('visually-hidden'); // Remove the class when image is loaded
                });
                reader.readAsDataURL(file);
            } else {
                imagePreview.setAttribute('src', '');
                imagePreview.classList.add('visually-hidden'); // Add the class when image is removed
            }
        });
    </script>
    <script src="../script.js"></script>
</body>

</html>