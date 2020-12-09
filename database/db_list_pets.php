<?php
  include_once('../database/db_class.php');

  /**
   * Returns the list of adopted pets from a certain user.
   */
  function getUserAdoptedPets($username) {
    
    global $dbc;
    $stmt = $dbc->prepare('SELECT * FROM adopted_pets WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll(); 
  }

  /**
   * Returns the list of pets for adoption from a certain user.
   */
  function getUserPetsForAdoption($username) {
    
    global $dbc;
    $stmt = $dbc->prepare('SELECT * FROM pets_for_adoption WHERE username = ?');
    $stmt->execute(array($username));
    return $stmt->fetchAll(); 
  }

  /**
   * Inserts a new found pet for adoption into the database.
   */
  function insertFoundPet($pet_name, $pet_type, $pet_color, $pet_description, $pet_photo) {
    
    global $dbc;

    $stmt1 = $dbc->prepare('INSERT INTO pets VALUES(NULL, ?, ?, ?, ?, 0, ?)');
    $stmt1->execute(array($pet_name, $pet_type, $pet_color, $pet_description, $pet_photo));

    $stmt2 = $dbc->prepare("SELECT * FROM pets WHERE pet_photo = ?");
    $stmt2->execute(array($pet_photo));
    $pet = $stmt2->fetch();
    $pet_id = $pet['pet_id'];

    $stmt3 = $dbc->prepare('INSERT INTO pets_for_adoption VALUES(NULL, ?, ?)');
    $stmt3->execute(array($pet_id, $_SESSION['id']));
    
    
  }
  
