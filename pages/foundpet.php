<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Found Pets');

if (!isset($_SESSION['id']))
  die(header('Location: login.php'));
?>

<body>
  <header class="header">
    <h1>Pet Nexus</h1>
    <p>A <b>petfinder</b> website</p>
  </header>
  <?php require '../templates/navbar.php'; ?>
  <article class="row">
    <section class="page">
      <h1>I have a pet for adoption</h1>
    </section>
  </article>


<?php
	if(isset($_SESSION['errors'])){
?>

<div class="container" style="background-color:red">
	
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

	<?php
		$submit = new FormCreator('new-pet', '../actions/action_insert_pet.php', true, false, false, 'multipart/form-data');
		
		$submit->add_input('listing_name', 'Listing Name', 'text', 'Name', true, read_session_or_null('listing_name'), NULL);
		$submit->add_input('listing_description', 'Description', 'text', 'Description', true, read_session_or_null('listing_description'), NULL);
		$submit->add_input('listing_picture', 'Pet\'s Photo', 'file', NULL, true, NULL, NULL);
		$submit->inline();
		unset($_SESSION['listing_name']);
		unset($_SESSION['listing_description']);

	?>


  <?php require '../templates/footer.html'; ?>
</body>
</html>
