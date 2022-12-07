<?php

//auth.php
require_once('../settings.php');


function signupUser($connection,$email,$password, $firstname, $lastname){
	$query=$connection->prepare('SELECT * FROM users WHERE email=?');
	$query->execute([$email]);
	if($query->rowCount()>0) return false;
	$query=$connection->prepare('INSERT INTO users(email,password, firstname, lastname) VALUES(?,?,?,?)');
	$query->execute([$email,password_hash($password,PASSWORD_DEFAULT), $firstname, $lastname]);
	return true;
}
function signupSeller($connection,$email,$password, $firstname, $lastname){
	$query=$connection->prepare('SELECT * FROM users WHERE email=?');
	$query->execute([$email]);
	if($query->rowCount()>0) return false;
	$query=$connection->prepare('INSERT INTO users(email,password, firstname, lastname, role, date_account_created) VALUES(?,?,?,?,?,?)');
	$query->execute([$email,password_hash($password,PASSWORD_DEFAULT), $firstname, $lastname, 1, date("Y-m-d H:i:s")]);
	return true;
}

function signin($connection,$email,$password){
	$query=$connection->prepare('SELECT * FROM users WHERE email=?');
	$query->execute([$email]);
	if($query->rowCount()==0) return false;
	$result=$query->fetch();
	if(!password_verify($password,$result['password'])) return false;
	$_SESSION['user_ID']=$result['user_ID'];
	$_SESSION['role']=$result['role'];
	$_SESSION['firstname']=$result['firstname'];
	$_SESSION['lastname']=$result['lastname'];
	return true;
}

function signout(){
	$_SESSION=[];
	session_destroy();
}