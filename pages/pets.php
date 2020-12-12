<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <section class="left20">
      <div class="coloredButtons">
        <label for="coloredButtons">Colors</label>
        <button class="colorButton black"></button>
        <button class="colorButton white"></button>
        <button class="colorButton brown"></button>
        <button class="colorButton gray"></button>
        <button class="colorButton cream"></button>
      </div>
      <div>
        <label for="dog_size">Size</label>
        <select name="Dog Size dropdown" id="dog_size">
          <option value="none"></option>
          <option value="tiny">Tiny</option>
          <option value="small">Small</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
        </select>
      </div>
      <div>
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
      <?php

      require_once("../database/db_class.php");
      $dbc = Database::instance()->db();

      $stmt = $dbc->prepare("SELECT * FROM dogs");
      $stmt->execute();
      $pets = $stmt->fetchAll();
      error_log(print_r($pets, true));
      foreach ($pets as $index => $entry) { ?>
      
      <div class="col w25 w50">
        <div class="container">
          <div class="inside-container">
            <img src="<?=$entry['listing_picture']?>" class="display-pet">
            <div class="display-topleft display-hover">
              <button class="button-heart"><i class="fa fa-heart"></i></button>
            </div>
            <div class="display-bottomright display-hover">
              <button class="button-cart"> <i class="fa fa-shopping-cart"></i></button>
            </div>
          </div>
          <p><?=$entry['listing_name']?><br><b>€29.99</b></p>
        </div>
      </div>
      <?php }  ?>

    </section>
  </article>
</body>

<?php require '../templates/footer.html'; ?>

</html>