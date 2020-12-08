<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

// Verify if user is logged in
if (!isset($_SESSION['id']))
	die(header('Location: login.php'));
?>

<body>
	<?php require '../templates/navbar.php' ?>
	<header>
		<section class="grid-container">
			<div class="profile">
				<div class="profile-image">
					<img src="../assets/img/logo.png">
				</div>

				<div class="profile-user-settings">
					<code class="profile-user-name">petnexus</code>
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
				<div class="posts-item" tabindex="0">
					<img src="../assets/img/dog.jpg"
						class="posts-image" alt="">
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
