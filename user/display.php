<?php
function generateRandomCode($length)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $code = "";
    for ($i = 0; $i < $length; $i++) {
        $code .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $code;
}

if (isset($_POST['reserver'])) {
    require_once '../includes/dbh.inc.php';
    error_reporting(E_ERROR | E_PARSE);
    $id_mb = $_SESSION["Id"];
    $id_ov = $_POST['id_ov'];
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservation WHERE id_mb = ? AND (validation_res = '0' OR validation_res = '1')");
    $stmt->execute([$id_mb]);
    $num_reservations = $stmt->fetchColumn();
    if ($num_reservations >= 3) {
        echo "        
<div class='alert alert-danger alert-dismissible fade show mt-5 position-absolute top-0 start-50 translate-middle-x' role='alert'  data-tor-parent='hover'>
Vous aver reched la limite de reservation vous pouver emprunter et reserver que 3 livre a la fois 
<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close' ></button>
</div> ";
    } else {
        $date_res = date('Y-m-d H:i:s');
        $code_res = generateRandomCode(5); // generate a random code with 5 characters
        $stmt = $pdo->prepare("INSERT INTO reservation (id_mb, id_ov, date_res, validation_res, code_res) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id_mb, $id_ov, $date_res, 0, $code_res]);
    }
}
// foreach ($ouvrages as $ouvrage) {
//     $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
//     $stmt->execute([$ouvrage['id_ov']]);
//     $reservation = $stmt->fetch();
//     echo "

//     <div class='book-card'>
//     <div class='book-card-image'>
//       <img class='card_img' src='$ouvrage[img_ov]' alt='Book cover image'>
//     </div>
//     <div class='book-card-content'>
//       <h3 class='book-card-title'> $ouvrage[titre_ov]</h3>
//       <p class='book-card-author'>$ouvrage[auteur_ov]</p>
//       <p class='book-card-info'>
//         <span class='book-card-type' >$ouvrage[type_ov]</span>
//         <span class='book-card-status'>$ouvrage[etat_ov]</span>
//         <span class='book-card-edition'>$ouvrage[dateEdt_ov]</span>
//       </p>";

//     if ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
//         echo " 

//         <button disabled   class='book-card-button disabled '>Ouvrage Indisponible</button>
//         </div>
//         </div>";
//     } else {
//         echo "
//                     <form method='POST' >
//                         <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
//                         <button type='submit' name='reserver' class='book-card-button'> Réserver</button>     
//                     </form>
//                     </div>
//                     </div>";
//     }


// $stmt = $pdo->prepare("DELETE FROM reservation WHERE validation_res = 0 AND date_res < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
// $stmt->execute();

// }






foreach ($ouvrages as $ouvrage) {
    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
    $stmt->execute([$ouvrage['id_ov']]);
    $reservation = $stmt->fetch();

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM ouvrage WHERE titre_ov = ? AND id_ov != ?");
    $stmt->execute([$ouvrage['titre_ov'], $ouvrage['id_ov']]);
    $count = $stmt->fetchColumn();

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
              </p>";
if ($count > 0) {
            echo "
            <button type='button' class='book-card-button' data-bs-toggle='modal' data-bs-target='#exampleModal$ouvrage[id_ov]'>Voir les exemplaires</button> 
        </div>
        </div>";

         // modale 
echo"
<div class='modal fade' id='exampleModal$ouvrage[id_ov]' tabindex='-1' aria-labelledby='exampleModal$ouvrage[id_ov]Label' aria-hidden='true'>
<div class='modal-dialog modal-dialog-centered modal-dialog-scrollable '>
  <div class='modal-content'>
    <div class='modal-header'>
      <h5 class='modal-title' id='exampleModal$ouvrage[id_ov]Label'>Exemplaires de l'ouvrage</h5>
      <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
    </div>
    <div class='modal-body'>";

    $titre = $ouvrage['titre_ov'];
      $stmt = $pdo->prepare('SELECT * FROM ouvrage WHERE titre_ov = :titre');
    $stmt->bindValue(':titre', $titre);
    $stmt->execute();
    $books = $stmt->fetchAll(PDO::FETCH_ASSOC);
   
    foreach ($books as $book) {
        $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
        $stmt->execute([$book['id_ov']]);
        $reservation = $stmt->fetch();
        echo "
        <div class='book-card ' style='width:180px!important;height: 250px!important;'>
            <div class='book-card-image'>
              <img class='card_img' src='$book[img_ov]' alt='Book cover image'style='width:180px!important;height: 250px!important;'>
            </div>
            <div class='book-card-content'>
              <h4 class='book-card-title'> $book[titre_ov]</h4>
              <p class='book-card-info'>
                <span class='fs-5 book-card-status'>$book[etat_ov]</span>
                <span class='fs-5 book-card-status'>$book[id_ov]</span>
              </p>
     ";
     if ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
        echo " 
            <button disabled class='book-card-button disabled'>Ouvrage Indisponible</button>
        </div>
        </div>";
    } else {
        echo "
            <form method='POST'>
                <input type='hidden' name='id_ov' value='$book[id_ov]' />
                <button type='submit' name='reserver' class='book-card-button'> Réserver</button>
                </form>
                </div>
                </div>";
    }
    }
       echo "</div>
    <div class='modal-footer'>
      <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Fermer</button>
    </div>
  </div>
  </div>

</div>   
";   
        
        }
    elseif ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
        echo " 
            <button disabled class='book-card-button disabled'>Ouvrage Indisponible</button>
        </div>
        </div>";
    } else {
        echo "
            <form method='POST'>
                <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
                <button type='submit' name='reserver' class='book-card-button'> Réserver</button>
                </form>
                </div>
                </div>";
    }
 }
?>