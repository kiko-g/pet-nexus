<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets'); ?>

<body>
	<?php require '../templates/navbar.html' ?>
	<header>
		<div class="profile-container">
			<div class="profile">
				<div class="profile-image">
					<img class="w50" src="../assets/img/logo.png">
				</div>

				<div class="profile-user-settings">
					<code class="profile-user-name">petnexus</code>
					<button class="small-button profile-settings-button" aria-label="profile settings"><i class="fas fa-cog"
							aria-hidden="true"></i></button>
						<p><span class="profile-real-name">Pet Nexus Admin</span></p>
				</div>

			</div>
			<!-- End of profile section -->
		</div>
		<!-- End of container -->
	</header>

	<main>
		<div class="profile-container">
			<h1>Pet Listings</h1>
			<div class="posts">
				<div class="posts-item" tabindex="0">
					<img src="../assets/img/dog.jpg"
						class="posts-image" alt="">
					<div class="posts-item-info">
						<ul>
							<li class="posts-item-likes"><span class="visually-hidden">Likes:</span><i class="fas fa-heart"
									aria-hidden="true"></i> 15</li>
							<li class="posts-item-comments"><span class="visually-hidden">Comments:</span><i class="fas fa-comment"
									aria-hidden="true"></i> 3</li>
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
	</main>
	<?php require '../templates/footer.html'; ?>
</body>

</html>