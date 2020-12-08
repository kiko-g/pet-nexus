<?php
	include_once('../includes/session.php');
	include_once('../database/user.php');
	remove_session();
	session_destroy();
	session_start();

?>
