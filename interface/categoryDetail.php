<?php
//category detail
require_once('../settings.php');

$result=$connection->query('SELECT * FROM products WHERE cat_ID='.$_GET['id'].'');
     echo '<table>';
     while($product=$result->fetch()){
       echo '<tr>
         <td><a href="productDetail.php?id='.$product['prod_ID'].'">'.$product['prod_name'].'</a></td>
       </tr>';
     }
     echo '</table>';