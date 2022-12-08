<?php
//index
// session_start();
require_once('settings.php');
require_once('theme/header.php');

?>
<div class="container">
  <div class="notify">
    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
      }
     ?>
     <hr />
  </div> <!-- end of div class:notify -->
  <h1> This is the index page </h1>
  <?php
      if (isset($_SESSION['role']){
        if($_SESSION['role']==2) {
          echo '<a href="admin/admin.php">Admin page<a><br />';
        } elseif ($_SESSION['role']==1) {
          echo '<a href="seller/seller.php">Seller dashboard<a><br />';
        }
      }
    //   if (isset($_SESSION['role']) && $_SESSION['role']==2) {
    //     echo '<a href="admin/admin.php">Admin page<a><br />';
    // }
    ?>
    <a href="interface/signupLanding.php">Sign Up!<a><br />
    <a href="libs/signin.php">Sign In!<a><br />
    <a href="libs/signout.php">Sign Out!<a><br />

</div> <!-- end of div class:container -->
