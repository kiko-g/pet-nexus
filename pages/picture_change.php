
<?php require_once '../includes/session.php'; 

	if(!isset($_SESSION['id'])){
		header('Location: ../index.php');
		return;
	}

?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

if (!isset($_SESSION['id']))
  die(header('Location: ../index.php'));
?>

<body>
	<?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php'; ?>
  <article class="row">
    <section class="page">
      <h1>I want to change picture of listing!</h1>
    </section>
  </article>


<?php
	if(isset($_SESSION['errors'])){
?>

<div class="error-div">
	
<?php
	foreach($_SESSION['errors'] as $error){
?>
	<?= $error ?><br>
<?php
	}
	unset($_SESSION['errors']);

	}
?>


</div>


<div>
	<?php
		require_once '../database/dogs.php';
		$dogs = get_dogs_of_user();
		$pictures = db_res_id_to_array($dogs, 'listing_picture');
	?>
		<div class="container">
			<img id="picture-showcase" style="display:none" src="" class="display-pet" alt="">
		</div>
	<?php
		$submit = new FormCreator('picture-change', '../actions/action_update_picture.php', true, false, false,'multipart/form-data');
		$submit->add_select('listing_id', 'Listings', db_res_id_to_array($dogs, 'listing_name'), read_session_or_null('listing_id'));
		$submit->add_input('listing_picture', 'Pet\'s New Photo', 'file', NULL, true, NULL, NULL);
		$submit->inline();

		unset($_SESSION['listing_id']);

	?>
	<script>
		let picture = document.getElementById('picture-showcase');
		let select = document.getElementsByName('listing_id')[0];


		let images = {
			<?php
				foreach($pictures as $key => $value)
					echo '\''.$key . '\' : \'' . $value . '\', ';
			?>
		}; 
		// erro?

<?php

		if(isset($_GET['id'])){
?>

			picture.src = images[<?= $_GET['id']?>];
			select.value = <?= $_GET['id']?>;
<?php
		}
		else{
?>
			let lastKey = Object.keys(images)[Object.keys(images).length-1];
			picture.src = images[lastKey];
			select.value  = lastKey;

<?php
		}
?>
		picture.style.display = 'block';

		select.onchange = (event) => {
			picture.src = images[event.target.value];
		};
	</script>
</div>


  <?php require '../templates/footer.html'; ?>
</body>
</html>
