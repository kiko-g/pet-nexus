<?php require '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus');
  

?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php'; ?>

  <section class="row">
    <section class="main"> 
      <div class="col w25 w50">
        <div class="container">
          <div class="inside-container">
            <img src="../assets/img/dog.jpg" class="display-pet">
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

      <div class="col w25 w50">
        <div class="container">
          <div class="inside-container">
            <img src="../assets/img/dog.jpg" class="display-pet">
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

      <div class="col w25 w50">
        <div class="container">
          <div class="inside-container">
            <img src="../assets/img/dog.jpg" class="display-pet">
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
    </section>
  </section>


  <?php require '../templates/footer.html'; ?>
</body>
</html>
