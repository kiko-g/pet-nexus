<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>Pet Nexus</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Favicons -->
  <!-- <link href="/assets/img/dog.jpg" rel="icon"/> -->
  <link href="/assets/img/logo.png" rel="icon"/>
  

  <!-- Page Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/v4-shims.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <!-- Stylesheets -->
  <link rel="stylesheet" href="/style/pets.css">
  <link rel="stylesheet" href="/style/style.css">
  <link rel="stylesheet" href="/style/fonts.css">
  <link rel="stylesheet" href="/style/images.css">
  <link rel="stylesheet" href="/style/topnav.css">
  <link rel="stylesheet" href="/style/buttons.css">
  <link rel="stylesheet" href="/style/responsive.css">

  <!-- Scripts -->
  <script src="/js/topnav.js"></script>
</head>


<body>
  <header class="header">
    <h1>Pet Nexus</h1>
    <p>A <b>petfinder</b> website</p>
  </header>

  <div class="topnav" id="topnavbar">
    <a href="/index.php" class="no-border"> <i class="fas fa-home"></i> Home </a>
    <a href="/pages/profile.php" class=""> <i class="fas fa-user"></i> Profile </a>
    <a href="/pages/pets.php" class=""> <i class="fas fa-dog"></i> Breeds </a>
    <a href="/pages/register.php" class="right"> <i class="fas fa-user-plus"></i> Register </a>
    <a href="/pages/login.php" class="right"> <i class="fa fa-sign-in"></i> Login </a>
    <a href="#" class="a-search right"> <i class="fa fa-search"> </i> Search </a>
    <a href="#" class="a-heart right"> <i class="fa fa-heart"> </i> Favorites </a>
    <a href="javascript:void(0);" class="icon" onclick="topnavResponsive()"><i class="fa fa-bars"></i></a>
  </div>

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

  <?php require 'pages/pets.php'; ?>

  <footer>
    <img src="/assets/img/logo.png" alt="" class="footer-icon">
    <p>&copy; <strong>Pet Nexus</strong>, LTW 2020</p>
  </footer>
</body>

</html>