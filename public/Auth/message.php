<?php 
    require_once("../resources/config.php");
	$message = "No message";
	if (isset($_GET['msg'])) {	
		$msg  = preg_replace("#[^a-z0-9._,() :]#i", '', $_GET['msg']);
		if ($msg == 'activation_failure') {
			$message = "<h2>Activation Error :(</h2> Sorry there seems to have a problem with <span style='font-weight:bold;color:red;'>activation of your account</span>,we will notify you shortly via your e-mail when we figure it out at our end";
		} elseif ($msg == 'activation_success') {
			$message = '<strong style ="color:blue; font-size:20px;"> Activation sucessfull! </strong></br>';
		} else{
			$message = $msg;
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/png" href="../resources/images/fav.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Status</title>
	<!--------------Font awesome CDN Link------------------>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" />
	<style type="text/css">
		*{
			box-sizing: border-box;
		}
		html{
			overflow-x: hidden;
			scroll-behavior: smooth;
		}
		html::-webkit-scrollbar{
			width: .8rem;
		}
		html::-webkit-scrollbar-track{
			background: transparent;
		}
		html::-webkit-scrollbar-thumb{
			background: #dadae6;
			border-radius: 5rem;
		}
		header{
			display: flex;
			align-items: center;
			justify-content: center;
		}
		header h3{
			padding: 5px;
			font-size: 30px;
			font-weight: 600;
			color: #fff;
		}
		header h3 span{
			color: #1181b2;
		}
		body{	
			background: #141466;
			min-height: 100vh;
			margin: 0;
		}
		.container{
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.container .card{
			background: #dadae6;
			border-radius: 5px;
			width: 400px;
			max-width: 100%;
			box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
		}
	</style>	
</head>
<body>
<main>
	 <header>
		<h3>Code<span>ronald</span></h3>
	</header>
	<div class="container">
		<div class="card">
			<div class="text-center"><?php  echo $message; ?> </div>
		</div>
	</div>
</main>
</body>
</html>
