<?php
//delete page

require_once('../settings.php');
if(count($_SESSION)>0 && ($_SESSION['role'])< 2){
	header('location: ../index.php');
	die();
}
if(isset($_POST['confirm'])){
	require_once('adminFunctions.php');
	AdminDelteCat($connection,$_GET['id']);
	header('location: admin.php');
}

?>
<form method="POST">
    <p>Are you sure you want to delete this category?</p>
    <input type="submit" name="confirm" value="Confirm"/>
</form>
