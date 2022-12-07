<?php
//User Edit Profile

require_once('../settings.php');
if(count($_SESSION)>0 && ($_SESSION['user_ID'])!= $_GET['id']){
	header('location: ../index.php');
	die();
}
$query=$connection->prepare('UPDATE users SET (name');
$query->execute([$_POST['cat_name'],$_GET['id']]);