<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<?php require '../templates/header.html' ?>
	<?php require '../templates/navbar.php' ?>

	<section class="row">
		<div class="left15">
			<p>esquerda</p>
		</div>
	
		<div class="main70">
      <div class="container">
        <div class="inside-container">
          <img src="../assets/img/dog.jpg" class="display-pet">
          <div class="display-topleft display-hover">
            <button class="button-heart"><i class="fa fa-heart"></i></button>
          </div>
        </div>
        <p>Doggo 1<br><b>€29.99</b></p>
      </div>			
			<div class="display-topleft display-hover">
				<button class="button-heart"><i class="fa fa-heart"></i></button>
			</div>
		</div>
	
		<div class="right15">
			<p>direita</p>
		</div>
	</section>
</body>

<?php require '../templates/footer.html'; ?>

</html>