<?php

require_once "config.php";
require_once "libs/pdoDB.php";
require_once "libs/mpesa.php";

$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

if(isset($POST['mpesaPhone']) && isset($POST['mpesaAmount']) && isset($POST['fullName'])){
	$phoneNumber = $POST['mpesaAmount'];
	$name = $POST['fullName'];
	$amount = $POST['mpesaAmount'];

	if (empty($phoneNumber)) {
		echo "phoneEmpty";
		return false;
	} elseif (empty($name)) {
		echo "nameEmpty";
		return false;
	} elseif (empty($amount)) {
		echo "noAmount";
		return false;
	} else{

		$mpesa = new MPESAAPIS;
		mpesa->stk($phoneNumber, $phoneNumber, "Support Me", $amount, "http://www.coderonald.com/");
	}
}
