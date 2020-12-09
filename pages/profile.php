<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

// Verify if user is logged in
if (!isset($_SESSION['id']))
	die(header('Location: login.php'));
?>

<body>
	<header class="header">
    	<h1>Pet Nexus</h1>
    	<p>A <b>petfinder</b> website</p>
  	</header>
	<?php require '../templates/navbar.php' ?>
	<header>
		<section class="grid-container">
			<div class="profile">
				<div class="profile-image">
					<img src="../assets/img/logo.png">
				</div>

				<div class="profile-user-settings">
					<code class="profile-user-name"> <?=$_SESSION['username']?> </code>
					<button class="profile-settings-button" aria-label="profile settings"><i class="fas fa-edit" aria-hidden="true"></i></button>
						<p class="profile-real-name">Pet Nexus Admin</p>
				</div>

			</div>
		</section>
	</header>

	<section>
		<div class="grid-container">
			<h1>Pet Listings</h1>
			<div class="posts">

				<?php
				
					require_once("../database/db_class.php");
					$dbc = Database::instance()->db();
					$stmt = $dbc->prepare("SELECT * FROM pets_for_adoption WHERE user_id = ?");
					$stmt->execute(array($_SESSION['id']));
					$pets = $stmt->fetchAll();
					foreach ($pets as $pet) { 
						
						$stmt1 = $dbc->prepare("SELECT * FROM pets WHERE pet_id = ?");
						$stmt1->execute(array($pet['pet_id']));
						$pet_details = $stmt1->fetch();
						
						?>
					
						<div class="posts-item" tabindex="0">
							<img src="<?= $pet_details['pet_photo'] ?>"
							class="posts-image" alt="">
							<div class="posts-item-info">
								<ul>
									<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 15</li>
									<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 3</li>
								</ul>
							</div>
						</div> <?php
					}
				
				?>

				<div class="posts-item" tabindex="0">
					<img src="../assets/img/dog.jpg" class="posts-image" alt="">
					<div class="posts-item-info">
						<ul>
							<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart" aria-hidden="true"></i> 15</li>
							<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment" aria-hidden="true"></i> 3</li>
						</ul>
					</div>
				</div>

				<div class="posts-item" tabindex="0">
					<img src="../assets/img/dog2.jpg"
						class="posts-image" alt="">
					<div class="posts-item-info">
						<ul>
							<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart"
									aria-hidden="true"></i> 18</li>
							<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment"
									aria-hidden="true"></i> 2</li>
						</ul>
					</div>
				</div>

				<div class="posts-item" tabindex="0">
					<img src="../assets/img/header.jpg"
						class="posts-image" alt="">
					<div class="posts-item-info">
						<ul>
							<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart"
									aria-hidden="true"></i> 18</li>
							<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment"
									aria-hidden="true"></i> 2</li>
						</ul>
					</div>
				</div>
				
				<div class="posts-item" tabindex="0">
					<img src="../assets/img/header2.jpg"
						class="posts-image" alt="">
					<div class="posts-item-info">
						<ul>
							<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart"
									aria-hidden="true"></i> 18</li>
							<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment"
									aria-hidden="true"></i> 2</li>
						</ul>
					</div>
				</div>				
			</div>
		</div>
	</section>
	<?php require '../templates/footer.html'; ?>
</body>

</html>