<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<?php require '../templates/header.html' ?>
	<?php require '../templates/navbar.php' ?>
	<section class="grid-gallery">
		<h1 class="pink">Favorites</h1>

		<div class="posts">
			<div class="posts-item">
				<div class="posts-container">
					<div class="posts-inside-container">
						<img src="../assets/img/dog.jpg" class="posts-image">
						<div class="fav-button">
							<button class="button-heart"><i class="fa fa-heart" aria-hidden="true"></i></button>
						</div>
						<div class="photo-stats">
							<i class="fa fa-heart pink" aria-hidden="true"></i> 32
							<i class="fa fa-question-circle blue" aria-hidden="true"></i> 3
						</div>
					</div>
					<a href="item.php">
						<p>DOGGO<br>29.99€</p>
					</a>
				</div>
			</div>

			<div class="posts-item">
				<div class="posts-container">
					<div class="posts-inside-container">
						<img src="../assets/img/dog2.jpg" class="posts-image">
						<div class="fav-button">
							<button class="button-heart"><i class="fa fa-heart" aria-hidden="true"></i></button>
						</div>
						<div class="photo-stats">
							<i class="fa fa-heart pink" aria-hidden="true"></i> 32
							<i class="fa fa-question-circle blue" aria-hidden="true"></i> 3
						</div>
					</div>
					<a href="item.php">
						<p>DOGGO<br>29.99€</p>
					</a>
				</div>
			</div>			
		</div>
	</section>
</body>

<?php require '../templates/footer.html'; ?>

</html>