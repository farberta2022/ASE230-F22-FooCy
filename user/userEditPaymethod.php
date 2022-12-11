<?php

require_once('../settings.php');

$query=$connection->prepare('SELECT * FROM users INNER JOIN addresses ON users.user_ID = addresses.user_ID  WHERE users.user_ID=?');
$query->execute([$_SESSION['user_ID']]);
$user=$query->fetch();

if(count($_POST)>0){
$query=$connection->prepare('INSERT INTO paymethods(nameOnAccount, pm_type,acct_num,exp_date,user_ID, adr_ID) VALUES (?,?,?,?,?,?) ');
$query->execute([$_POST['nameOnAccount'],$_POST['pm_type'],$_POST['acct_num'],$_POST['exp_date'],$_SESSION['user_ID'],$user['adr_ID']]);
header('location: ../index.php');
} 
?>

<h1>Hello <?= $user['firstname'] ?></h1>
<form method="POST">
    <label for="nameOnAccount">Name on Account:</label>
	<input name="nameOnAccount" type="text" /><br />
	<label for="pm_type">Payment Type:</label>
	<input name="pm_type" type="text"/><br />
	<label for="acct_num">Account Number:</label>
	<input name="acct_num" type="text"/><br />
	<label for="exp_date">Expiration Date:</label>
	<input name="exp_date" type="text"/><br />
	<button type="submit">Submit</button>
<form>

