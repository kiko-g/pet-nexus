<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <div class="left15"></div>
    <div class="main70 nopad">
      <div class="grid-gallery">
        <h2 class="center">Popular pets</h2>
        <div class="posts centered">
          <?php
            require_once("../database/db_class.php");
            $dbc = Database::instance()->db();
  
	    $qry_str = 'SELECT dogs.*, favorites.id as favorite_id FROM dogs LEFT JOIN favorites ON dogs.id=dog_id';
	    $execute_array = array();

	    if(isset($_SESSION['id'])){
		    $qry_str .= ' AND favorites.user_id = ?';
		    array_push($execute_array, $_SESSION['id']);
	    }

            $stmt = $dbc->prepare($qry_str);
            $stmt->execute($execute_array);
            $pets = $stmt->fetchAll();
            $i = 0;
            foreach ($pets as $index => $entry) { 
              $i++;
          ?>
            
            <div class="posts-item">
              <div class="posts-container">
                <div class="posts-inside-container">
                  <img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
                  <div class="fav-button">
		<?php if(isset($_SESSION['id'])){
		?>
		  <button id="fav-<?= $entry['id'] ?>" class="button-heart" onclick="fill(this)">
			  <i class="fa <?= (is_null($entry['favorite_id']) ? 'fa-heart-o' : 'fa-heart')?> pink big" aria-hidden="true"></i>
                    </button>
		<?php } ?>
                  </div>
                  <div class="photo-stats">
                    <i class="fa fa-heart pink" aria-hidden="true"></i> 32
                    <i class="fa fa-question-circle blue" aria-hidden="true"></i> 3
                  </div>
                </div>
                <a href="item.php?id=<?= $entry['id'] ?>">
                  <p><?= $entry['listing_name']?></p>
                </a>
              </div>
            </div>
          <?php }  ?>
        </div>
      </div>
    </div>
    <div class="right15"></div>
  </article>
  <?php require '../templates/footer.html'; ?>
</body>

</html>
