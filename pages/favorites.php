<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<?php require '../templates/header.html' ?>
	<?php require '../templates/navbar.php' ?>
	<section class="grid-gallery">
		<h2 class="center pink">Favorites</h2>
		<div class="posts">      
			<?php
				require_once("../database/db_class.php");
				$dbc = Database::instance()->db();

				$stmt = $dbc->prepare("SELECT dogs.*, favorites.id as favorite_id FROM dogs JOIN favorites ON dogs.id = favorites.dog_id 
					WHERE favorites.user_id = ?");
				$stmt->execute(array($_SESSION['id']));
				$pets = $stmt->fetchAll();
				$i = 0;
				foreach ($pets as $index => $entry) { 
					$i++;
			?>
				
				<div class="posts-item">
					<div class="posts-container">
						<div class="posts-inside-container">
							<img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
							<div class="fav-button">
								<button id="fav-<?= $entry['id'] ?>" class="button-heart" onclick="fill(this)">
									<i class="fa <?= (is_null($entry['favorite_id']) ? 'fa-heart-o' : 'fa-heart')?> pink big" aria-hidden="true"></i>
								</button>
							</div>
							<div class="photo-stats">
								<i class="fa fa-heart pink" aria-hidden="true"></i> 32
								<i class="fa fa-question-circle blue" aria-hidden="true"></i> 3
							</div>
						</div>
						<a href="item.php?id=<?= $entry['id'] ?>">
							<p><?= $entry['listing_name']?></p>
						</a>
					</div>
				</div>
			<?php }  ?>
		</div>
	</section>
	<?php require '../templates/footer.html'; ?>
	
</body>

</html>
