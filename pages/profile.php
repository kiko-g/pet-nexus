<?php require_once '../includes/session.php'; 

if(!isset($_SESSION['id']) && !isset($_GET['id'])){
  header('Location: ../index.php');
  return;
}

$id = null;

if(isset($_GET['id'])){
	$id = $_GET['id'];
}
else {
  $id = $_SESSION['id'];
}

require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

require_once("../database/db_class.php");
$dbc = Database::instance()->db();
$stmt = $dbc->prepare('SELECT username FROM users WHERE id = ?');
$stmt->execute(array($id));

$username = $stmt->fetch()['username'];
?>

<body>
	<?php require '../templates/header.html' ?>
	<?php require '../templates/navbar.php' ?>
	<header>
		<div class="grid-gallery">
			<div class="profile">
				<div class="profile-image">
					<img src="../assets/img/logo.png" alt="profile-img">
				</div>

				<div class="profile-header">
					<code class="profile-user-name"> <?=$username?> </code>
					<?php 
						if($id == $_SESSION['id']) {
							
					?>
						<button onclick="document.getElementById('change-popup').style.display='block'" class="edit-button">
							<i class="fas fa-edit" aria-hidden="true"></i>
						</button>
					<?php
							$change_form = new FormCreator('change-popup', '../actions/action_change_creds.php', true);
							$change_form->add_input("username", "Username", "text", "Enter username", true, $username);
							$change_form->add_input("old_password", "Old password", "password", "Enter old password", true);
							$change_form->add_input("new_password", "New password", "password", "Enter new password", false);
							$change_form->inline();
						}
					?>
				</div>
				
			

			</div>
		</div>
	</header>

	<article class="grid-gallery">
		<h2 class="center"><slot><?=$username?>'s</slot> Listed Pets</h2>
		<div class="posts">
			<?php
				$stmt = $dbc->prepare('SELECT dogs.*, favorites.id as favorite_id FROM dogs LEFT JOIN favorites ON dogs.id=dog_id AND dogs.user_id = ? AND favorites.user_id = dogs.user_id');
				$stmt->execute(array($id));
				$pets = $stmt->fetchAll();
				$i = 0;
				foreach ($pets as $index => $entry) { 
					$i++;
			?>

			<div class="posts-item hover">
				<div class="posts-container">
					<div class="posts-inside-container">
						<img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
						<div class="fav-button">
		<?php if(isset($id)){
		?>
		  <button id="fav-<?= $entry['id'] ?>" class="button-heart" onclick="fill(this)">
			  <i class="fa <?= (is_null($entry['favorite_id']) ? 'fa-heart-o' : 'fa-heart')?> pink big" aria-hidden="true"></i>
                    </button>
		<?php } ?>
						</div>
						<div class="photo-stats">
							<i class="fa fa-heart pink" aria-hidden="true"></i> <?=12*$i ?>
							<i class="fa fa-question-circle blue" aria-hidden="true"></i> <?=1+$i ?>
						</div>
					</div>
				</div>
				<a class="post-caption" href="item.php?id=<?= $entry['id'] ?>">
					<p><?= $entry['listing_name']?></p>
				</a>
			</div>
			<?php } ?>
		</div>
	</article>
	<?php require '../templates/footer.html'; ?>
</body>

</html>
