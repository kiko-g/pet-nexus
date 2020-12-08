<?php require 'templates/head.php'; default_head('Pet Nexus'); ?>

<body>
  <header class="header">
    <h1>Pet Nexus</h1>
    <p>A <b>petfinder</b> website</p>
  </header>

  <?php require 'templates/navbar.html'; ?>

  <div class="row">
    <div class="side">
    </div>

    <div class="main">  
      <div class="col w25 w50">
        <div class="container">
          <div class="inside-container">
            <img src="assets/img/dog.jpg" class="display-pet">
            <div class="display-topleft display-hover">
              <button class="button-heart"><i class="fa fa-heart"></i></button>
            </div>
            <div class="display-bottomright display-hover">
              <button class="button-cart"> <i class="fa fa-shopping-cart"></i></button>
            </div>
          </div>
          <p>Doggo 1<br><b>€29.99</b></p>
        </div>
      </div>      
    </div>
  </div>

  <?php require 'templates/footer.html'; ?>
</body>
</html>