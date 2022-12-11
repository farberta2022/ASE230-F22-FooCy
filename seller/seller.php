<?php
// index of products for requesting seller-user

require_once('../settings.php');
// check if the users role gives them seller's privileges
if(count($_SESSION)>0 && ($_SESSION['role']) != 1){
	header('location: ../index.php');
	die($_SESSION['message'] = "You are not authorized to access this area");
}

if(isset($_SESSION['role'])) {
	require_once('products.php');
  $role = $_SESSION['role'];
  $seller = $_SESSION['user_ID'];
  $sellerNm = $_SESSION['firstname'];
} else {
  $_SESSION['message'] = 'No role set, something went wrong';
}
require_once('../theme/header.php');
?>
<div class="container">
  <div class="notify">
    <?php
      if(isset($_SESSION['message'])){
        echo $_SESSION['message'].'<br>';
      }
    ?>
  </div>
  <!-- <h1>Seller Dashboard</h1> -->
  <h1>   </h1>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
        <ul class="nav nav-tabs">
          <li class="nav-item"><a class="nav-link active" href="seller.php">Seller's Home</a></li>
          <li class="nav-item"><a class="nav-link" href="create.php">Enter New  Product</a></li>
					<li class="nav-item"><a class="nav-link" href="delete.php">Delete  Product</a></li>
					<li class="nav-item"><a class="nav-link" href="update.php">Update  Product</a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php">Public Main</a></li>
          <li class="nav-item"><a class="nav-link" href="../libs/signout.php">Log off</a></li>
        </ul>
      </div>
    </nav>
    <br />
    <br />

  <h2>List of products for <?=$sellerNm?></h2>
	<br />
	<!-- <button type="submit" name="submit" value="Submit" class="btn btn-primary">Delete selected</button> -->
  <?php

  //view all products for user-seller
  $query=$connection->prepare('SELECT * FROM products WHERE user_ID=?');
  $query->execute([$seller]);
  echo '<table class="table">';
  echo '<thead>
  <tr>
    <th>Category</th>
    <th>Product ID</th>
    <th>Product Name</th>
    <th>onHand</th>
    <th>Cost</th>
    <th>Sales Price</th>
    <th>Date Added</th>
    <th>Image1</th>
    <th>Description</th>
  </tr>
  </thead>';
	// get category name from categories using cat_ID in products
  while($products=$query->fetch()){
		if(getCategory($connection,$products['cat_ID'])) {
			$catName = $_SESSION['cat_name'];
		}
    echo
    '<tr>
      <td>'.$catName.'</td>
      <td>'.$products['prod_ID'].'</td>
      <td>'.$products['prod_name'].'</td>
      <td>'.$products['quantOnHand'].'</td>
      <td>'.$products['prod_cost'].'</td>
      <td>'.$products['prod_price'].'</td>
      <td>'.$products['date_prod_added'].'</td>
      <td>'.$products['prod_imgs'].'</td>
      <td>'.$products['prod_desc'].'</td>
    </tr>';
  }
  echo '</table>';


   ?>
