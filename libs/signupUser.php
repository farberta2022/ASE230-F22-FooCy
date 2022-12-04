<?php
//sign up
require_once('../settings.php');
if(count($_SESSION)>0 && is_numeric($_SESSION['user_ID'])){
	header('location: ../index.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign up! - User</title>
    </head>
    <body>
        <?php
        if(count($_POST)>0){
            require_once('auth.php');
            if(signupUser($connection,$_POST['email'],$_POST['password'],$_POST['firstname'],$_POST['lastname'])) header('location: signin.php');
            else echo 'Signup failed';
        }
        ?>
        <form method="POST">
            <label for="firstname">First Name: </label>
            <input name="firstname" type="text" /> <br />
            <label for="lastname">Last Name: </label>
            <input name="lastname" type="text" /><br />
            <label for="email">Email: </label>
            <input name="email" type="email" /><br />
            <label for="password">Password: </label>
            <input name="password" type="password" /><br />
            <button type="submit">Sign up</button>	
        </form>
    </body>
</html>