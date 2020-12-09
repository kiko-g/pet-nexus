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

  <div>
    <form action="../actions/action_insert_pet.php" method="post" enctype="multipart/form-data">
      <label for="pet_name">Pet's Name</label>
      <input type="text" placeholder="Name" name="pet_name">
      <label for="pet_type">Pet's Type</label>
      <select name="pet_type">
        <option value="dog"> Dog </option>
        <option value="cat"> Cat </option>
        <option value="bird"> Bird </option>
        <option value="other"> Other </option>
      </select> <br><br>
      <label for="pet_color">Pet's Color</label>
      <input type="text" placeholder="Color" name="pet_color">
      <label for="pet_description">Pet's Description</label>
      <input type="text" placeholder="Description" name="pet_description">
      <label for="pet_photo">Pet's Photo</label> <br>
      <input type="file" name="file">
      <button type="submit" name="submit">Done</button>
    </form>
  </div>

  <?php require '../templates/footer.html'; ?>
</body>
</html>