<?php
  session_start();
  require_once('../settings.php');
  $role = $_SESSION['role'];


  // check if the users role gives them seller's privileges
  if($_SESSION['role']==0){
    header('location: ../index.php');
  	die($_SESSION['message'] = "You are not authorized to add a product");
  }
  $seller = $_SESSION['user_ID'];
  require_once('../theme/header.php');

?>
<div class="container">
  <div class="error">
    <?php
      if(isset($_SESSION['role'])){
        echo 'Welcome '.$_SESSION['firstname'];
      }
      if(count($_POST)>0){
          require_once('products.php');
          if(addItem($connection,$_POST['cat_ID'],$_POST['prod_name'],$_POST['prod_desc'],$_POST['prod_img'],$_POST['qoh'],$_POST['prod_price'],$_POST['prod_cost'],$_SESSION['user_ID'])){
            header('location: ../index.php');
          } else {
            echo 'Product not added';
        }
      }
     ?>
  </div>
    <form method="POST">
        <label for="cat_ID">Category: </label>
        <input name="cat_ID" type="text" /> <br />
        <label for="prod_name">Product name: </label>
        <input name="prod_name" type="text" /> <br />
        <label for="qoh">Quantity available: </label>
        <input name="qoh" type="number" min="0"/><br />
        <label for="prod_price">Price per item: </label>
        <input name="prod_price" type="number" min="0" step="0.0001" /><br />
        <label for="prod_cost">Cost per item: </label>
        <input name="prod_cost" type="number" min="0" step="0.0001" /><br />
        <label for="prod_desc">Product description: </label>
        <input name="prod_desc" type="text" /> <br />
        <label for="prod_img">Product image: </label>
        <input name="prod_img" type="text" /> <br />
        <button type="submit">Add product</button>
    </form>
  </div>

  </body>
</html>
