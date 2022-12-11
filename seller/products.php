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
    function deleteProd($connection, $choice){
        $query=$connection->prepare('DELETE FROM products WHERE prod_ID=?');
        $query->execute([$choice]);
        return true;
    }
    // currently testing
    function updateProduct($connection,$prod_ID,$prod_name,$quantOnHand,$prod_price,$prod_cost,$prod_desc,$prod_imgs){
        $query=$connection->prepare('UPDATE products SET prod_name=?,quantOnHand=?,prod_price=?,prod_cost=?,prod_desc=?,prod_imgs=? WHERE prod_ID=?');
        $query->execute([$prod_name,$quantOnHand,$prod_price,$prod_cost,$prod_desc,$prod_imgs, $prod_ID]);
        $result=$query->fetch();
        $_SESSION['message']="Product added";
        return true;
    }
    function getProdView($connection,$prod_ID,$user_ID){
        $query=$connection->prepare('SELECT * FROM products WHERE prod_ID=? AND user_ID=?');
        $query->execute([$prod_ID,$user_ID]);
        $result=$query->fetch();
        $_SESSION['prod_ID']= $result['prod_ID'];
        $_SESSION['cat_ID']= $result['cat_ID'];
        $_SESSION['prod_name']= $result['prod_name'];
        $_SESSION['qoh']= $result['quantOnHand'];
        $_SESSION['prod_price'] = $result['prod_price'];
        $_SESSION['prod_cost'] = $result['prod_cost'];
        $_SESSION['prod_imgs'] = $result['prod_imgs'];
        $_SESSION['prod_desc'] = $result['prod_desc'];
        return true;
    }

    function getCategory($connection,$cat_ID){
        $query=$connection->prepare('SELECT * FROM categories WHERE cat_ID=?');
        $query->execute([$cat_ID]);
        $result=$query->fetch();
        if(!empty($result)) {
          $_SESSION['cat_name']=$result['cat_name'];
          return true;
        } else {
          $_SESSION['message']="No match for category.";
          return false;
        }
      }
    function getProduct($connection,$prod_ID){
        $query=$connection->prepare('SELECT * FROM products WHERE prod_ID=?');
        $query->execute([$prod_ID]);
        $result=$query->fetch();
        $_SESSION['prod_ID']=$result['prod_ID'];
        $_SESSION['prod_name']=$result['prod_name'];
        $_SESSION['qoh']=$result['quantOnHand'];
        return true;
    }


    // not currently in use
    function viewItems($connection,$user_ID){
      $query=$connection->prepare('SELECT * FROM products WHERE user_ID=?');
      $query->execute([$user_ID]);
      $result=$query->fetch();
    	if($user_ID != $result['user_ID'] || count($result) == 0) {
        $_SESSION['message']="No products found for user: ".$user_ID;
        return false;
      return true;
    }



    // not currently in use
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
