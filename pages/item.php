<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<?php 
		require '../templates/header.html';
		require '../templates/navbar.php';
		require '../database/dogs.php';
		if(!isset($_GET['id'])){

			header('Location: ../index.php');
		}

		$dog_data = get_dog($_GET['id']);
	?>



	<section class="row">
		<div class="left15">
			<p>esquerda</p>
		</div>
	
		<div class="main70">
      <div class="container">
      <p><h2><?= $dog_data['listing_name'] ?></h2></p>
        <div class="inside-container">
		<img src="<?= $dog_data['listing_picture'] ?>" class="display-pet">
          <div class="display-topleft display-hover">
            <button class="button-heart"><i class="fa fa-heart"></i></button>
          </div>
        </div>
	<p><h3>Description</h3></p>
	<p><?= $dog_data['listing_description'] ?></p>
	<p>
	<h3>Dog details</h3>
	
	<strong>Color: </strong> <?= $dog_data['color_name'] ?><br>
	<strong>Age: </strong> <?= $dog_data['age_name'] ?><br>
	<strong>Gender: </strong> <?= $dog_data['gender_name'] ?><br>
	</p>
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
