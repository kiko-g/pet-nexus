<?php

	include_once('../includes/session.php');
	include_once('../database/dogs.php');
    
    error_log(print_r($_FILES, true));
    error_log(print_r($_POST, true));

    function generate_random_name($file_ext){
	return '../assets/user/' . bin2hex(openssl_random_pseudo_bytes(32)) . '.' . $file_ext;
    }

    function generate_filename($file_ext){
	    $res = generate_random_name($file_ext);

	    while(file_exists($res)){
		    $res = generate_random_name($file_ext);
	    }
	    return $res;
    }

    if (isset($_FILES['listing_picture'])) {
        $file = $_FILES['listing_picture'];
  

        $file_name_parts = explode('.', $file['name']);
        $file_ext = strtolower(end($file_name_parts));
    
        $allowed = array('jpg', 'jpeg', 'png');
    
        if(in_array($file_ext, $allowed)) {
            if ($file['size'] < 10000000){
              $dog_photo = generate_filename($file_ext);
              move_uploaded_file($file['tmp_name'], $dog_photo);
  
		insert_pet($_POST, $dog_photo);
		header('Location: ../pages/profile.php');
		return;
            }
	    else{
		$_SESSION['errors'] = array('File size is too big');
	    }
        }
	else{
		$_SESSION['errors'] = array('Wrong extension');
	}
    }
    else{
		$_SESSION['errors'] = array('Forgot to put picture');
    }
    	
    	
    	$_SESSION['listing_name'] = $_POST['listing_name'];
    	$_SESSION['listing_description'] = $_POST['listing_description'];
	header('Location: ../pages/foundpet.php');

?>
