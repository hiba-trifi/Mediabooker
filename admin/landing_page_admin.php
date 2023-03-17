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
  <title>Admin</title>
</head>

<body>

  <!-- navbar -->
  <nav class="navbar_landing navbar navbar-expand-lg  fixed-top ">
    <div class="container">
      <img class="navbar-brand " src="../logo/logo.png" alt="">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item mx-3  fw-bold fs-5  ">
            <a class="nav-link " aria-current="page" href="#about">Interphase administrateur </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- background image  -->
  <div class="image-wrapper position-relative">
    <img class="  backround_admin" src="../logo/1.jpg" alt="">
    <div
      class="background-image-overlay position-absolute d-flex flex-column justify-content-center align-items-start  h-100  m-5">
      <div class=" fs-1 fw-bold text-light ">
        <h1 class="fs-1 fw-bold mt-5">MEDIA LIBRARY : ADMINISTRATEUR <i class="fa-solid fa-lock"></i></h1>

      </div>
      <a href="./connecter.php" class="button mt-4  btn  btn-lg  rounded-pill mx-5 ">Se connecter en tant qu'administrateur</a>
    </div>
  </div>
  <script src="../script.js"></script>

</body>

</html>