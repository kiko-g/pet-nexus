<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <div class="left20">
      <div class="colorsFilter">
        <label>Colors</label>
        <button class="colorButton black"></button>
        <button class="colorButton white"></button>
        <button class="colorButton brown"></button>
        <button class="colorButton gray"></button>
        <button class="colorButton cream"></button>
      </div>
      <div class="sizeFilter">
        <label for="dog_size">Size</label>
        <select id="dog_size" name="Dog Size">
          <option disabled selected value> Size </option>
          <option value="tiny">Tiny</option>
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
        </select>
      </div>
      <div class="ageFilter">
        <label for="dog_age">Age</label>
        <select id="dog_age" name="Dog Age">
          <option disabled selected value> Age </option>
          <option value="newborn">Newborn</option>
          <option value="puppy">Puppy</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
          <option value="huge">Huge</option>
        </select>
      </div>      
    </div>

    <div class="right80">      
      <form>
        <input type="search" placeholder="Search">
      </form>
      <div class="grid-gallery">
        <h2>Pets for adoption</h2>
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
                  <img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
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
      </div>
    </div>
  </article>
  <?php require '../templates/footer.html'; ?>

</body>

</html>
