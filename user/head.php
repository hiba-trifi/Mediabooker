<!-- Header -->
<header>
    <div class="container">
        <div class="intro-text">
            <div class="intro-lead-in">Bonjour </div>
            <div class="intro-heading">Bien venue a ton espace adhérent.</div>
        </div>
    </div>
</header>
<!-- SIDEBAR -->
<nav class="main-menu ">
    <ul>
    <li>
            <a href="./accueil.php">
            <i class="fa-solid fa-house-user fa"></i>
                <span class="nav-text">
                   Accueil
                </span>
            </a>
        </li>

        <li >
            <a href="./edit_profile.php">
                <i class="fa-solid fa-user-pen fa"></i>
                <span class="nav-text">
                    Edit Profile
                </span>
            </a>
        </li>
        <li>
            <a href="./my_reservation.php">
            <i class="fa fa-solid fa-user-pen"></i>
                <span class="nav-text">
                    Mes reservations
                </span>
            </a>

        </li>
        <li >
            <a href="./my_emprunt.php">
            <i class="fa fa-solid fa-book-open-reader"></i>                <span class="nav-text">
                    Mes emprunts
                </span>
            </a>

        </li>
        <li>
            <a href="./history_emp.php">
            <i class="fa-solid fa-clock-rotate-left fa"></i>
                <span class="nav-text">
                    Historique des emprunts
                </span>
            </a>
        </li>
  

    </ul>

    <ul class="logout">
        <li>
            <a href="./deconnecter.php">
                <i class="fa fa-power-off fa-2x"></i>
                <span class="nav-text">
                    Se Déconnecter
                </span>
            </a>
        </li>
    </ul>
</nav>


    <!-- Notification sidbar start -->
    <div class="notification-sidebar">
        <div class="notification-header">
            <h3 class="text-danger">Notifications</h3>
            <button class="close-btn rounded-circle bg-danger">&times;</button>
        </div>
        <div class="notification-list">
            <ul>
                <?php
                $id_mb = $_SESSION["Id"];
                // Check if the user has a penalty
                $stmt = $pdo->prepare("SELECT penalite_mb FROM membre WHERE id_mb = :id_mb");
                $stmt->bindParam(':id_mb', $id_mb);
                $stmt->execute();
                $penalty = $stmt->fetchColumn();

                if ($penalty = 1) {
                    // Show the penalty notification
                    echo "<h5>Notification <i class='fas fa-bell text-danger'></i></h5> <li>Vous avez depasse le temp de retour d'un emprunt , vous aver 1 penalite  .</li>";
                } elseif ($penalty = 2) {
                    // Show the penalty notification
                    echo "<h5>Notification <i class='fas fa-bell text-danger'></i></h5> <li>Vous avez depasse le temp de retour d'un emprunt , vous aver 2 penalite . Attention ils vous reste 1 pinalite d'etre blocker  .</li>";
                } elseif ($penalty = 3) {
                    // Show the penalty notification
                    echo "<h5>Notification <i class='fas fa-bell text-danger'></i></h5> <li>Vous avez 3 pinalite vous , votre compte sera vrouile pour 30 jours .</li>";
                } else {
                    echo "Vous n'avez aucune notification";
                }
                ?>

            </ul>
        </div>
    </div>
    <div class="notification-icon">
        <i class="fas fa-bell"></i>
    </div>
    <!-- Notification sidbar end -->
    <!-- <script src="../mscript.js"></script> -->