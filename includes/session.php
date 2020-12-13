<?php
	session_start();
	include_once('../database/user.php');


	function generate_random_token() {
		return bin2hex(openssl_random_pseudo_bytes(32));
	}

	if (!isset($_SESSION['csrf'])) {
		$_SESSION['csrf'] = generate_random_token();
	}




	if(!isset($_SESSION['id'])){

		if(isset($_COOKIE['auth'])){
			restore_session($_COOKIE['auth']);
		}

	}

	function read_session_or_null($name){
		if(isset($_SESSION[$name]))
			return $_SESSION[$name];

		return NULL;
	}


	function set_from_post_in_session($name){
    	$_SESSION[$name] = $_POST[$name];
	}

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

?>
