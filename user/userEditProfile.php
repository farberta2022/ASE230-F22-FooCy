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

	$sql3="UPDATE paymethods SET nameOnAccount=?,pm_type=?,acct_num=?,exp_date=? WHERE user_ID=?";
	$query3=$connection->prepare($sql3)->execute([$_POST['nameOnAccount'],$_POST['pm_type'],$_POST['acct_num'],$_POST['exp_date'],$_SESSION['user_ID']]);

	echo "your account has been updated";
}


$query=$connection->prepare('SELECT * FROM users INNER JOIN addresses ON users.user_ID = addresses.user_ID INNER JOIN paymethods ON users.user_ID = paymethods.user_ID WHERE users.user_ID=?');
$query->execute([$_SESSION['user_ID']]);
$user=$query->fetch();
?>

<?php
 if(isset($user['house_number'],$user['street'],$user['city'],$user['state'],$user['country'],$user['postal_code'],$user['nameOnAccount'],$user['pm_type'],$user['acct_num'],$user['exp_date'])){
	?>
	<h1>Hello <?= $user['firstname'] ?></h1>
	<p>Here you can update your account info!</p>
	<form method="POST">
		<h2>Profile:</h2>
		<label for="firstname">First Name:</label>
		<input name="firstname" type="text" value="<?= $user['firstname'] ?>" /><br />
		<label for="lastname">Last Name:</label>
		<input name="lastname" type="text" value="<?= $user['lastname'] ?>" /><br />
		<label for="phone_number">Phone Number:</label>
		<input name="phone_number" type="text" value="<?= $user['phone_number'] ?>" /><br />
		<?php //Need Tami's code from wednesday about how to handle file upload ?>
		<label for="picture">Profile Picture:</label>
		<input name="picture" type="text"/><br />
		<label for="bio">Bio:</label><br />
		<textarea name="bio" rows="4" cols="50"><?= $user['bio']?></textarea><br />
		<label for="birthday">Birthday:</label>
		<input name="birthday" type="date" value="<?= $user['birthday'] ?>" /><br />
		<h2>Address:</h2>
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
		<h2>Payment Info:</h2>
		<label for="nameOnAccount">Name on Account:</label>
		<input name="nameOnAccount" type="text" value="<?= $user['nameOnAccount'] ?>" /><br />
		<label for="pm_type">Payment Type:</label>
		<input name="pm_type" type="text" value="<?= $user['pm_type'] ?>" /><br />
		<label for="acct_num">Account Number:</label>
		<input name="acct_num" type="text" value="<?= $user['acct_num'] ?>" /><br />
		<label for="acct_num">Expiration Date:</label>
		<input name="exp_date" type="text" value="<?= $user['exp_date'] ?>" /><br />
		<button type="submit">Submit</button>
	</form>
	<?php
}
if(!isset($user['house_number'],$user['street'],$user['city'],$user['state'],$user['country'],$user['postal_code'])){
	echo "you havent added an address yet *DO THIS FIRST";
	?>
	<a href="userEditAddress.php">Edit address</a><br />
	<?php

	}
if(!isset($user['nameOnAccount'],$user['pm_type'],$user['acct_num'],$user['exp_date'])){
	echo "you havent added a payment method yet";
	?>
	<a href="userEditPaymethod.php">Edit payment method</a><br />
	<?php
	} 
?>

<a href="../index.php">Index<a><br />