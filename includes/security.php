<?php

	function guarantee_and_escape($data, $guarantee, $ajax=false){

		$res = array();
		foreach($guarantee as $guaranteed){

			if(!isset($data[$guaranteed])){

				if($ajax){
					echo json_encode(['errors' => 'Missing fields ' . $guaranteed]);
				}
				else{
					$_SESSION['errors'] = array('Missing fields ' . $guaranteed);
				}
				return false;
			}

			$res[$guaranteed] = htmlentities($data[$guaranteed]);
		}

		return $res;
	}

	function test_csrf($csrf, $ajax=false) {

		$res = $_SESSION['csrf'] == $csrf;
		error_log($_SESSION['csrf']);
		error_log($csrf);

		if($res == false){
			if($ajax){
				echo json_encode(['errors' => 'Invalid CSRF']);
			}
			else{
				$_SESSION['errors'] = array('Invalid CSRF');
			}
		}

		return $res;
	}

?>
