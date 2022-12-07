<?php
//index
session_start();
require_once('settings.php');
require_once('theme/header.php');

?>
<div class="container">
  <div class="errors">
    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
      }
     ?>
     <hr />
  </div>
  <h1> This is the index page </h1>
  <?php
  if(isset($_SESSION['role']) && ($_SESSION['role']==2)){
        echo '<a href="admin/admin.php">Admin page<a><br />';
    }
    ?>
    <a href="interface/signupLanding.php">Sign Up!<a><br />
    <a href="libs/signin.php">Sign In!<a><br />
    <a href="libs/signout.php">Sign Out!<a><br />

    <a href="products/create.php">Add new products</a><br />
    <!-- <?=$_SESSION['user_ID']?><br />
    <?=$_SESSION['firstname']?><br />
    <?=$_SESSION['role']?> -->
    <?php
    /*if(isset($_SESSION['role']) && $_SESSION['role']){
      echo '<a href="user/userEditProfile.php">Edit Your profile!<a><br />';
    }
    */
    ?>
</div>
