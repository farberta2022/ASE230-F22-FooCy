<?php
//index

require_once('settings.php');
require_once('theme/header.php');

?>

<style>
  .header {
    padding: 20px;
    text-align: center;
    background: #A29F34;
    color: white;
    font-size: 30px;
  }
</style>

<div class="header">
  <h1>
    <a href="index.php"><img src="logo.jpg" width="15%"></a>
  </h1>
</div>

<br/>
<h1 style="text-align:center">The creativity starts with you.</h1>
<br/>

<a href="interface/signupLanding.php"><button style="text-align:center">Sign Up!</button><a>
<a href="libs/signin.php" style="text-align:center"><button style="text-align:center">Sign In!</button><a>

<div class="container">
  <div class="notify">
    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'];
      }
     ?>
     <hr />
  </div> <!-- end of div class:notify -->
  
  <?php
     $result=$connection->query('SELECT * FROM categories');
     echo '<table>';
     while($category=$result->fetch()){
       echo '<tr>
         <td><a href="interface/categoryDetail.php?id='.$category['cat_ID'].'">'.$category['cat_name'].'</a></td>
       </tr>';
     }
     echo '</table>';
    if (isset($_SESSION['role']) && $_SESSION['role']==2) {
      echo '<a href="admin/admin.php">Admin page<a><br />';
    }
    if (isset($_SESSION['role']) && $_SESSION['role']==1) {
      echo '<a href="seller/seller.php">Seller dashboard<a><br />';
    }
    if (isset($_SESSION['role']) && $_SESSION['role']>=0) {
      echo '<a href="user/userEditProfile.php">Edit profile<a><br />';
    }
   
  ?>
  
    <br />
  <a href="libs/signout.php">Sign Out!<a><br />

</div> <!-- end of div class:container -->
