<?php
//sign out
require_once('../settings.php');
if(count($_SESSION)>0 && is_numeric($_SESSION['user_ID'])){
	require_once('auth.php');
	signout();
}
header('location: ../index.php');
die();