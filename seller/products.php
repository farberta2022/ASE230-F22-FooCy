<?php
    require_once('../settings.php');

    function addItem($connection,$cat_ID,$prod_name,$prod_desc='',$prod_imgs=NULL,$quantOnHand,$prod_price,$prod_cost,$user_ID){
        $query=$connection->prepare('SELECT * FROM categories WHERE cat_ID=?');
        $query->execute([$cat_ID]);
        if($query->rowCount()<1) {
          $_SESSION['message']="No match for category.";
          return false;
        }

        $query=$connection->prepare('INSERT INTO products(cat_ID,prod_name,prod_desc,prod_imgs,quantOnHand,prod_price,prod_cost,user_ID) VALUES (?,?,?,?,?,?,?,?) ');
        $query->execute([$cat_ID,$prod_name,$prod_desc,$prod_imgs,$quantOnHand,$prod_price,$prod_cost,$user_ID]);
        $_SESSION['message']="Product added";
        return true;
    }

    function viewItems($connection,$user_ID){
      $query=$connection->prepare('SELECT * FROM products WHERE user_ID=?');
      $query->execute([$user_ID]);
      $result=$query->fetch();
    	if($user_ID != $result['user_ID'] || count($result) == 0) {
        $_SESSION['message']="No products found for user: ".$user_ID;
        return false;
      return true;
    }

    function updateItem($connection,$prod_ID,$user_ID){
        $query=$connection->prepare('SELECT * FROM products WHERE prod_ID=?');
        $query->execute([$prod_ID]);
        $result=$query->fetch();
        if($query->rowCount()<1) {
          $_SESSION['message']="No match for product ID.";
          return false;
        }
        if($user_ID != $result['user_ID']) {
          $_SESSION['message'] = "You do not have access to that product.";
          return false;
        }

        $query=$connection->prepare('INSERT INTO products(cat_ID,prod_name,prod_desc,prod_imgs,quantOnHand,prod_price,prod_cost,user_ID) VALUES (?,?,?,?,?,?,?,?) ');
        $query->execute([$cat_ID,$prod_name,$prod_desc,$prod_imgs,$quantOnHand,$prod_price,$prod_cost,$user_ID]);
        $_SESSION['message']="Product added";
        return true;
    }

    function verifyUser($prod_ID,$user_ID){
      $query=$connection->prepare('SELECT * FROM products WHERE prod_ID=?');
    	$query->execute([$prod_ID]);
      $result=$query->fetch();
    	if($user_ID != $result['user_ID']) return false;
      return true;
    }

    
    }

// $_SESSION['user_ID']=$result['user_ID'];
// $_SESSION['role']=$result['role'];
// $_SESSION['firstname']=$result['firstname'];
// $_SESSION['lastname']=$result['lastname'];




?>
