<?php
//index
// session_start();
require_once('/..settings.php');
require_once('/../theme/header.php');

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
  <h1> Seller's Dashboard </h1>
