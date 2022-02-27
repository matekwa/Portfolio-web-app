<?php require_once ('../resources/config.php');?>
<!DOCTYPE html>
<html>
<head>
    <link rel="shortcut icon" type="image/png" href="../resources/images/fav.png">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Me</title>
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
        .loginHeader{
            background-color: #f7f7f7;
            border-bottom: 1px solid #f0f0f0;
            padding: 20px 20px;
        }
        .loginHeader p{
            margin: 0;
            font-weight: 600;
            font-size: 25px;
        }
        .paymentMethodBox{
            padding: 30px 40px;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: center;
            gap: 20px;
            width: 100%;
        }
        .payBox{
            border-radius: 4px;
            display: block;
            padding: 10px;
            outline: none;
            width: 100%;
            background: none;
            color: #141466;
        }
        .payBox img{
            width: 100%;
            height: 100%;
        }
        .payBox:hover{
             border: 1px solid #141466;
        }
        .back{
            width: 100%;
            margin-bottom: 20px;
            margin-left: 40%;
        }
        .back a{
            text-decoration: none;
            font-weight: 600;
        }
        @media (max-width: 900px){
            .loginContainer .card{
                width: 320px;
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
                    <p>Choose Payment Method</p>
                </div>
                   <div class="paymentMethodBox">
                       <div class="mpesa payBox">
                         <a href="mpesa.php"><img src="../resources/images/logos/mpesa.PNG" alt="Mpesa"></a>
                       </div>
                       <div class="payPal payBox">
                           <a href="paypal.php"><img src="../resources/images/logos/paypal.PNG" alt="Paypal"></a>
                       </div>
                       <div class="creditCard payBox">
                           <a href="visa.php"><img src="../resources/images/logos/visa.PNG" alt="Visa"></a>
                       </div>
                   </div>
                   <div class="back">
                       <a href="index.php">&lt;&lt; Back </a>
                   </div>
            </div>
    </div>
</body>
</html>