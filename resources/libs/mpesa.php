<?php
#############MPESA Daraja API Library###################
/**
 * 
 * Icludes all the MPESA APIS
 * Written by Matekwa Ronald
 * website: www.coderonald.com
 * ------------------------ All rights Reserved------------------------------------------------
 * 
 */
class MPESAAPIS{
    private $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
    private $initiate_url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
    private $b2b_url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';
    private $b2c_url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';
    private $reversal_url = 'https://sandbox.safaricom.co.ke/mpesa/reversal/v1/request';
    private $bal_url = 'https://sandbox.safaricom.co.ke/mpesa/accountbalance/v1/query';
    private $registerURL = 'https://sandbox.safaricom.co.ke/mpesa/c2b/v1/registerurl';
    private $consumerKey = CONSUMER_KEY;
    private $consumerSecret = CONSUMER_SECRET;
    private $BusinessShortCode = BUSSINESS_CODE;
    private $Passkey = PASS_KEY;
    private $SecurityCredential;

    private $access_token;
    
    #access token
    function __construct(){
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $this->url);
        $credentials = base64_encode($this->consumerKey.":".$this->consumerSecret);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        
        $curl_response = curl_exec($curl);
        
        $accessToken = json_decode($curl_response)->access_token;
        $this->access_token = $accessToken;
    }



    //Register URL
    public function registerURL($shortCode,$confirmationUrl,$validationUrl){
        $url = $this->registerURL;

        $access_token = $this->access_token;
        $shortCode = $shortCode; // provide the short code obtained from your test credentials

        /* This two files are provided in the project. */
        $confirmationUrl = $confirmationUrl; // path to your confirmation url. can be IP address that is publicly accessible or a url
        $validationUrl = $validationUrl; // path to your validation url. can be IP address that is publicly accessible or a url



        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


        $curl_post_data = array(
        //Fill in the request parameters with valid values
        'ShortCode' => $shortCode,
        'ResponseType' => 'Confirmed',
        'ConfirmationURL' => $confirmationUrl,
        'ValidationURL' => $validationUrl
        );

        $data_string = json_encode($curl_post_data);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }


    //STK initiate
    public function stk($PartyA,$AccountReference,$TransactionDesc,$Amount,$CallBackURL){
        /*
            This are your info, for
            $PartyA should be the ACTUAL clients phone number or your phone number, format 2547********
            $AccountRefference, it maybe invoice number, account number etc on production systems, but for test just put anything
            TransactionDesc can be anything, probably a better description of or the transaction
            $Amount this is the total invoiced amount, Any amount here will be 
            actually deducted from a clients side/your test phone number once the PIN has been entered to authorize the transaction. 
            for developer/test accounts, this money will be reversed automatically by midnight.
        */ 
        $Timestamp = date('YmdHis');         
        $Password = base64_encode($this->BusinessShortCode.$this->Passkey.$Timestamp);
        $initiate_url = $this->initiate_url;  
        $stkheader = ['Content-Type:application/json','Authorization:Bearer '.$this->access_token];

        # initiating the transaction
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $initiate_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $stkheader); //setting custom header
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'BusinessShortCode' => $BusinessShortCode,
            'Password' => $Password,
            'Timestamp' => $Timestamp,
            'TransactionType' => 'CustomerPayBillOnline',
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $BusinessShortCode,
            'PhoneNumber' => $PartyA,
            'CallBackURL' => $CallBackURL,
            'AccountReference' => $AccountReference,
            'TransactionDesc' => $TransactionDesc
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        print_r($curl_response);

        echo $curl_response;
    }
    
    //B2B Transaction
    public function b2b($Initiator,$Amount,$PartyA,$PartyB,$Remarks,$QueueTimeOutURL,$ResultURL){
        /* variables from Test Credentials on your developer account */
        $Initiator = $Initiator;                    # Initiator Name (Shortcode 1)
        $SecurityCredential = $this->SecurityCredential;           # SBase64 encoded string of the Security Credential, which is encrypted using M-Pesa public key
        $CommandID = 'BusinessPayBill';                    # possible values are: BusinessPayBill, MerchantToMerchantTransfer, MerchantTransferFromMerchantToWorking, MerchantServicesMMFAccountTransfer, AgencyFloatAdvance
        $SenderIdentifierType = '4';        # Type of organization sending the transaction.
        $Amount = $Amount;
        $PartyA = $PartyA ;                       # Shortcode 1
        $PartyB = $PartyB;                       # Shortcode 2
        $AccountReference = 'BILL PAYMENT';             # Account Reference mandatory for “BusinessPaybill” CommandID.
        $Remarks = $Remarks;                      # Anything Goes here/string/int/varchar
        $QueueTimeOutURL = $QueueTimeOutURL;              # QueueTimeOutURL
        $ResultURL = $ResultURL;                    # ResultURL
        $b2bHeader = ['Content-Type:application/json','Authorization:Bearer '.$this->access_token];
        /* Main B2B API Call Section */
        $b2b_url = $this->b2b_url;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $b2b_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $b2bHeader); //setting custom header

        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'Initiator' => $Initiator,
            'SecurityCredential' => $SecurityCredential,
            'CommandID' => $CommandID,
            'SenderIdentifierType' => $SenderIdentifierType,
            'RecieverIdentifierType' => $SenderIdentifierType,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'AccountReference' => $AccountReference,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        print_r($curl_response);
        echo $curl_response;
    }


    //B2C Function
    public function b2c($InitiatorName,$CommandID,$Amount,$PartyA,$PartyB,$QueueTimeOutURL,$ResultURL){
        $access_token_url = $this->access_token;
        $b2c_url = $this->b2c_url;
        /* Main B2C Request to the API */
        $b2cHeader = ['Content-Type:application/json','Authorization:Bearer '.$access_token];
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $b2c_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $b2cHeader); //setting custom header
        $curl_post_data = array(
            //Fill in the request parameters with valid values
            'InitiatorName' => $InitiatorName,
            'SecurityCredential' => $this->SecurityCredential,
            'CommandID' => $CommandID,
            'Amount' => $Amount,
            'PartyA' => $PartyA,
            'PartyB' => $PartyB,
            'Remarks' => $Remarks,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'ResultURL' => $ResultURL,
            'Occasion' => $Occasion
        );
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        print_r($curl_response);
        echo $curl_response;
    }


    //Reverse
    public function reverse($Initiator,$TransactionID,$Amount,$ReceiverParty,$ResultURL,$QueueTimeOutURL,$Remarks){
            $reversal_url = $this->reversal_url;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $reversal_url);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->ccess_token));
            $curl_post_data = array(
            'Initiator' => $Initiator,
            'SecurityCredential' => $this->SecurityCredential,
            'CommandID' => 'TransactionReversal',
            'TransactionID' => $TransactionID,
            'Amount' => $Amount,
            'ReceiverParty' => $ReceiverParty,
            'RecieverIdentifierType' => '11',
            'ResultURL' => $ResultURL,
            'QueueTimeOutURL' => $QueueTimeOutURL,
            'Remarks' => $Remarks,
            'Occasion' => 'Web Purchase'
            );

            $data_string = json_encode($curl_post_data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
            $curl_response = curl_exec($curl);
            print_r($curl_response);
            echo $curl_response;
    }



    //Balance
    public function balance($Initiator,$PartyA,$QueueTimeOutURL,$ResultURL){
        $bal_url = $this->bal_url;
      
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $bal_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->access_token)); //setting custom header
      
        $curl_post_data = array(
          //Fill in the request parameters with valid values
          'Initiator'           => $Initiator,                      # initiator name -> For test, use Initiator name(Shortcode 1)
          'SecurityCredential'  => $this->SecurityCredential,        #Base64 encoded string of the Security Credential, which is encrypted using M-Pesa public key 
          'CommandID'           => 'AccountBalance',        # Command ID, Possible value AccountBalance             
          'PartyA'              => $PartyA,                      # ShortCode 1, or your Paybill(During Production) 
          'IdentifierType'      => '4',                      
          'Remarks'             => 'Account Balance',                      # Comments- Anything can go here
          'QueueTimeOutURL'     => $QueueTimeOutURL,                      # URL where Timeout Response will be sent to
          'ResultURL'           => $ResultURL                   # URL where Result Response will be sent to
        );
      
        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        print_r($curl_response);
        echo $curl_response;
    }


    //Transaction status query
    public function transactionStatusQuery($Initiator,$TransactionID,$PartyA,$ResultURL,$QueueTimeOutURL,$Remarks,$Occasion){
        $tstatus_url = 'https://sandbox.safaricom.co.ke/mpesa/transactionstatus/v1/query';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $tstatus_url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$this->access_token));
        $curl_post_data = array(
        'Initiator' => $Initiator,
        'SecurityCredential' => $this->SecurityCredential,
        'CommandID' => 'TransactionStatusQuery',
        'TransactionID' => $TransactionID,
        'PartyA' => $PartyA, // shortcode 1
        'IdentifierType' => '4',
        'ResultURL' => $ResultURL,
        'QueueTimeOutURL' => $QueueTimeOutURL,
        'Remarks' => $Remarks,
        'Occasion' => $Occasion
        );

        $data_string = json_encode($curl_post_data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
        $curl_response = curl_exec($curl);
        print_r($curl_response);
        echo $curl_response;
    }


    #Callback function in callback url
    public function callBack($logFile){
        $callbackResponse = file_get_contents('php://input');
        $logFile = $logFile;
        $log = fopen($logFile, "a");
        fwrite($log, $callbackResponse);
        fclose($log);
    }

}