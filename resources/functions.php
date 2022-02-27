<?php
require_once ('config.php');


$POST = filter_var_array($_POST, FILTER_SANITIZE_STRING);

// if (isset($POST['loginEmail']) && isset($POST['loginPassword'])) {
// 	$loginEmail = $POST['loginEmail'];
// 	$loginPassword = md5($POST['loginPassword']);
// 	$rememberMe = $POST['rememberMe'];
// 	if ($loginEmail == "" || $loginPassword == "") {
// 		echo "loginFailed";
//         exit();
// 	} else{
//     $ip = preg_replace('#[^0-9.]#i', '', getenv('REMOTE_ADDR'));
// 	$login = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
//     $login->execute([$loginEmail]);
//     $emailCheck = $login->rowCount();
// 	$details = $login->fetchAll();
//     foreach($details as $detail) {
//         $dbEmail = $detail['email'];
//         $dbPassword = $detail['password'];
//         $dbPhone = $detail['phoneNumber'];
//         $dbUsername = $detail['username'];
//         $dbID = $detail['id'];
//     }
// 	if ($emailCheck == 0) {
// 		echo "emailDoesNotExist";
//         exit();
// 	} else if($dbEmail != $loginEmail){
// 		echo "wrongEmail";
//          exit();
// 	} else if($dbPassword != $loginPassword){
// 		echo "wrongPassword";
//          exit();
// 	} else{
// 		$_SESSION['id'] = $dbID;
// 		$_SESSION['email'] = $dbEmail;
// 		$_SESSION['phone'] = $dbPhone;
// 		$_SESSION['username'] = $dbUsername;
// 		if ($rememberMe == "remember") {
// 			setcookie("id",$dbID,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("username",$dbUsername,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("email",$dbEmail,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("phone",$dbPhone,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("password",$loginPassword,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("ip",$ip,strtotime('+30 days'),"/","","",TRUE);
// 			setcookie("lastLogin",date('d/m/Y h:i:sa'),strtotime('+30 days'),"/","","",TRUE);
// 		}
// 		$stmt = $pdo->prepare("UPDATE clients SET ipAddress = ?, lastLogin = ? WHERE id = ?");
// 		$stmt->execute([$ip,date('d/m/Y h:i:sa'),$dbID]);
// 		echo "welcome";
// 		exit();
// 	}
// 	}
// }

// if (isset($POST['emailCheck'])) {
// 	$email = $POST['emailCheck'];
// 	if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
//         echo 'wrong_format';
//         exit();
//     } else{
// 	$stmt1 = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
// 	$stmt1->execute([$email]);
// 	$count = $stmt1->rowCount();
// 	if ($count > 0) {
// 		echo "exist";
//         exit();
// 	}
// }
// }

// if (isset($POST["usernameCheck"])){
//     $username = $POST['usernameCheck'];
//     $stmt2 =  $pdo->prepare('SELECT * FROM clients WHERE username = ?');
//     $stmt2->execute([$username]);
// 	$count = $stmt2->rowCount();
	
//     if (!preg_match("/^[a-zA-Z0-9._]*$/", $username)) {
//         echo 'Letters,numbers, . or _ for username!';
//         exit();
//     } else if (is_numeric($username[0])) {
//          echo 'Username must begin with a letter';
//         exit();
//     } else if ($count >= 1) {
//         echo "Username exists.";
// 		exit();
//     } else{
//         echo "ok";
//     }
    
// }


// if (isset($POST['emailCreate'])){
//     $email = $POST['emailCreate'];
//     $username = $POST['usernameCreate'];
//     $password = $POST['passwordCreate'];
//     $p_hash = md5($password);
//     $phone_number = $POST['phoneCreate'];
//     $validation_code =  md5($username.microtime());
//     $ip = preg_replace('#[^0-9.]#i', '', getenv('REMOTE_ADDR'));
  

//     $stmt1 = $pdo->prepare('SELECT * FROM clients WHERE email = ?');
//     $stmt1->execute([$email]);
//     $emailCheck = $stmt1->rowCount();

//     $stmt2 =  $pdo->prepare('SELECT * FROM clients WHERE username = ?');
//     $stmt2->execute([$username]);
//     $userNameCheck = $stmt2->rowCount();

//     if ($email == "" || $username == ""| $phone_number == "" || $password == "") {
//         echo 'Please Fill In All The Data Above First!';
//         exit();
//     } else if ($userNameCheck>0) {
//         echo 'The Username You Entered Is Taken!';
//         exit();
//     } else if ($emailCheck>0) {
//         echo 'The E-mail You Entered Is Already In Use By Another Account!';
//         exit();
//     } else if (strlen($username)<3 || strlen($username)>16) {
//         echo 'Username Should Have 3-16 Characters!';
//         exit();
//     } else if (is_numeric($username[0])) {
//         echo 'Username Should Begin With a Letter!';
//         exit();
//     } else if (!preg_match("/^[a-zA-Z0-9._]*$/", $username)) {
//         echo 'Letters,numbers, . or _ for username!';
//         exit();
//     } else  if (!filter_var($email,FILTER_VALIDATE_EMAIL)) {
//         echo 'Invalid Email!';
//         exit();
//     } else{
//         $stmt3 = $pdo->prepare('INSERT INTO clients(email,phoneNumber,username,password,ipAddress,lastLogin,active,validationCode) VALUES(:email, :phone, :username, :password, :ip, :lastLogin, :active, :validationCode)');
//         $stmt3->execute(['email'=>$email,'phone'=>$phone_number,'username'=>$username,'password'=>$p_hash,'ip'=>$ip,'lastLogin'=>date('d/m/Y h:i:sa'),'active'=>'0','validationCode'=>$validation_code]);
//         $uid = $pdo->lastInsertId();
//         // ob_start();
                
//         //             $mail = new PHPMailer(true);
//         //             $to = "$email";
//         //             $subject = "Account Activation";
//         //             $message = required('../resources/mails/createMail.php');
//         //             try {
//         //                         //Server settings
//         //                         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//         //                         $mail->isSMTP();                                            //Send using SMTP
//         //                         $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
//         //                         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//         //                         $mail->Username   = 'support@swifftshop.com';                     //SMTP username
//         //                         $mail->Password   = 'customer37016568';                               //SMTP password
//         //                         $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//         //                         $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
//         //                         //Recipients
//         //                         $mail->setFrom('support@swifftshop.com', 'swifftshop.com');
//         //                         $mail->addAddress($to);               //Name is optional
                            
                            
                               
//         //                         //Content
//         //                         $mail->isHTML(true);                                  //Set email format to HTML
//         //                         $mail->Subject = $subject;
//         //                         $mail->Body    = $message;
                            
//         //                         $mail->send();
//         //                         ob_get_clean();
//                             if ($uid > 0) {
//                                 echo "signup_success";
//                                 exit();
//                                 } else{
//                                     echo 'Something went wrong, Pleae try again.';
//                                     exit();
//                                 }
//         //                     } catch (Exception $e) {
//         //                         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
//         //                          exit();
//         //                     } 
//     }
// }


// if (isset($POST['recoverMail']) && isset($POST['token'])) {
//     $email = $POST['recoverMail'];
//     $token = $POST['token'];
//     if ($email == "") {
//         echo "empty";
//         exit();
//     } else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
//         echo "invalidEnmail";
//         exit();
//     } else{
//         $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ?");
//         $stmt->execute([$email]);
//         $count = $stmt->rowCount();
//         if ($count == 0) {
//             echo "emailDoesNotExist";
//             exit();
//         } else{
//             $code = random_number_generator(6);
//             setcookie('tempCode',$code,time()+600,"/");
//              $stmt = $pdo->prepare("UPDATE clients set validationCode = $code WHERE email = ?");
//              $stmt->execute([$email]);

//                  ob_start();
//                     $mail = new PHPMailer(true);
//                     $to = $email;
//                     $subject = "Password Re-set";
//                     $message = '<!DOCTYPE html><html lang="eng"><head><meta charset="UTF-8"><title>Password Recovery</title></head><body style="margin:0px; font-family:Tahoma, Geneva, sans-serif;"><div style="padding:10px; background:#45ccb8; font-size:24px; color:yellow;">Account Recovery</div><div style="padding:24px; font-size:17px;">Hello,<br>Click the link below to reset your password<br><br><a href="localhost/public/code.php?Email=$email">Reset Password</a><br><br>And use the code <b>".$code."</b> <br /></div></body></html>';
//                     try {
//                                 //Server settings
//                                 $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//                                 $mail->isSMTP();                                            //Send using SMTP
//                                 $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
//                                 $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//                                 $mail->Username   = 'support@swifftshop.com';                     //SMTP username
//                                 $mail->Password   = 'customer37016568';                               //SMTP password
//                                 $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
//                                 $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
//                                 //Recipients
//                                 $mail->setFrom('support@swifftshop.com', 'swifftshop.com');
//                                 $mail->addAddress($to);               //Name is optional
                            
                            
                               
//                                 //Content
//                                 $mail->isHTML(true);                                  //Set email format to HTML
//                                 $mail->Subject = $subject;
//                                 $mail->Body    = $message;
                            
//                                 $mail->send();
//                                 ob_get_clean();
//                                 echo "emailSent";
//                             } catch (Exception $e) {
//                                 echo "emailNotSent";
//                                  exit();
//                             } 
               
//         }

//     }
//  }
// if (isset($POST['code']) && isset($POST['email'])) {
//         if ($_COOKIE['tempCode']) {
//                 $code = $POST['code'];
//                 $email = $POST['email'];
//                 if (empty($code) || empty($email)) {
//                     echo "noParameter";
//                     exit();
//                 } else{
//                     $stmt = $pdo->prepare("SELECT * FROM clients WHERE email = ? && validationCode = ?");
//                     $stmt->execute([$email,$code]);
//                     $count = $stmt->rowCount();
//                     if ($count == 0) {
//                        echo "wrongCode";
//                     } else{
//                         setcookie('tempCode',$code,time()+300,"/");
//                         echo "redirect";
//                     }
//                 }
//         } else{
//             echo "cookieExpired";
//             exit();
//         }
// } 


// if (isset($POST['pass1']) && isset($POST['pass2'])  && isset($POST['token2']) ) {
//     if (isset($_COOKIE['tempCode'])) {
//         $pass1 = $POST['pass1'];
//         $pass2 = $POST['pass2'];
//         $token = $POST['token2'];
//         $email = $POST['resetEmail'];
//         if (empty($pass1)) {
//             echo "pass1Blank";
//             exit();
//         } else if (empty($pass2)) {
//             echo "pass2Blank";
//             exit();
//         } else if($pass1 != $pass2){
//              echo "unmatch";
//             exit();
//         } else if(isset($_SESSION['token'])){
//            $newPassword = md5($pass2);
//            $stmt = $pdo->prepare("UPDATE clients set password = ?,validationCode = ? WHERE email = ?");
//            $stmt->execute([$newPassword,0,$email]);
//            echo "success";
//         } else{
//             echo "noTokens";
//         }
//     } else{
//         echo "timeExpired";
//         }
// }

 


if (isset($POST['cService'])) {
    $service = $POST['cService'];
    $name = $POST['cName'];
    $email = $POST['cEmail'];
    $phone = $POST['cPhone'];
    $description = $POST['cDescription'];
    $time = date('d/m/Y h:i:sa');

    if ($service != "" && $name != "" && $email != "" || $phone != "" || $description != "" ) {
        $stmt = $pdo->prepare('INSERT INTO servicerequests(name,service,email,phoneNumber,description,timeOfRequest) VALUES(:name, :service, :email, :phone, :description, :timeOfRequest)');
        $stmt->execute(['name'=>$name,'service'=>$service,'email'=>$email,'phone'=>$phone,'description'=>$description,'timeOfRequest'=>$time]);
        $uid = $pdo->lastInsertId();
                // ob_start();
                
        //             $mail = new PHPMailer(true);
        //             $to = "matekwaronald@gmail.com";
        //             $subject = "Client request";
        //             $message = required('../resources/mails/bookMail.php');
        //             try {
        //                         //Server settings
        //                         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        //                         $mail->isSMTP();                                            //Send using SMTP
        //                         $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
        //                         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //                         $mail->Username   = 'support@swifftshop.com';                     //SMTP username
        //                         $mail->Password   = 'customer37016568';                               //SMTP password
        //                         $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        //                         $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
        //                         //Recipients
        //                         $mail->setFrom('support@swifftshop.com', 'coderonald.com');
        //                         $mail->addAddress($to);               //Name is optional
                            
                            
                               
        //                         //Content
        //                         $mail->isHTML(true);                                  //Set email format to HTML
        //                         $mail->Subject = $subject;
        //                         $mail->Body    = $message;
                            
        //                         $mail->send();
        //                         ob_get_clean();
                            if ($uid > 0) {
                                echo "send";
                                exit();
                                } else{
                                    echo 'Something went wrong, Pleae try again.';
                                    exit();
                                }
        //                     } catch (Exception $e) {
        //                         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //                          exit();
        //                     } 
        echo "send";
    } else{
        echo "Sorry! something happened, please try again.";
    }
}

if(isset($POST['contactName']) && isset($POST['contactEmail']) && isset($POST['contactPhone']) && isset($POST['subject']) && $POST['contactMessage']) {
    $name = $POST['contactName'];
    $email = $POST['contactEmail'];
    $phone = $POST['contactPhone'];
    $subject = $POST['subject'];
    $message = $POST['contactMessage'];
    $time = date('d/m/Y h:i:sa');

    if ($name != "" || $email != "" || $phone != "" || $subject != "" || $message != "" ) {
        $stmt = $pdo->prepare('INSERT INTO messages(name,email,phone,subject,message,timeSent) 
            VALUES(:name, :email, :phone, :subject, :message, :timeSent)');
        $stmt->execute(['name'=>$name, 'email'=>$email, 'phone'=>$phone, 'subject'=>$subject, 'message'=>$message, 'timeSent'=>$time]);
        $lid = $pdo->lastInsertId();
        if ($lid > 0) {
            echo "sent";
            exit();
        } else{
            echo 'Message not sent, Please try again.';
            exit();
        }
                // ob_start();
                
        //             $mail = new PHPMailer(true);
        //             $to = "matekwaronald@gmail.com";
        //             $subject = "Client request";
        //             $message = required('../resources/mails/bookMail.php');
        //             try {
        //                         //Server settings
        //                         $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        //                         $mail->isSMTP();                                            //Send using SMTP
        //                         $mail->Host       = 'fin104.truehost.cloud';                     //Set the SMTP server to send through
        //                         $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        //                         $mail->Username   = 'support@swifftshop.com';                     //SMTP username
        //                         $mail->Password   = 'customer37016568';                               //SMTP password
        //                         $mail->SMTPSecure = 'tls';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        //                         $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
                            
        //                         //Recipients
        //                         $mail->setFrom('support@swifftshop.com', 'coderonald.com');
        //                         $mail->addAddress($to);               //Name is optional
                            
                            
                               
        //                         //Content
        //                         $mail->isHTML(true);                                  //Set email format to HTML
        //                         $mail->Subject = $subject;
        //                         $mail->Body    = $message;
                            
        //                         $mail->send();
        //                         ob_get_clean();
                            
        //                     } catch (Exception $e) {
        //                         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        //                          exit();
        //                     } 
    } else{
        echo "Sorry! something happened, please try again.";
    }
}

