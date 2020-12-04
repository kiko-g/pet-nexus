<?php require 'templates/head.html'; ?>
<body>
  <header class="header">
    <h1>Pet Nexus</h1>
    <p>A <b>petfinder</b> website</p>
  </header>

  <?php require 'templates/navbar.php'; ?>

  <div class="row">
    <div class="side">
      <h2>Pets</h2>
      <div class="photo">
        <img src="/assets/img/dog.jpg" alt="dog" style="width: 100%;">
        <div class="image-container">
          <p>The cutest boy in town</p>
        </div>
      </div>
      <p>Pets pets pets!</p>
      <h3>More Pets</h3>
      <p>Dogs are cool.</p>
    </div>
    <div class="main">
      <h2>TITLE1 - DOGS RULE THE WORLD</h2>
      <h5>Title description</h5>
      <div class="photo">Image</div>
      <p>Some text...</p>
    </div>
  </div>

  <?php require 'templates/footer.html'; ?>
</body>

</html>