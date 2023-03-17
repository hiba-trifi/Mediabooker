<?php
foreach ($ouvrages as $ouvrage) {
    $stmt = $pdo->prepare("SELECT * FROM reservation WHERE id_ov = ?");
    $stmt->execute([$ouvrage['id_ov']]);
    $reservation = $stmt->fetch();
    echo "
    <div class='book-card' data-aos='fade-up'>
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
              <div class='d-flex '>            
<form method='POST' class='mx-2' style='height:100px;'>
<input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
<button type='submit' name='suprimer' class='button btn btn-lg rounded-pill mt-3' ><i class='fa-solid fa-trash'></i></button>
</form>

<form method='POST' class='mx-2' action='./editer.php' style='height:100px;'>
            <input type='hidden' name='id_ov' value='$ouvrage[id_ov]' />
            <button type='submit' name='editer_btn' class='button btn btn-lg rounded-pill mt-3' ><i class='fa-solid fa-pen-to-square'></i></button>
            
        </form>
        </div>
            </div>
        </div>
        
    
    ";   
  
    }

    if (isset($_POST['suprimer'])) {
        $id_ov = $_POST['id_ov'];
        $stmt = $pdo->prepare("DELETE FROM reservation WHERE id_ov = :id_ov");
        $stmt->bindParam(':id_ov', $id_ov);
        $stmt->execute();
    
        $stmt = $pdo->prepare("DELETE FROM ouvrage WHERE id_ov = :id_ov");
        $stmt->bindParam(':id_ov', $id_ov);
        $stmt->execute();
    }
    
    

?>
