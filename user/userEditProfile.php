<?php
//User Edit Profile

require_once('../settings.php');
/*if(count($_SESSION)>0 && ($_SESSION['user_ID'])!= $_GET['user_ID']){
	header('location: ../index.php');
	die();
}
*/
if(count($_POST)>0){
	$sql="UPDATE users SET firstname=?,lastname=?,phone_number=?,picture=?,bio=?,birthday=? WHERE user_ID=?";
	$query=$connection->prepare($sql)->execute([$_POST['firstname'],$_POST['lastname'],$_POST['phone_number'],
	$_POST['picture'],$_POST['bio'],$_POST['birthday'],$_SESSION['user_ID']]);

	$sql2="UPDATE addresses SET house_number=?,street=?,apt_number=?,city=?,state=?,country=?,postal_code=?,special_instructions=? WHERE user_ID=?";
	$query2=$connection->prepare($sql2)->execute([$_POST['house_number'],$_POST['street'],$_POST['apt_number'],
	$_POST['city'],$_POST['state'],$_POST['country'],$_POST['postal_code'],$_POST['special_instructions'],$_SESSION['user_ID']]);

}


$query=$connection->prepare('SELECT * FROM users INNER JOIN addresses ON users.user_ID = addresses.user_ID WHERE users.user_ID=?');
$query->execute([$_SESSION['user_ID']]);
$user=$query->fetch();
?>

<h1>Hello <?= $user['firstname'] ?></h1>
<p>Here you can update your account info!</p>
<form method="POST">
	<label for="firstname">First Name:</label>
	<input name="firstname" type="text" value="<?= $user['firstname'] ?>" /><br />
	<label for="lastname">Last Name:</label>
	<input name="lastname" type="text" value="<?= $user['lastname'] ?>" /><br />
	<label for="phone_number">Phone Number:</label>
	<input name="phone_number" type="text" value="<?= $user['phone_number'] ?>" /><br />
	<?php //Need Tami's code from wednesday about how to handle file upload ?>
	<label for="picture">Profile Picture:</label>
	<input name="picture" type="text" value="<?= $user['picture'] ?>" /><br />
	<label for="bio">Bio:</label><br />
	<textarea name="bio" rows="4" cols="50"><?= $user['bio']?></textarea><br />
	<label for="birthday">Birthday:</label>
	<input name="birthday" type="date" value="<?= $user['birthday'] ?>" /><br />
	<label for="house_number">House Number:</label>
	<input name="house_number" type="text" value="<?= $user['house_number'] ?>" /><br />
	<label for="street">Street:</label>
	<input name="street" type="text" value="<?= $user['street'] ?>" /><br />
	<label for="apt_number">Apartment Number (optional):</label>
	<input name="apt_number" type="text" value="<?= $user['apt_number'] ?>" /><br />
	<label for="city">City:</label>
	<input name="city" type="text" value="<?= $user['city'] ?>" /><br />
	<label for="state">State:</label>
	<input name="state" type="text" value="<?= $user['state'] ?>" /><br />
	<label for="country">Country:</label>
	<input name="country" type="text" value="<?= $user['country'] ?>" /><br />
	<label for="postal_code">Postal Code:</label>
	<input name="postal_code" type="text" value="<?= $user['postal_code'] ?>" /><br />
	<label for="bio">Special Instructions:</label><br />
	<textarea name="special_instructions" rows="4" cols="50"><?= $user['special_instructions']?></textarea><br />
	<button type="submit">Submit</button>
</form>