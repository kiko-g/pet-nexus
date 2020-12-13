<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <section class="left20">
      <div class="colorsFilter">
        <label for="colorsFilter">Colors</label>
        <button class="colorButton black"></button>
        <button class="colorButton white"></button>
        <button class="colorButton brown"></button>
        <button class="colorButton gray"></button>
        <button class="colorButton cream"></button>
      </div>
      <div class="sizeFilter">
        <label for="dog_size">Size</label>
        <select name="Dog Size dropdown" id="dog_size">
          <option value="none"></option>
          <option value="tiny">Tiny</option>
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
        </select>
      </div>
      <div class="ageFilter">
        <label for="dog_age">Age</label>
        <select name="Dog Size dropdown" id="dog_size">
          <option value="none"></option>
          <option value="newborn">Newborn</option>
          <option value="puppy">Puppy</option>
          <option value="medium">Medium</option>
          <option value="big">Mature</option>
        </select>
      </div>      
    </section>

    <section class="right80">      
      <form>
        <input type="search" placeholder="Search">
      </form>
      <div class="grid-gallery">
        <h1 class="pink">My Listed Pets</h1>
        <div class="posts">      
          <?php
            require_once("../database/db_class.php");
            $dbc = Database::instance()->db();

            $stmt = $dbc->prepare("SELECT * FROM dogs");
            $stmt->execute();
            $pets = $stmt->fetchAll();
            foreach ($pets as $index => $entry) { ?>
            
            <div class="posts-item">
              <div class="posts-container">
                <div class="posts-inside-container">
                  <img src="<?= $entry['listing_picture']?>" class="posts-image">
                  <div class="fav-button">
                    <button class="button-heart"><i class="fa fa-heart" aria-hidden="true"></i></button>
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
      </section>
    </section>
  </article>
</body>

<?php require '../templates/footer.html'; ?>

</html>
