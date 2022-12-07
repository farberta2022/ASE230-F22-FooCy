<?php
// index of products for requesting seller-user

session_start();
require_once('../settings.php');
$role = $_SESSION['role'];


// check if the users role gives them seller's privileges
if($_SESSION['role']==0){
  header('location: ../index.php');
  die($_SESSION['message'] = "You are not authorized to access this area");
}
$seller = $_SESSION['user_ID'];
require_once('../theme/header.php');
?>
<div class="container">
  <div class="error">
    <?php
      if(isset($_SESSION['role'])){
        echo $_SESSION['role'].'<br>'.$_SESSION['user_ID'];
      }
    ?>
  </div>
  <h1>List of products for <?=$seller?></h1>
  <?php
    $listResult = viewItems($connection,$user_ID);
    if($listResult != false){
      echo $listResult['prod_ID'].'<br />';
      echo $listResult['cat_ID'].'<br />';
      echo $listResult['prod_name'].'<br />';
      echo $listResult['quantOnHand'].'<br />';
      echo $listResult['prod_price'].'<br />';
      echo $listResult['prod_cost'].'<br />';
      echo $listResult['prod_desc'].'<br />';
      echo $listResult['prod_imgs'].'<br />';
      echo $listResult['date_prod_added'].'<br />';
    } else {
      header('location: ../index.php');
      die($_SESSION['message']);
    }



    }

   ?>