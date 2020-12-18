<?php

	function guarantee_and_escape($data, $guarantee){

		$res = array();
		foreach($guarantee as $guaranteed){

			if(!isset($data[$guaranteed])){
				return false;
			}

			$res[$guaranteed] = htmlentities($data[$guaranteed]);
		}

		return $res;
	}

	function test_csrf($csrf, $ajax) {

		$res = $_SESSION['csrf'] == $csrf;

		if($res == false){
			if($ajax){
				echo json_encode(['errors' => 'Invalid CSRF']);
			}
			else{
				error_log($_SESSION['csrf']);
				error_log($csrf);
				$_SESSION['errors'] = array('Invalid CSRF');
			}
		}

		return $res;
	}

?>
