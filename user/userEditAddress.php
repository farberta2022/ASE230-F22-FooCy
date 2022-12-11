<?php

require_once('../settings.php');

$query=$connection->prepare('SELECT * FROM users  WHERE user_ID=?');
$query->execute([$_SESSION['user_ID']]);
$user=$query->fetch();

if(count($_POST)>0){
$query=$connection->prepare('INSERT INTO addresses(house_number,street,apt_number,city,state,country,postal_code,special_instructions,user_ID) VALUES (?,?,?,?,?,?,?,?,?) ');
$query->execute([$_POST['house_number'],$_POST['street'],$_POST['apt_number'],$_POST['city'],$_POST['state'],$_POST['country'],$_POST['postal_code'],$_POST['special_instructions'],$_SESSION['user_ID']]);
header('location: ../index.php');
}
?>

<h1>Hello <?= $user['firstname'] ?></h1>
<form method="POST">
    <label for="house_number">House Number:</label>
	<input name="house_number" type="text" /><br />
	<label for="street">Street:</label>
	<input name="street" type="text"/><br />
	<label for="apt_number">Apartment Number (optional):</label>
	<input name="apt_number" type="text"/><br />
	<label for="city">City:</label>
	<input name="city" type="text"/><br />
	<label for="state">State:</label>
	<input name="state" type="text"/><br />
	<label for="country">Country:</label>
	<input name="country" type="text" /><br />
	<label for="postal_code">Postal Code:</label>
    <input name="postal_code" type="text"/><br />
	<label for="bio">Special Instructions:</label><br />
	<textarea name="special_instructions" rows="4" cols="50"></textarea><br />
	<button type="submit">Submit</button>
<form>
