<?php
  require_once('../settings.php');
  if(isset($_SESSION['role'])) $role = $_SESSION['role'];

  // check if the users role gives them seller's privileges
  if($_SESSION['role']==0){
    header('location: ../index.php');
  	die($_SESSION['message'] = "You are not authorized to delete products");
  }
  $seller = $_SESSION['user_ID'];
  require_once('../theme/header.php');
  require_once('products.php');

?>
<div class="container-fluid">
  <div class="notify">
    <?php
    $choice = null;
    $productNum = null;
    $productName = null;
    $productOnHand = null;
      if(isset($_SESSION['role'])){
        echo 'Welcome '.$_SESSION['firstname'].'<hr />';
      }
      // sets choice from the dropdown box
      if(isset($_POST['select'])){
        if(!empty($_POST['product'])) {
          $choice = $_POST['product'];
          $_SESSION['product'] = $_POST['product'];
          // echo 'You selected '.$choice;
          if(getProduct($connection,$choice)){
            $productName = $_SESSION['prod_name'];
            $productOnHand = $_SESSION['qoh'];
            $productNum = $_SESSION['prod_ID'];
            // data to populate seller view of record to delete
          } else {
            die($_SESSION['message'] = "Product not found");
          }
        } else {
          echo 'Nothing selected';
        }
      }
    // $_SESSION['message'] = $_POST['product'].'" and "'.$choice;
    if(isset($_POST['confirm'])){
      $choiceCNF = $_SESSION['product'];
      $_SESSION['message'] = 'Product '.$choiceCNF.'deleted';
      if(deleteProd($connection,$choiceCNF)){
        header('location: seller.php');
      } else {
        $_SESSION['message'] = 'Product '.$choiceCNF.' not deleted';
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
					<li class="nav-item"><a class="nav-link active" href="delete.php">Delete Product</a></li>
					<li class="nav-item"><a class="nav-link" href="update.php">Update  Product</a></li>
          <li class="nav-item"><a class="nav-link" href="../index.php">Public Main</a></li>
          <li class="nav-item"><a class="nav-link" href="../libs/signout.php">Log off</a></li>
        </ul>
      </div>
    </nav>
    <br />
    <br />

  <h2>Delete Product</h2>
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
       <form method="POST">
         <table>
           <thead>
             <h3>Is this is the product you want to delete?</h3>
           <tr>
             <th>Product number</th>
             <th>Product name</th>
             <th>Inventory on hand</th>
           </tr>
          </thead>
           <tr>
             <td><?=$productNum?></td>
             <td><?=$productName?></td>
             <td><?=$productOnHand?></td>
           </tr>
         </table>
         <br />

         <input type="submit" name="confirm" value="Confirm"/>
       </form>


  </div>

</body>
</html>
