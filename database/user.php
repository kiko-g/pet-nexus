<?php
	

	function create_user($username, $password){

		global $dbc;

		header('Content-Type: application/json');


		if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
			echo json_encode(['errors' => 'Username is using invalid characters']);
			return;
		}

		if(strlen($password) < 8){
			echo json_encode(['errors' => 'Password must have at least 8 chars']);
			return;
		}

		try{
			$options = ['cost' => 12];
			$stmt = $dbc->prepare('INSERT INTO users(username, password) VALUES (?, ?)');
			$stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT, $options)));

			$_SESSION['username'] = $username;
			echo json_encode(['status' => 'success']);
		}
		catch(PDOexception $e){
			echo json_encode(['errors' => 'Username is already in use']);
		}
	}

	function login_user($username, $password){

		global $dbc;

		header('Content-Type: application/json');


		if ( !preg_match ("/^[a-zA-Z0-9]+$/", $username)) {
			echo json_encode(['errors' => 'Username is using invalid characters']);
			return;
		}

		$stmt = $dbc->prepare('SELECT * FROM users WHERE username = ?');
		$stmt->execute(array($username));
		$user = $stmt->fetch();

		if($user !== false && password_verify($password, $user['password'])){
			$_SESSION['username'] = $username;
			echo json_encode(['status' => 'success']);
			return;
		}
		echo json_encode(['errors' => 'Username/Password combination are not valid']);

	}

?>
