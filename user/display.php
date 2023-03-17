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
foreach ($ouvrages as $ouvrage) {
    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
    $stmt->execute([$ouvrage['id_ov']]);
    $reservation = $stmt->fetch();
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

    if ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
        echo " 

        <button disabled   class='book-card-button disabled '>Ouvrage Indisponible</button>
        </div>
        </div>";
    } else {
        echo "
                    <form method='POST' >
                        <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
                        <button type='submit' name='reserver' class='book-card-button'> Réserver</button>     
                    </form>
                    </div>
                    </div>";
    }


$stmt = $pdo->prepare("DELETE FROM reservation WHERE validation_res = 0 AND date_res < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$stmt->execute();

}





// $stmt = $pdo->prepare("SELECT titre_ov, auteur_ov, type_ov, etat_ov, dateEdt_ov, img_ov, COUNT(*) as count FROM ouvrage GROUP BY titre_ov, auteur_ov, type_ov, etat_ov, dateEdt_ov, img_ov");
// $stmt->execute();
// $ouvrages = $stmt->fetchAll();

// $last_title = '';

// foreach ($ouvrages as $ouvrage) {
//   $title = $ouvrage['titre_ov'];

//   if ($title != $last_title) {
//     // Display card for new book title
//     echo "
//     <div class='book-card'>
//       <div class='book-card-image'>
//         <img class='card_img' src='{$ouvrage['img_ov']}' alt='Book cover image'>
//       </div>
//       <div class='book-card-content'>
//         <h3 class='book-card-title'>{$ouvrage['titre_ov']} ({$ouvrage['count']})</h3>
//         <p class='book-card-author'>{$ouvrage['auteur_ov']}</p>
//         <p class='book-card-info'>
//           <span class='book-card-type'>{$ouvrage['type_ov']}</span>
//           <span class='book-card-status'>{$ouvrage['etat_ov']}</span>
//           <span class='book-card-edition'>{$ouvrage['dateEdt_ov']}</span>
//         </p>
//         <form method='POST'>
//           <input type='hidden' name='titre_ov' value='{$ouvrage['titre_ov']}' />
//           <button type='submit' name='reserver' class='book-card-button'>Réserver</button>
//         </form>
//       </div>
//     </div>
//     ";

//     $last_title = $title;
//   }
// }











// $previous_title = null;
// $book_count = 0;

// foreach ($ouvrages as $ouvrage) {
//     // Only display the title and book count for subsequent books with the same title
//     if ($ouvrage['titre_ov'] !== $previous_title) {
//         // If this isn't the first book, close the previous book card
//         if ($previous_title !== null) {
//             echo "
//                 <div class='book-card'>
//                     <div class='book-card-content'>
//                         <p class='book-card-info'>
//                             <span class='book-card-type'>$previous_title</span>
//                             <span class='book-card-status'>$book_count copies available</span>
//                         </p>
//                     </div>
//                 </div>
//             ";
//         }

//         // Reset the book count for the new title
//         $previous_title = $ouvrage['titre_ov'];
//         $book_count = 0;
//     }

//     $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
//     $stmt->execute([$ouvrage['id_ov']]);
//     $reservation = $stmt->fetch();

//     if (!$reservation || ($reservation['validation_res'] != '0' && $reservation['validation_res'] != '1')) {
//         // If the book is available, increment the book count
//         $book_count++;
//         echo "

//              <div class='book-card'>
//              <div class='book-card-image'>
//                <img class='card_img' src='$ouvrage[img_ov]' alt='Book cover image'>
//              </div>
//              <div class='book-card-content'>
//                <h3 class='book-card-title'> $ouvrage[titre_ov]</h3>
//                <p class='book-card-author'>$ouvrage[auteur_ov]</p>
//                <p class='book-card-info'>
//                  <span class='book-card-type' >$ouvrage[type_ov]</span>
//                  <span class='book-card-status'>$ouvrage[etat_ov]</span>
//                  <span class='book-card-edition'>$ouvrage[dateEdt_ov]</span>
//                </p>";

//         if ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
//             echo " 
        
//                 <button disabled   class='book-card-button disabled '>Ouvrage Indisponible</button>
//                 </div>
//                 </div>";
//         } else {
//             echo "
//                             <form method='POST' >
//                                 <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
//                                 <button type='submit' name='reserver' class='book-card-button'> Réserver</button>     
//                             </form>
//                             </div>
//                             </div>";
//         }
//     }
// }



// $ouvrages_grouped = array();

// foreach ($ouvrages as $ouvrage) {
//     $titre_ov = $ouvrage['titre_ov'];

//     if (!array_key_exists($titre_ov, $ouvrages_grouped)) {
//         // Create a new group for the current titre_ov
//         $ouvrages_grouped[$titre_ov] = array();
//     }

//     // Add the current ouvrage to its group
//     $ouvrages_grouped[$titre_ov][] = $ouvrage;
// }

// // Loop through the groups and display a single card for each titre_ov
// foreach ($ouvrages_grouped as $titre_ov => $ouvrages) {
//     $ouvrage = $ouvrages[0];

//     // Display the card for the first ouvrage in the group
//     // You can modify this to display more information from the other ouvrages in the group if you want
//     echo "
//      <form method='POST' > 
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

//     $reservation_found = false;

//     foreach ($ouvrages as $ouvrage) {
//         $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
//         $stmt->execute([$ouvrage['id_ov']]);
//         $reservation = $stmt->fetch();

//         if ($reservation && ($reservation['validation_res'] == '0' || $reservation['validation_res'] == '1')) {
//             $reservation_found = true;
//             break;
//         }
//     }
//     if (count($ouvrages_grouped[$titre_ov]) >= 1) {
//         echo "
//         <button disabled  class='book-card-button disabeld'>ALOTTTTT</button>
//         </form>
//         </div>
//                     </div>";
//     } elseif ($reservation_found) {
//         echo "
//         <button disabled  class='book-card-button disabeld'>Ouvrage Indisponible</button>
//         </form>
//         </div>
//                     </div>";
//     } else {
//         $ouvrage = $ouvrages[0];
//         echo "
//                     <form method='POST' >
//                         <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
//                         <button type='submit' name='reserver' class='book-card-button'> Réserver</button>     
//                     </form>
//                     </div>
//                     </div>";
//     }
// }

?>