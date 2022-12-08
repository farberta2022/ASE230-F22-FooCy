<?php
echo '<pre>';
print_r($_POST);
print_r($_FILES);
if(count($_FILES)>0){
  // store the file
  move_uploaded_file($_FILES['product_image']["tmp_name"],'images/'.uniqid().'.'.pathinfo($_FILES['product_image']["name"])['extension']);

  // store the file path to the database
  // code inncomplete, needs connection info
  $query->prepare('INSERT INTO products(prod_imgs) VALUES(?)');
  $query->execute(['images/'.uniqid().'.'.pathinfo($_FILES['product_image']["name"])['extension']]);
}



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form method ="post" enctype ="multipart/form-data" >
      Select image to upload:
      <input type ="file" name ="product_image">
      <button type="submit" >Upload</button>
    </form>
  </body>
</html>
