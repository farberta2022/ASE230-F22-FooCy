<?php
//settings.php

$host='127.0.0.1';				
$db='foocommercects';					
$user='root';					
$pass='';						
$port=3306;
$charset='utf8mb4';

$options=[
	\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION,
	\PDO::ATTR_DEFAULT_FETCH_MODE=>\PDO::FETCH_ASSOC,
	\PDO::ATTR_EMULATE_PREPARES=>false,
];

// Specify connection
$connection=new \PDO("mysql:host=$host;dbname=$db;charset=$charset;port=$port",$user,$pass, $options);

if(session_status()!=PHP_SESSION_ACTIVE) session_start();