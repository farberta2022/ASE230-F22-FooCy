<?php
require_once('../settings.php');
if(count($_SESSION)>0 && is_numeric($_SESSION['user_ID'])){
	header('location: ../index.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign Up!</title>
    </head>
    <body>
        <a href="../libs/signupUser.php">Create a user account</a> <br />
        <a href="../libs/signupSeller.php">Create a seller account</a>
    </body>
</html>