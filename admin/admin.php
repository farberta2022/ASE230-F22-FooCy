
<?php
//admin page

require_once('../settings.php');
if(count($_SESSION)>0 && ($_SESSION['role'])< 2){
	header('location: ../index.php');
	die();
}
?>
<form method="POST">
	<label for="cat_name">Create a new category:<label>
	<input name="cat_name" type="text" />
	<button type="submit">Create</button>
<form>
<?php
//create category
if(count($_POST)>0){
	require_once('adminFunctions.php');
	if(AdminCreateCat($connection,$_POST['cat_name'])){
		echo "Category Created";
	}
	else {
		echo "Creation Falied";
	}
}
//view all categories
$result=$connection->query('SELECT * FROM categories');
echo '<table>';
echo '<caption> All Categories';
while($category=$result->fetch()){
	echo '<tr>
		<td>'.$category['cat_ID'].'</td>
		<td><a href="detail.php?id='.$category['cat_ID'].'">'.$category['cat_name'].'</a></td>
		<td><a href="delete.php?id='.$category['cat_ID'].'">DELETE CATEGORY</a></td>
		<td><a href="modify.php?id='.$category['cat_ID'].'">MODIFY CATEGORY</a></td>
	</tr>';
}
echo '</table>';

?>
<a href="../index.php">Index<a><br />

