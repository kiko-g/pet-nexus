<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<header class="header">
    <h1>Pet Nexus</h1>
    <p>A <b>petfinder</b> website</p>
  </header>
	<?php require '../templates/navbar.php' ?>
	<section class="grid-container">
		<div class="posts row-padding">
			<div class="posts-item" tabindex="0">
				<a href="item.php">
					<img src="../assets/img/dog.jpg" class="posts-image" alt="">
				</a>
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
				<img src="../assets/img/dog2.jpg" class="posts-image" alt="">
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
				<img src="../assets/img/header.jpg" class="posts-image" alt="">
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
				<img src="../assets/img/header2.jpg" class="posts-image" alt="">
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
	</section>
</body>

<?php require '../templates/footer.html'; ?>

</html>