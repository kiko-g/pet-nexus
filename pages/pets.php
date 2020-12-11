<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <header class="header">
  	<h1>Pet Nexus</h1>
  	<p>A <b>petfinder</b> website</p>
  </header>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <section class="left20">
    </section>

    <section class="right80">

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