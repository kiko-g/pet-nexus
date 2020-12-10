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
    
	error_log($file_name);
    $dbc = Database::instance()->db();

    $stmt1 = $dbc->prepare('INSERT INTO dogs(user_id, listing_name, listing_description, listing_picture) VALUES(?, ?, ?, ?)');
    $stmt1->execute(array($_SESSION['id'], $form['listing_name'], $form['listing_description'], $file_name));

  }
  
