<?php

//Admin Functions
require_once('../settings.php');

function AdminCreateCat($connection, $categoryName){
    $query=$connection->prepare('SELECT * FROM categories WHERE cat_name=?');
    $query->execute([$categoryName]);
    if($query->rowCount()>0) {
        $_SESSION['message']="Category already exists.";
        return false;
    }
    $query=$connection->prepare('INSERT INTO categories(cat_name) VALUES (?)');
    $query->execute([$categoryName]);
    $_SESSION['message']="Category Added.";
    return true;
}
function AdminDelteCat($connection, $catgegoryID){
    $query=$connection->prepare('DELETE FROM categories WHERE cat_ID=?');
    $query->execute([$catgegoryID]);
}
function AdminModifyCat($connection, $catgegoryID){
    $query=$connection->prepare('UPDATE categories SET cat_name=? WHERE cat_ID=?');
    $query->execute([$_POST['cat_name'],$_GET['id']]);
}