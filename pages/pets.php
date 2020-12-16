<?php require_once '../includes/session.php'; ?>
<?php require '../templates/head.php'; default_head('Pet Nexus - Pets'); ?>

<body>
  <?php require '../templates/header.html' ?>
  <?php require '../templates/navbar.php' ?>
  <article class="row"> <!-- row-padding -->
    <div class="left20">
      <div class="colorsFilter">
        <label class="block">Colors</label>
          <label class="checkboxDummy">
            <input type="checkbox" name="black" value="Black"> <span class="checkmark black"></span>
          </label>
          <label class="checkboxDummy">
            <input type="checkbox" name="white" value="White"> <span class="checkmark white"></span>
          </label>
          <label class="checkboxDummy">
            <input type="checkbox" name="brown" value="Brown"> <span class="checkmark brown"></span>
          </label>
          <label class="checkboxDummy">
            <input type="checkbox" name="gray" value="Gray"> <span class="checkmark gray"></span>
          </label>
          <label class="checkboxDummy">
            <input type="checkbox" name="cream" value="Cream"> <span class="checkmark cream"></span>
          </label>
      </div>
      <div class="breedFilter">
        <label class="block" for="dog_breed">Breed</label>
        <select id="dog_breed" name="Dog Breed">
          <option selected="true" value="any" class="dropdownAny" > Any </option>
          <option value="newborn">Newborn</option>
          <option value="puppy">Puppy</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
          <option value="huge">Huge</option>
        </select>
        
      </div>
      <div class="genderFilter">
        <label class="block" for="dog_gender">Gender</label>
        <select id="dog_gender" name="Dog Gender">
          <option selected="true" value="any" class="dropdownAny" > Any </option>
          <option value="newborn">Male</option>
          <option value="puppy">Female</option>
          <option value="medium">Non-binary</option>
        </select>
      </div>
      <div class="ageFilter">
        <label class="block" for="dog_age">Age</label>
        <select id="dog_age" name="Dog Age">
          <option selected="true" value="any" class="dropdownAny" > Any </option>
          <option value="newborn">Newborn</option>
          <option value="puppy">Puppy</option>
          <option value="medium">Medium</option>
          <option value="big">Big</option>
          <option value="huge">Huge</option>
        </select>
      </div>
	<button id="applyFilters">Apply filters</button>
	
	<script>
		document.getElementById('applyFilters').onclick = (event) => {
			let urlParams = new URLSearchParams(window.location.search);
			let cleanUrl = window.location.toString().replace(window.location.search, "")
			let q = urlParams.get('q');
			console.log(window.location.search);
			console.log(cleanUrl);

			if(q == undefined)
				console.log('nao existe');
			else
				console.log('existe');
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

            $stmt = $dbc->prepare('SELECT dogs.*, favorites.id as favorite_id FROM dogs LEFT JOIN favorites ON dogs.id=dog_id AND favorites.user_id = ? WHERE dogs.listing_name LIKE ?');
	    $var = isset($_GET['q']) ? $_GET['q'] : '';
            $stmt->execute(array($_SESSION['id'], "%$var%"));
            $pets = $stmt->fetchAll();
            $i = 0;
            foreach ($pets as $index => $entry) { 
              $i++;
	
          ?>
            
		
            <div class="posts-item">
              <div class="posts-container">
                <div class="posts-inside-container">
                  <img src="<?= $entry['listing_picture']?>" class="posts-image" alt="pet<?= $i ?>">
                  <div class="fav-button">
		  <button id="fav-<?= $entry['id'] ?>" class="button-heart" onclick="fill(this)">
		  <i class="fa <?= (is_null($entry['favorite_id']) ? 'fa-heart-o' : 'fa-heart')?> pink big" aria-hidden="true"></i>
                    </button>
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
          <?php }  ?>
        </div>
      </div>
    </div>
  </article>
  <?php require '../templates/footer.html'; ?>

</body>

</html>
