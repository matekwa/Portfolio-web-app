<?php require_once ('../resources/config.php');?>
<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="image/png" href="../resources/images/fav.png">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LIPA NA MPESA</title>
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
		.loader {
		border: 2px solid var(--lightblue);
		border-top: 2px solid #3498db;
		border-radius: 50%;
		width: 20px;
		height: 20px;
		animation: spin .3s linear infinite;
		}

		@keyframes spin {
		0% { transform: rotate(0deg); }
		100% { transform: rotate(360deg); }
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
		.loginContainer{
			display: flex;
			align-items: center;
			justify-content: center;
		}
		.loginContainer .card{
			background: #dadae6;
			border-radius: 5px;
			width: 400px;
			max-width: 100%;
			box-shadow: 0 2px 5px rgba(0, 0, 0, .3);
		}
		.logInCardHeader .flex-box a{
			margin: 10px 0 10px 0;
			text-decoration: none;
		}
		.loginHeader{
			display: flex;
			align-items: center;
			justify-content: center;
			background-color: #f7f7f7;
			border-bottom: 1px solid #f0f0f0;
			padding: 20px 40px;
		}
		.loginHeader h2{
			margin: 0;
		}
		.haveAccount{
			padding-top: 5px;
			text-decoration: none;
		}
		form{
			padding: 30px 40px;
		}
		.formcontrol{
		margin-bottom: 10px;
		padding-bottom: 17px;
		position: relative;
		}
		.formcontrol label{
		display: inline-block;
		margin-bottom: 5px;
		}
		.formcontrol input{
		border: 2px solid #141466;
		border-radius: 4px;
		display: block;
		font-family: inherit;
		text-transform: none;
		font-size: 14px;
		padding: 10px;
		outline: none;
		width: 100%;
		background: none;
		color: #141466;
		}
		.formcontrol.success input{
			border-color: #2ecc71;
		}
		.formcontrol.error input{
			border-color: #e74c3c;
		}
		.formcontrol i{
		position: absolute;
		top: 40px;
		right: 10px;
		visibility: hidden;
		}
		.formcontrol small{
		visibility: hidden;
		position: absolute;
		bottom: 0;
		left: 0;
		}
		.formcontrol.error small{
		visibility: visible;
		color: #e74c3c;
		}
		.formcontrol.success i.fa-check-circle{
		color: #2ecc71;
		visibility: visible;
		}
		.formcontrol.error i.fa-exclamation-circle{
		color: #e74c3c;
		visibility: visible;
		}
		form button{
		margin-top: 9px;
		background-color: #141466;
		border:2px solid #141466;
		border-radius: 4px;
		color: #fff;
		display: block;
		font-family: inherit;
		font-size: 16px;
		font-weight: 600;
		padding: 10px;
		width: 100%;
		cursor: pointer;
		}
		form button:hover{
			color: #1181b2;
		}
		.terms{
		font-size: 16px;
		margin-bottom: 10px;
		}
		.terms a{
			text-decoration: none;
		}
		@media (max-width: 900px){
			.loginContainer .card{
				width: 320px;
			}
			.terms{
				font-size: 13px;
			}
		}
	</style>
</head>
<body>
	<header>
		<h3>Code<span>ronald</span></h3>
	</header>
	<div class="loginContainer">
			<div class="card">
				<div class="loginHeader">
					<img src="../resources/images/logos/mpesa.PNG" alt="Mpesa">
				</div>
				<form id="mpesaForm" onsubmit="return false;">
					<div class="formcontrol">
						<label>Name</label>
						<input type="text" placeholder = "Full name" autofocus id="fullName" >
						<i class="fas fa-check-circle"></i>
						<i class="fas fa-exclamation-circle"></i>
						<small></small>
					</div>
					<div class="formcontrol">
						<label>Mpesa Phone Number</label>
						<input type="telephone" placeholder = "Phone number" id="phone">
						<i class="fas fa-check-circle"></i>
						<i class="fas fa-exclamation-circle"></i>
						<small></small>
					</div>
					<div class="formcontrol">
						<label>Amount</label>
						<input type="number" placeholder = "Amount" id="amount">
						<i class="fas fa-check-circle"></i>
						<i class="fas fa-exclamation-circle"></i>
						<small></small>
					</div>
					<button id="payBtn">Pay</button>
				</form>
			</div>
	</div>
	<script type="text/javascript" src="../resources/js/mpesaScript.js"></script>
</body>
</html>