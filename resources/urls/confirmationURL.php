<?php
		header("Content-Type: application/json");

		$response = '{
				"ResultCode": 0, 
				"ResultDesc": "Confirmation Received Successfully"
		}';

		// DATA
		$mpesaResponse = file_get_contents('php://input');
		$mpesaJSON = json_decode($mpesaResponse)

		$data = new Data;
		$data->saveMpesaTransaction(JSON_stringify($mpesaJSON));

		$log = fopen(M_PESAConfirmationResponse.txt, "a");
		fwrite($log, $mpesaResponse);
		fclose($log);



		echo $response;
?>
