<?php

ob_start();
session_start();
// session_destroy();
defined("DS")? null: define("DS", DIRECTORY_SEPARATOR);
defined("DB_HOST")? null: define("DB_HOST", "127.0.0.1");
defined("DB_USER")? null: define("DB_USER", "root");
defined("DB_PASSWORD")? null: define("DB_PASSWORD", "");
defined("DB_NAME")? null: define("DB_NAME", "coderonald");


//MPESA CONSTANTS
defined("CONSUMER_KEY")? null: define("CONSUMER_KEY", "coderonald");
defined("CONSUMER_SECRET")? null: define("CONSUMER_SECRET", "coderonald");
defined("BUSSINESS_CODE")? null: define("BUSSINESS_CODE", "coderonald");
defined("PASS_KEY")? null: define("PASS_KEY", "coderonald");



$dsn = 'mysql:host='. DB_HOST. ';dbname='. DB_NAME;

$pdo = new pdo($dsn, DB_USER, DB_PASSWORD);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


// function token_generator(){
// 	$token = $_SESSION['token']= md5(uniqid(mt_rand(),true));
// 	return $token;
// }


// function random_number_generator($length){
// 	$result = "";
// 	$chars = "0123456789";
// 	$charsArray = str_split($chars);
// 	for ($i=0; $i < $length; $i++) { 
// 		$randItem = array_rand($charsArray);
// 		$result .= $charsArray[$randItem];
// 	}
// 	return $result;
// }

$time = date("G");
if ($time >= 03 && $time < 12) {
    $greetings = "Good Morning";
} elseif ($time >= 12 && $time < 17) {
    $greetings = "Good Afternoon";
} elseif ($time >= 17 && $time < 20) {
   $greetings = "Good Evening";
} else{
   $greetings = "Good Night";
} 
