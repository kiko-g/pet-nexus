<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
  <div class="grid-gallery">
    <h1>Popular pets</h1>
    <button>Ola</button>
    <div class="posts">      
      <?php
        require_once("../database/db_class.php");
        $dbc = Database::instance()->db();

        $stmt = $dbc->prepare("SELECT * FROM dogs");
        $stmt->execute();
        $pets = $stmt->fetchAll();
        $i = 0;
        foreach ($pets as $index => $entry) { 
          $i++;
      ?>
        
        <div class="posts-item">
          <div class="posts-container">
            <div class="posts-inside-container">
              <img src="<?= $entry['listing_picture']?>" class="posts-image">
              <div class="fav-button">
                <button id="fav<?= $i ?>" class="button-heart" onclick="fill(<?= $i ?>)">
                  <i class="fa fa-heart-o pink big" aria-hidden="true"></i>
                </button>
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
  </article>
</body>

<?php require '../templates/footer.html'; ?>

</html>
