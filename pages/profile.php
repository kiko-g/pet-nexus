<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

// Verify if user is logged in
if (!isset($_SESSION['id'])){
	die(header('Location: login.php'));
}



require_once("../database/db_class.php");
$dbc = Database::instance()->db();
$stmt = $dbc->prepare('SELECT username FROM users WHERE id = ?');
$stmt->execute(array($_SESSION['id']));

$username = $stmt->fetch()['username'];

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
					<code class="profile-user-name"> <?=$username?> </code>
					<button onclick="document.getElementById('change-popup').style.display='block'" class="profile-settings-button" aria-label="profile settings"><i class="fas fa-edit" aria-hidden="true"></i></button>
						<p class="profile-real-name">Pet Nexus Admin</p>
				</div>
				
				<?php
					
				   $change_form = new FormCreator('change-popup', '../actions/action_change_creds.php', true);
				   $change_form->add_input("username", "Username", "text", "Enter username", true, $username);
				   $change_form->add_input("old_password", "Old assword", "password", "Enter old password", true);
				   $change_form->add_input("new_password", "New password", "password", "Enter new password", false);
				   $change_form->inline();
				?>
			

			</div>
		</section>
	</header>

	<section>
		<div class="grid-container">
			<h1>Pet Listings</h1>
			<div class="posts">

				<?php
				
					$stmt = $dbc->prepare("SELECT pets_for_adoption.* FROM pets_for_adoption JOIN users ON pets_for_adoption.user_id=id WHERE users.username = ?");
					$stmt->execute(array($username));
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
