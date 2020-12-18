<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <?php require '../includes/social.php' ?>
  <article class="row"> <!-- row-padding -->
    <div class="left15"></div>
    <div class="main70 nopad">
      <div class="grid-gallery">
        <h2 class="center">Latest pets</h2>
        <div class="posts centered">
          <?php
            require_once("../database/db_class.php");
            $dbc = Database::instance()->db();
  
	    $qry_str = 'SELECT dogs.*, favorites.id as favorite_id FROM dogs LEFT JOIN favorites ON dogs.id=dog_id ';
	    $execute_array = array();

	    if(isset($_SESSION['id'])){
		    $qry_str .= ' AND favorites.user_id = ?';
		    array_push($execute_array, $_SESSION['id']);
	    }
	    else{
		    $qry_str .= ' AND favorites.user_id IS NULL ';
	    }

            $qry_str .= 'WHERE is_adopted = 0 ORDER BY id DESC LIMIT 5';
            $stmt = $dbc->prepare($qry_str);
            $stmt->execute($execute_array);
            $pets = $stmt->fetchAll();
            $i = 0;
	    $dog_socials = get_dogs_socials($pets);
            foreach ($pets as $index => $entry) { 
              $i++;
	      draw_pet_card($entry, $dog_socials, $i);
           }  ?>
        </div>
      </div>
    </div>
    <div class="right15"></div>
  </article>
  <?php require '../templates/footer.html'; ?>
</body>

</html>
