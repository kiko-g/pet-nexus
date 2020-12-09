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
		$submit = new FormCreator('new-pet', '../actions/action_insert_pet.php', true, false, false, 'multipart/form-data');
		
		$submit->add_input('pet_name', 'Pet\'s Name', 'text', 'Name', true, NULL, NULL);
		$submit->add_input('pet_description', 'Description', 'text', 'Description', true, NULL, NULL);
		$submit->add_input('pet_color', 'Color', 'text', 'Color', true, NULL, NULL);
		$submit->add_select('pet_type', 'Pet\'s Type', array('dog' => 'Dog', 'cat' => 'Cat'));
		$submit->add_input('file', 'Pet\'s Photo', 'file', NULL, true, NULL, NULL);
		$submit->inline();

	?>


  <?php require '../templates/footer.html'; ?>
</body>
</html>
