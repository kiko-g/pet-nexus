<?php

	include_once('../includes/session.php');
    include_once('../database/db_list_pets.php');
    
    if (!isset($_POST['submit']))
        die(header('Location: foundpet.php'));

    $pet_photo = '../assets/img/no_image.png';

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
    
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
  
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
    
        $allowed = array('jpg', 'jpeg', 'png');
    
        if(in_array($fileActualExt, $allowed)) {
          if ($fileError === 0){
            if ($fileSize < 500000){
              $fileName = uniqid('', true) . "." . $fileActualExt;
              $fileDestination = '../assets/img/' . $fileName;
              move_uploaded_file($fileTmpName, $fileDestination);
  
              global $pet_photo;
              $pet_photo = $fileDestination;
            } else {
    
            }
          } else {
    
            }
        } else {
 
        }
    }

    $pet_name = ($_POST['pet_name'] == "") ? 'No Name' : $_POST['pet_name'];
    $pet_type = $_POST['pet_type'];
    $pet_color = ($_POST['pet_color'] == "") ? 'Unknown Color' : $_POST['pet_color'];
    $pet_description = ($_POST['pet_description'] == "") ? 'No additional details' : $_POST['pet_description'];

    insertFoundPet($pet_name, $pet_type, $pet_color, $pet_description, $pet_photo);

    header('Location: ../pages/profile.php');
?>
