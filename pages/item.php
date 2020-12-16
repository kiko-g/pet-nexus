<!-- if not logged in show login popup using require 'login.html' -->
<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
	<?php 
		require '../templates/header.html';
		require '../templates/navbar.php';
		require '../database/dogs.php';
		if(!isset($_GET['id'])){

			header('Location: ../index.php');
		}

		$dog_data = get_dog($_GET['id']);
	?>



	<section class="row">
		<div class="left15">
		</div>
	
		<div class="main70">
      <div class="container">
      <p><h2><?= $dog_data['listing_name'] ?></h2></p>
		<?php

		if(isset($_SESSION['id']) && $_SESSION['id'] == $dog_data['user_id']){
		?>
			<button onclick="document.getElementById('edit-listing-popup').style.display='block'" class="profile-settings-button" aria-label="profile settings">
					<i class="fas fa-edit" aria-hidden="true"></i>
			</button>	
	
	
	<?php 
		
		$edit_listing = new FormCreator('edit-listing-popup', '../actions/action_edit_listing.php', true);
		$edit_listing->add_input("listing_name", "Listing Name", "text", "New listing name", true, $dog_data['listing_name']);
		$edit_listing->add_input("listing_description", "Listing description", "text", "New listing description", true, $dog_data['listing_description']);
		$edit_listing->add_select('breed_id', 'Breed', get_breeds(), $dog_data['breed_id']);
		$edit_listing->add_select('color_id', 'Color', get_colors(), $dog_data['color_id']);
		$edit_listing->add_select('age_id', 'Age', get_ages(), $dog_data['age_id']);
		$edit_listing->add_select('gender_id', 'Gender', get_genders(), $dog_data['gender_id']);
		$edit_listing->add_input("dog_id", "", "hidden", "", true, $dog_data['id']);
		$edit_listing->inline();
		
		
		} 
?>
		<div class="inside-container">
			<img src="<?= $dog_data['listing_picture'] ?>" class="display-pet" alt="">
			<div class="display-topleft display-hover">
				<button class="button-heart"><i class="fa fa-heart"></i></button>
			</div>
		</div>
	<?php
		if(isset($_SESSION['id']) && $_SESSION['id'] == $dog_data['user_id']){
	?>
		<a href="../pages/picture_change.php?id=<?=$dog_data['id']?>">Change Picture</a>
	<?php
		}
	?>
	<p><h3>Description</h3></p>
	<p><?= $dog_data['listing_description'] ?></p>
	<p>
		<h3>Dog details</h3>
		<strong>Breed: </strong> <?= $dog_data['breed_name'] ?><br>
		<strong>Color: </strong> <?= $dog_data['color_name'] ?><br>
		<strong>Age: </strong> <?= $dog_data['age_name'] ?><br>
		<strong>Gender: </strong> <?= $dog_data['gender_name'] ?><br>
	</p>
      </div>

	
	  <br><br><br>
	<div class="container">

	<?php

		$is_author = false;
		if ($dog_data['user_id'] === $_SESSION['id']) $is_author = true;

		if (isset($_SESSION['id']) && !$is_author ){
		
			$comments = new FormCreator('comments_session', '../actions/action_make_a_question.php', false, false, false);
			
			$comments->add_input('question_content', 'Question', 'text', 'Write here your question', true);
			$comments->add_input("dog_id", "", "hidden", "", true, $dog_data['id']);

			$comments->inline();
		}
		
	?>

	<?php 
		require_once("../database/db_class.php");
		$dbc = Database::instance()->db();

		$stmt = $dbc->prepare("SELECT * FROM comments WHERE dog_id = ?");
		$stmt->execute(array($dog_data['id']));
		$comments = $stmt->fetchAll();

		$num = count($comments); ?>

		<br><br>

		<strong><?=$num?> Comment<?php if ($num !== 1) echo 's'; ?>:</strong>

	<?php
		$i = 0;
		foreach ($comments as $index => $entry) { 
			$i++;
				?>

			<br><br>
			<strong>Question:</strong>
			<?=$entry['question']?>
			<?php $stmt = $dbc->prepare("SELECT * FROM users WHERE id = ?");
				$stmt->execute(array($entry['user_id']));
				$user_comment = $stmt->fetch();
			?>
			<br> <?=$user_comment['username']?>
			<br>

			<?php
			
				if ($entry['answer'] === NULL) {

					$add_answer = new FormCreator('answer', '../actions/action_write_a_answer.php', false, false, false);
			
					$add_answer->add_input('answer_content', 'Answer', 'text', 'Write a answer for this question', true);
					$add_answer->add_input("comment_id", "", "hidden", "", true, $entry['id']);
					$add_answer->add_input("dog_id", "", "hidden", "", true, $dog_data['id']);

					$add_answer->inline();

				}
				else { ?>

					<strong>Answer:</strong>
					<?=$entry['answer']?>
				<?php	
				}

		} ?>

	</div>
	
	
			<div class="display-topleft display-hover">
				<button class="button-heart"><i class="fa fa-heart"></i></button>
			</div>
		</div>
	
		<div class="right15">
		</div>

	</section>

	<?php require '../templates/footer.html'; ?>

</body>


</html>
