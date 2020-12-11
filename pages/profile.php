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
				
					$stmt = $dbc->prepare("SELECT * FROM dogs WHERE user_id = ?");
					$stmt->execute(array($_SESSION['id']));
					$pets = $stmt->fetchAll();
					error_log(print_r($pets, true));
					foreach ($pets as $index => $entry) { 
						
						?>
					
		
						<div class="col w25 w50">
							<div class="container">
								<div class="inside-container">
								<img src="<?= $entry['listing_picture']?>" class="display-pet">
									<div class="display-topleft display-hover">
										<button class="button-heart"><i class="fa fa-heart" aria-hidden="true"></i></button>
									</div>
									<div class="display-bottomright display-hover">
										<button class="button-cart"> <i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
									</div>
								</div>
								<p><?= $entry['listing_name']?><br></p>
							</div>
						</div>
					<?php } ?>


			</div>
		</div>
	</section>
	<?php require '../templates/footer.html'; ?>
</body>

</html>
