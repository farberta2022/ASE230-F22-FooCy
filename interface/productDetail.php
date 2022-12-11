<?php
//product detail
require_once('../settings.php');

$result=$connection->query('SELECT * FROM products WHERE prod_ID='.$_GET['id'].'');
     echo '<table>';
     while($product=$result->fetch()){
       echo '<tr>
            <td>'.$product['prod_name'].'</td>
         </tr>
         <tr>
            <td>Description: </td>
            <td>'.$product['prod_desc'].'</td>
        </tr>
        <tr>
            <td>'.$product['prod_imgs'].'</td>
         </tr>
         <tr>
            <td>Price:</td>
            <td>'.$product['prod_price'].'</td>
       </tr>';
     }
    echo '</table>';
    
?>
    <a href="buyProduct.php">
        <button type="submit" >Buy Now!</button>
    </a>
