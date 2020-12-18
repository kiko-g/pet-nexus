<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

// Verify if user is logged in
if (!isset($_SESSION['id'])){
	die(header('Location: main.php'));
}



require_once("../database/db_class.php");
$dbc = Database::instance()->db();
$stmt = $dbc->prepare('SELECT username FROM users WHERE id = ?');
$stmt->execute(array($_SESSION['id']));

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
					<button onclick="document.getElementById('change-popup').style.display='block'" class="edit-button" aria-label="profile settings">
						<i class="fas fa-edit" aria-hidden="true"></i>
					</button>
				</div>
				
				<?php
					
				   $change_form = new FormCreator('change-popup', '../actions/action_change_creds.php', true);
				   $change_form->add_input("username", "Username", "text", "Enter username", true, $username);
				   $change_form->add_input("old_password", "Old password", "password", "Enter old password", true);
				   $change_form->add_input("new_password", "New password", "password", "Enter new password", false);
				   $change_form->inline();
				?>
			

			</div>
		</div>
	</header>

	<article class="row">
    <div class="left15"></div>
    
    <div class="main70 lesspad">
      <h2 class="center">My Proposals</h2>
      <div class="proposals">

		<?php 
			require_once("../database/db_class.php");
			$dbc = Database::instance()->db();

			$stmt = $dbc->prepare("SELECT proposals.id, proposal_text, buyer_id, users.username as buyer_username, listing_picture, listing_name, dog_id
				FROM proposals 
				JOIN users 
				ON buyer_id = users.id
				JOIN dogs
				ON dog_id = dogs.id
				WHERE seller_id = ? AND proposal_status = 0");
			$stmt->execute(array($_SESSION['id']));
			$proposals = $stmt->fetchAll(); 

			foreach($proposals as $index => $entry) {
		?>

				<div class="proposal-item">
					<div class="proposal-main">
						<img src="<?=$entry['listing_picture']?>" alt="">
						<div></div>
						<button class="yes" onclick="accept_proposal(<?=$entry['id']?>)">Yes <i class="fas fa-check" aria-hidden="true"></i></button>
						<button class="no" onclick="deny_proposal(<?=$entry['id']?>)">No <i class="fas fa-times" aria-hidden="true"></i></button>
					</div>
					<div class="proposal-description">
						<p><strong>Dog name</strong>: <a href="item.php?id=<?= $dog_id ?>"><?=$entry['listing_name']?></a></p>
						<p><strong>Proposal from</strong>: <a href="profile.php?id=<?=$entry['buyer_id']?>"><?=$entry['buyer_username'];?></a></p>
						<p><strong>Proposal description</strong>: <?=$entry['proposal_text']?></p>
					</div>
				</div>

		<?php } ?>
				<script> 
					let csrf_token = document.getElementById('csrf_token').innerHTML;

					function accept_proposal(proposal_id) {
						
						window.location.href = '../actions/action_accept_proposal.php?id=' + proposal_id + "&csrf=" + csrf_token
					}

					function deny_proposal(proposal_id) {
						window.location.href = '../actions/action_deny_proposal.php?id=' + proposal_id + "&csrf=" + csrf_token

					}

				</script>
			</div>
    </div>

    <div class="right15"></div>
	</article>
	<?php require '../templates/footer.html'; ?>

</body>

</html>
