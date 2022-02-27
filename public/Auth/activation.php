<?php
	require_once("../resources/config.php");
	if (isset($_GET['id']) && isset($_GET['e']) && isset($_GET['u']) && isset($_GET['p']) && isset($_GET['v']) ) {
		//Immah sanitize incoming $_GET variables and connect to the database also
				$user_id = preg_replace('#[^0-9]#i', '', $_GET['id']);
				$email = $_GET['e'];
				$username = preg_replace("#[^a-zA-Z0-9._]#i", '', $_GET['u']);
				$password = $_GET['p'];
				$validationcode = $_GET['v'];

		//Evaluate the length of the incoming $_GET variables
		if ($user_id == "" || strlen($username)<3 || strlen($email)<5 || strlen($password) < 3){
				//Log these issues into a text file and email to yourself
				header("location:message.php?msg=A problem occured with activation string length,please try again.");
				exit(); 
			}

		//We check the credentials against the database
		$stmt = $pdo->prepare("SELECT * FROM clients WHERE validationCode=? && id=? && email=? && username=? && password=?");
		$stmt->execute([$validationcode,$user_id,$email,$username,$password]);
		$numRows = $stmt->rowCount();

		//Evaluate for a match in the database(0 = no match, 	1 = there's a match)
		if ($numRows == 0) {
			//Log this attempt to a text file and email the details to yourself
			header("location:message.php?msg=Your credentials are not matching anything in our system");
			exit();
		} else {
		//If a match was found then we can activate
		$stmt1 =  $pdo->prepare("UPDATE clients SET active = :active,validationCode = :validationCode WHERE id = :id && email = :email && password = :password ");
		$stmt1->execute(['active' => 1,'validationCode' =>0,'id' =>$user_id,'email' =>$email,'password' =>$password]);
		header("location:message.php?msg=activation_success&id=$user_id");
	}

		//Double check if active is set to '1'
		$stmt2 = $pdo->prepare("SELECT * FROM clients WHERE id=? AND active=?");
		$stmt2->execute([$user_id,1]);
		$row = $stmt2->rowCount();

		//Send back to message.php activation status
		if ($row == 0) {
			//Log this issue of activate = '0'
			header("location:message.php?msg=activation_failure");
			exit();
		} elseif ($row > 0) {
			//Everything went out successfull and activation is confirmed
			header("location:message.php?msg=activation_success");
			exit();
		} else {
		//You can log any issues of missing $_GET variables here
		header("location:message.php?msg=Missing_GET_variables");
		exit();
	} 
}
?>