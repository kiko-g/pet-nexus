<?php
	session_start();
	include_once('../database/user.php');

	function generate_random_token() {
		return bin2hex(openssl_random_pseudo_bytes(32));
	}

	if (!isset($_SESSION['csrf'])) {
		$_SESSION['csrf'] = generate_random_token();
	}




	if(!isset($_SESSION['username'])){

		if(isset($_COOKIE['auth'])){
			restore_session($_COOKIE['auth']);
		}

	}


?>
