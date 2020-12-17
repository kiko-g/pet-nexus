<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <?php require '../database/dogs.php' ?>
  <?php require '../includes/pagination.php' ?>
  <article class="row"> <!-- row-padding -->
    <div class="left20">
      <div class="colorsFilter">
	<?php
		$colors = get_colors();
		$breeds = get_breeds();
		$genders = get_genders();
		$ages = get_ages();

		$selected_colors = isset($_GET['colors']) ? explode(',', $_GET['colors']) : array();
		$selected_breed = isset($_GET['breed']) ? $_GET['breed'] : '';
		$selected_gender = isset($_GET['gender']) ? $_GET['gender'] : '';
		$selected_age = isset($_GET['age']) ? $_GET['age'] : '';
	?>
        <label class="block">Colors</label>
	  <?php
		foreach($colors as $key => $value){
	  ?>
		  <label class="checkboxDummy">
		  <input type="checkbox" <?= in_array($key, $selected_colors) ? 'checked' : ''; ?> name="<?=$key?>" value="<?=$value?>"> <span class="checkmark <?= strtolower($value)?>"></span>
		  </label>
	  <?php
		}
	  ?>
      </div>
      <div class="breedFilter">
        <label class="block" for="dog_breed">Breed</label>
        <select id="dog_breed" name="Dog Breed">
	<option <?= empty($selected_breed) ? 'selected' : ''; ?> value="any" class="dropdownAny" > Any </option>
	  <?php
		foreach($breeds as $key => $value){
	  ?>
		  <option <?= $selected_breed == $key ? 'selected' : ''; ?> value="<?= $key ?>"><?= $value ?></option>
	  <?php } ?>
        </select>
        
      </div>
      <div class="genderFilter">
        <label class="block" for="dog_gender">Gender</label>
        <select id="dog_gender" name="Dog Gender">
          <option <?= empty($selected_gender) ? 'selected' : ''; ?> value="any" class="dropdownAny" > Any </option>
	  <?php
		foreach($genders as $key => $value){
	  ?>
		  <option <?= $selected_gender == $key ? 'selected' : ''; ?> value="<?= $key ?>"><?= $value ?></option>
	  <?php } ?>
        </select>
      </div>
      <div class="ageFilter">
        <label class="block" for="dog_age">Age</label>
        <select id="dog_age" name="Dog Age">
          <option <?= empty($selected_age) ? 'selected' : ''; ?>  value="any" class="dropdownAny" > Any </option>
	  <?php
		foreach($ages as $key => $value){
	  ?>
		  <option <?= $selected_age == $key ? 'selected' : ''; ?> value="<?= $key ?>"><?= $value ?></option>
	  <?php } ?>
        </select>
      </div>
	<button id="applyFilters">Apply filters</button>
	
	<script>
		document.getElementById('applyFilters').onclick = (event) => {
			let colorNodes = [...document.querySelectorAll('body > article > div.left20 > div.colorsFilter input[type=checkbox]')];

			let tickedColors = colorNodes.filter((node) => { return node.checked; }).map((node) => {return node.name;}).join(',');

			let selectedBreed = document.getElementById('dog_breed').value;
			let selectedGender = document.getElementById('dog_gender').value;
			let selectedAge = document.getElementById('dog_age').value;

			let urlParams = new URLSearchParams(window.location.search);
			let cleanUrl = window.location.toString().replace(window.location.search, "")
			let q = urlParams.get('q');

			let queryObj = {};

			if(tickedColors !== ''){
				queryObj['colors'] = tickedColors;
			}

			if(selectedBreed !== 'any'){
				queryObj['breed'] = selectedBreed;
			}

			if(selectedGender !== 'any'){
				queryObj['gender'] = selectedGender;
			}

			if(selectedAge !== 'any'){
				queryObj['age'] = selectedAge;
			}

			if(q !== null && q !== undefined){
				queryObj['q'] = q;
			}

			let newQuery = new URLSearchParams(queryObj);
			window.location.replace(cleanUrl+'?'+newQuery);
		}
	</script>
    </div>

    <div class="right80">      
      <div class="grid-gallery">
        <h2>Pets for adoption</h2>
        <form>
          <input type="search" placeholder="Search" name="q">
        </form>
        <div class="posts">      
          <?php
            require_once("../database/db_class.php");
            $dbc = Database::instance()->db();

	    $qry_str = 'SELECT dogs.*, favorites.id as favorite_id FROM dogs LEFT JOIN favorites ON dogs.id=dog_id AND favorites.user_id = ?';
	    $execute_arr = array($_SESSION['id']);


	    $where_exists = false;
	    if(isset($_GET['q'])){
		$qry_str .= ' WHERE dogs.listing_name LIKE ?';
		$var = $_GET['q'];
		array_push($execute_arr, '%'.$var.'%');
		$where_exists = true;
	    }

	    if(isset($_GET['breed'])){

		if($where_exists == true)
			$qry_str .= ' AND ';
		else
			$qry_str .= ' WHERE ';

		$qry_str .= 'dogs.breed_id = ?';
		array_push($execute_arr, $_GET['breed']);
	        $where_exists = true;
	    }

	    if(isset($_GET['gender'])){

		if($where_exists == true)
			$qry_str .= ' AND ';
		else
			$qry_str .= ' WHERE ';
		$qry_str .= 'dogs.gender_id = ?';
		array_push($execute_arr, $_GET['gender']);
	        $where_exists = true;
	    }


	    if(isset($_GET['age'])){

		if($where_exists == true)
			$qry_str .= ' AND ';
		else
			$qry_str .= ' WHERE ';
		$qry_str .= 'dogs.age_id = ?';
		array_push($execute_arr, $_GET['age']);
	        $where_exists = true;
	    }

	    if(isset($_GET['colors'])){

		if($where_exists == true)
			$qry_str .= ' AND ';
		else
			$qry_str .= ' WHERE ';

		$qry_str .= 'dogs.color_id IN (';
		$qry_str .= str_repeat('?,', count($selected_colors) - 1) . '?)';

		foreach($selected_colors as $color)
			array_push($execute_arr, $color);
	        $where_exists = true;
	    }

	    $qry_str .= ' ORDER BY dogs.id DESC';

	    $qry_str = paginate_query($qry_str, 0, 4);
	    error_log($qry_str);
            $stmt = $dbc->prepare($qry_str);
            $stmt->execute($execute_arr);
            $pets = $stmt->fetchAll();
	    error_log(count($pets));

            $i = 0;
            foreach ($pets as $index => $entry) { 
              $i++;
	
          ?>
		
            <div class="posts-item">
              <div class="posts-container">
                <div class="posts-inside-container">
                  <img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
                  <div class="fav-button">
		<?php if(isset($_SESSION['id'])){
		?>
		  <button id="fav-<?= $entry['id'] ?>" class="button-heart" onclick="fill(this)">
			  <i class="fa <?= (is_null($entry['favorite_id']) ? 'fa-heart-o' : 'fa-heart')?> pink big" aria-hidden="true"></i>
                    </button>
		<?php } ?>
                  </div>
                  <div class="photo-stats">
                    <i class="fa fa-heart pink" aria-hidden="true"></i> 32
                    <i class="fa fa-question-circle blue" aria-hidden="true"></i> 3
                  </div>
                </div>
                <a href="item.php?id=<?= $entry['id'] ?>">
                  <p><?= $entry['listing_name']?></p>
                </a>
              </div>
            </div>
	  <?php } ?>
	
        </div>

	  <div>
		<?php
			generate_pagination_bottom(4, 10, 40);

		?>
	  </div>
      </div>
    </div>
  </article>
  <?php require '../templates/footer.html'; ?>

</body>

</html>
