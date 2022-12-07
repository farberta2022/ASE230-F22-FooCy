<?php
//sign in
require_once('../settings.php');
if(count($_SESSION)>0 && is_numeric($_SESSION['user_ID'])){
	header('location: ../index.php');
	die();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Sign In!</title>
    </head>
    <body>
        <?php
        if(count($_POST)>0){
            require_once('auth.php');
            if(signin($connection,$_POST['email'],$_POST['password'])){
                header('location: ../index.php');
                die($_SESSION['message']="Thank you for signing in");
            }else echo 'Signin failed';
        }
        ?>
        <h1>Sign In!</h1>
        <form method="POST">
            <input name="email" type="email" placeholder="email" />
            <input name="password" type="password" placeholder="password" />
            <button type="submit">Sign in</button>
        </form>
    </body>
</html>
