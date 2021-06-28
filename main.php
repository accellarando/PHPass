<?php
echo "Have you edited config.php yet?\n";

require "config.php";

$conn = mysqli_connect($host,$user,$password,$db);

if($conn) 
	echo "Database connected.\n";
else
	die(mysqli_connect_error($conn));

//make a backup of the passwords column
$backup = $column."_backup";
$query = "ALTER TABLE $table ADD $backup TEXT NOT NULL";
mysqli_query($conn,$query);
$query = "UPDATE $table SET $backup = $column";
mysqli_query($conn,$query);
$query = "ALTER TABLE $table CHANGE $column $column TEXT NOT NULL";
mysqli_query($conn,$query);

if(!mysqli_error($conn))
	echo "Passwords backed up.\n";
else
	die(mysqli_error($conn));

//Implement temp_password column
$query = "ALTER TABLE $table ADD temp_password TEXT NOT NULL DEFAULT '1'";
if(!mysqli_query($conn,$query))
	die(mysqli_error($conn));

//hash the passwords
$query = "SELECT * FROM $table";
$users = mysqli_fetch_all(mysqli_query($conn,$query), MYSQLI_ASSOC);

foreach($users as $user){
	$password = $user[$column];
	$id = $user[$primary];
	$newPassword = password_hash($password, $alg);
	if(!$newPassword)
		die("Password hash FAILED for user $id");
	$query = "UPDATE $table SET 
		$column = '$newPassword'
		WHERE $primary = $id";
	//echo $query;
	if(!mysqli_query($conn,$query))
		die(mysqli_error($conn));
}
echo "Passwords hashed.";

//Direct the user to make this change:
echo "Now, put something like this in your login page.\n";

echo '$result = mysqli_fetch_all(mysqli_query($conn, "SELECT * FROM '.$table.' WHERE username = $username"),MYSQLI_ASSOC);'."\n";
echo 'if(password_verify($password,$result[0]["password"])){
	$_SESSION["logged_in"]=true;';

echo "\n You'll probably also want to implement a 'temporary password' page to add new users, instead of directly adding them to the database. I'll work on that feature another day. Or maybe never.";

echo "\n Check that you can log in and stuff. If you're good, delete the $backup column from the database!!";

?>
