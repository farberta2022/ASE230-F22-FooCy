<?php
//modify

require_once('../settings.php');
if(count($_SESSION)>0 && ($_SESSION['role'])< 2){
	header('location: ../index.php');
	die();
}
if(count($_POST)>0){
    require_once("adminFunctions.php");
    AdminModifyCat($connection, $_GET['id']);
    header('location: admin.php');
}
$query=$connection->prepare('SELECT * FROM categories WHERE cat_ID=?');
$query->execute([$_GET['id']]);
$category=$query->fetch();
?> 

<form method="POST">
Category name: <input name="cat_name" type="text" value="<?= $category['cat_name'] ?>" />
<button type="submit">Submit</button>
</form>