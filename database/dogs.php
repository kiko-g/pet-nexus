<?php
  include_once('../database/db_class.php');

  /**
   * Returns the list of adopted pets from a certain user.
   */
  function getUserAdoptedPets($username) {
    
    $dbc = Database::instance()->db();
    $stmt = $dbc->prepare('SELECT * FROM adopted_pets WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll(); 
  }

  /**
   * Returns the list of pets for adoption from a certain user.
   */
  function getUserPetsForAdoption($username) {
    
    $dbc = Database::instance()->db();
    $stmt = $dbc->prepare('SELECT * FROM pets_for_adoption WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll(); 
  }

  /**
   * Inserts a new pet for adoption into the database.
   */
  function insert_pet($form, $file_name) {
    
    $dbc = Database::instance()->db();

    $stmt1 = $dbc->prepare('INSERT INTO dogs(user_id, listing_name, listing_description, listing_picture, breed_id, color_id, age_id, gender_id) VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
    $stmt1->execute(array($_SESSION['id'], $form['listing_name'], $form['listing_description'], $file_name,
	    $form['breed_id'],
	    $form['color_id'],
	    $form['age_id'],
	    $form['gender_id']
    ));

  }


  function get_component($component_name, $table_name){

    $dbc = Database::instance()->db();

    $query_str = sprintf('SELECT * FROM %s ORDER BY id', $table_name);
    $stmt = $dbc->prepare($query_str);
    $stmt->execute();
    $db_res = $stmt->fetchAll();

    $res = array();
    foreach($db_res as $entry){
	    $res[$entry['id']] = $entry[$component_name];
    }


    return $res;

  }
  function get_breeds(){
	  return get_component('breed_name', 'dog_breeds');
  }

  function get_colors(){
	  return get_component('color_name', 'dog_colors');
  }

  function get_ages(){
	  return get_component('age_name', 'dog_ages');
  }

  function get_genders(){
	  return get_component('gender_name', 'dog_genders');
  }


  function get_dog($id){

    $dbc = Database::instance()->db();

    $stmt = $dbc->prepare('SELECT dogs.*, color_name, breed_name, age_name, gender_name
	    FROM dogs 
	    JOIN dog_colors ON color_id=dog_colors.id 
	    JOIN dog_breeds ON breed_id=dog_breeds.id 
	    JOIN dog_ages ON age_id=dog_ages.id 
	    JOIN dog_genders ON gender_id=dog_genders.id 

		WHERE dogs.id = ?');
    $stmt->execute(array($id));
    return $stmt->fetch();
  }

  function update_dog($data){

		header('Content-Type: application/json');
		$dbc = Database::instance()->db();
		$stmt = $dbc->prepare('UPDATE dogs SET 
			listing_name = ?,
			listing_description = ?,
			breed_id = ?,
			color_id = ?,
			age_id = ?,
			gender_id = ?
		       	WHERE id = ? AND user_id = ?');
		try{
			$stmt->execute(array(
				$data['listing_name'],
				$data['listing_description'],
				$data['breed_id'],
				$data['color_id'],
				$data['age_id'],
				$data['gender_id'],
				$data['dog_id'],
				$_SESSION['id']
			)
			);


			echo json_encode(['status' => 'success']);
		}
		catch(PDOexception $e){
			error_log($e);
			echo json_encode(['errors' => 'There was an error updating the listing']);
		}

  }

?>
  
