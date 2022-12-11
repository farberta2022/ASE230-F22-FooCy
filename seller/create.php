<!-- For this page to work, you must be logged in with a role 1 or higher -->
<?php
  require_once('../settings.php');
  if(isset($_SESSION['role'])) $role = $_SESSION['role'];



  // check if the users role gives them seller's privileges
  if($_SESSION['role']==0){
    header('location: ../index.php');
  	die($_SESSION['message'] = "You are not authorized to add a product");
  }
  $seller = $_SESSION['user_ID'];
  require_once('../theme/header.php');

?>
<div class="container">
  <div class="notify">
    <?php
    $choice = null;
      if(isset($_SESSION['role'])){
        echo 'Welcome '.$_SESSION['firstname'].'<hr />';
      }
      if(isset($_POST['submit'])){
        if(!empty($_POST['category'])) {
          $choice = $_POST['category'];
          echo 'You selected '.$choice;
        } else {
          echo 'Nothing selected';
        }
      }
      if(count($_POST)>0){
          require_once('products.php');
          if(addItem($connection,$choice,$_POST['prod_name'],$_POST['prod_desc'],$_POST['prod_img'],$_POST['qoh'],$_POST['prod_price'],$_POST['prod_cost'],$_SESSION['user_ID'])){
            header('location: seller.php');
          } else {
            echo 'Product not added'.'<br />';
            echo 'Category chosen: '.$choice;
        }
      }
     ?>
  </div>
  <h1>   </h1>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link" href="seller.php">Seller's Home</a></li>
          <li class="nav-item"><a class="nav-link active" href="create.php">Enter New  Product</a></li>
					<li class="nav-item"><a class="nav-link" href="delete.php">Delete  Product</a></li>
					<li class="nav-item"><a class="nav-link" href="update.php">Update  Product</a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php">Public Main</a></li>
          <li class="nav-item"><a class="nav-link" href="../libs/signout.php">Log off</a></li>
        </ul>
      </div>
    </nav>
    <br />
    <br />

  <h2>New Product Form</h2>
  <div class="container-fluid">
    <form method="POST" action="<?=htmlspecialchars($_SERVER['PHP_SELF']);?>">
      <label for="cat_ID">Category: </label>
        <select name="category">
            <option value="" disabled selected > -- select an option -- </option>
            <?php
             $result=$connection->query('SELECT * FROM categories');
             while ($category=$result->fetch()){
                  echo '<option value="'.$category['cat_ID'].'">'.$category['cat_name'].'</option>';
             }
            ?>
        </select>
       <br />
      <label for="prod_name">Product name: </label>
      <input name="prod_name" type="text" /> <br />
      <label for="qoh">Quantity available: </label>
      <input name="qoh" type="number" min="0"/><br />
      <label for="prod_price">Price per item: </label>
      <input name="prod_price" type="number" min="0" step="0.0001" /><br />
      <label for="prod_cost">Cost per item: </label>
      <input name="prod_cost" type="number" min="0" step="0.0001" /><br />
      <label for="prod_desc">Product description: </label>
      <textarea class="form-control" name="prod_desc" rows="4" cols="2"></textarea> <br />
      <label for="prod_img">Product image: </label>
      <input name="prod_img" type="text" /> <br />
      <!-- in order for functionality of drop down menu -> pass value to work, the button parameter name="submit" must be included below. If you remove it, the category ID will not pass to the function and the product will not be added to the database. -->
      <button type="submit" name="submit" value="submit" class="btn btn-primary">Add product</button>
    </form>
  </div>

</body>
</html>
