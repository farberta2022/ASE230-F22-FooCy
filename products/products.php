<?php
    require_once('../settings.php');

    function addItem($connection,$cat_ID,$prod_name,$prod_desc,$prod_imgs,$quantOnHand,$prod_price,$prod_cost,$user_ID){
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



?>
