<?php
  require_once('../settings.php');
  if(isset($_SESSION['role'])) $role = $_SESSION['role'];
  if(isset($_SESSION['message'])) unset($_SESSION['message']);

  // check if the users role gives them seller's privileges
  if($_SESSION['role']==0){
    header('location: ../index.php');
  	die($_SESSION['message'] = "You are not authorized to edit products");
  }
  $seller = $_SESSION['user_ID'];
  require_once('../theme/header.php');
  require_once('products.php');

?>
<div class="container-fluid">
  <div class="notify">
    <?php
    $choice = $productNum = $productName = $productOnHand = null;
    $productPrice = $productCost = $productImg = $productDesc = null;
    $categoryNum = $categoryName = null;
    if(isset($_SESSION['role'])){
      echo 'Welcome '.$_SESSION['firstname'].'<hr />';
    }
    // sets choice from the dropdown box
    if(isset($_POST['select'])){
      if(!empty($_POST['product'])) {
        $choice = $_POST['product'];
        $_SESSION['product'] = $_POST['product'];
        // echo 'You selected '.$choice;
        // data to populate seller view of record to update
        if(getProdView($connection,$choice, $seller)){
          $productNum = $_SESSION['prod_ID'];
          $productName = $_SESSION['prod_name'];
          $productOnHand = $_SESSION['qoh'];
          $productPrice = $_SESSION['prod_price'];
          $productCost = $_SESSION['prod_cost'];
          $productImg = $_SESSION['prod_imgs'];
          $productDesc = $_SESSION['prod_desc'];
          $categoryNum = $_SESSION['cat_ID'];
        } else {
          die($_SESSION['message'] = "Product not found");
        }
      } else {
        echo 'Nothing selected';
      }
    }
    if(isset($_SESSION['cat_ID'])){
      if(getCategory($connection,$categoryNum)) {
        $categoryName = $_SESSION['cat_name'];
      }
    }
    // $_SESSION['message'] = $_POST['product'].'" and "'.$choice;
    if(isset($_POST['confirm'])){
      $prod_ID = $_SESSION['product'];
      $prod_name = $_SESSION['prod_name'];
      $quantOnHand = $_SESSION['qoh'];
      $prod_price = $_SESSION['prod_price'];
      $prod_cost = $_SESSION['prod_cost'];
      $prod_desc = $_SESSION['prod_desc'];
      $prod_imgs = $_SESSION['prod_imgs'];
      $_SESSION['message'] = 'Product '.$prod_ID.'updated';
      if(updateProduct($connection,$prod_ID, $prod_name,$quantOnHand,$prod_price,$prod_cost,$prod_desc,$prod_imgs)){
        header('location: seller.php');
      } else {
        $_SESSION['message'] = 'Product '.$prod_ID.' not updated';
      }
    }

     ?>
  </div>
  <h1>   </h1>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link" href="seller.php">Seller's Home</a></li>
          <li class="nav-item"><a class="nav-link" href="create.php">Enter New  Product</a></li>
					<li class="nav-item"><a class="nav-link" href="delete.php">Delete  Product</a></li>
					<li class="nav-item"><a class="nav-link active" href="update.php">Update Product</a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php">Public Main</a></li>
          <li class="nav-item"><a class="nav-link" href="../libs/signout.php">Log off</a></li>
        </ul>
      </div>
    </nav>
    <br />
    <br />
    <h2>Update Product</h2>
    <div class="container-fluid">

      <?php if(isset($_SESSION['message'])) echo $_SESSION['message'] ?>
      <form method="POST">
        <label for="prod_ID">Product: </label>
          <select name="product">
              <option value="" disabled selected > -- select an option -- </option>
              <?php
                $query=$connection->prepare('SELECT prod_ID,prod_name FROM products WHERE user_ID=?');
                $query->execute([$seller]);
                while ($prods=$query->fetch()){
                  echo '<option value="'.$prods['prod_ID'].'">'.$prods['prod_ID'].'" -- "'.$prods['prod_name'].'</option>';
                 }
              ?>
          </select>
          <!-- in order for functionality of drop down menu -> pass value to work, the button parameter name="select" must be included below. If you remove it, the product ID will not pass to the function and the product will not be called. -->
          <button type="submit" name="select" value="select" class="btn btn-primary">Select product</button>
      </form>
      <br />
      <form method="POST" >

        <label for="prod_ID">Product number: <?=$productNum?></label><br />
        <label for="cat_name">Category: <?=$categoryName?></label><br />
        <label for="prod_name">Product name: </label>
        <input name="prod_name" type="text" value="<?=$productName?>" /> <br />
        <label for="qoh">Quantity available: </label>
        <input name="qoh" type="number" min="0" value="<?=$productOnHand?>"/><br />
        <label for="prod_price">Price per item: </label>
        <input name="prod_price" type="number" min="0" step="0.0001" value="<?=$productPrice?>" /><br />
        <label for="prod_cost">Cost per item: </label>
        <input name="prod_cost" type="number" min="0" step="0.0001" value="<?=$productCost?>" /><br />
        <label for="prod_desc">Product description: </label>
        <textarea class="form-control" name="prod_desc" rows="4" cols="2" value="<?=$productDesc?>">"<?=$productDesc?>"</textarea> <br />
        <label for="prod_img">Product image: </label>
        <input name="prod_img" type="text" value="<?=$productImg?>" /> <br />
        <!-- in order for functionality of drop down menu -> pass value to work, the button parameter name="submit" must be included below. If you remove it, the category ID will not pass to the function and the product will not be added to the database. -->
        <button type="submit" name="confirm" value="confirm" class="btn btn-primary">Update product</button>
      </form>
    </div>
  </body>
  </html>
