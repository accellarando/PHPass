<?php
//Use this to configure the database you're connecting to, as well as the absolute paths to the webpages being modified.

$host	  = "localhost";	//hostname or IP address for MySQL server
$user	  = "root";			//MySQL account username
$password = "secret";		//MySQL account password
$db		  = "insecure";		//the database we're fixing

$table	 = "users";		//the problematic table
$column  = "password";	//the passwords we're hashing
$primary = "id";		//the primary key for this table

$alg = PASSWORD_DEFAULT; //for the password_hash function; you're probably good to leave it be
?>
