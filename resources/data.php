<?php
class Data{
	private $db;

	public function __construct(){
		$this->db = new Database;
	}

	public function getServices(){
		$this->db->query("SELECT * FROM servicesprovided");
		$result = $this->db->resultSet();
		return $result;
	}

	public function getAbout(){
		$this->db->query("SELECT * FROM about");
		$result = $this->db->resultSet();
		return $result;
	}

	public function getTeam(){
	$this->db->query("SELECT * FROM team");
	$result = $this->db->resultSet();
	return $result;
	}

	public function getSkills(){
	$this->db->query("SELECT * FROM skills");
	$result = $this->db->resultSet();
	return $result;
	}

	public function getServiceCard(){
	$this->db->query("SELECT * FROM servicecards");
	$result = $this->db->resultSet();
	return $result;
	}

	public function saveMpesaTransaction($data){
		$this->db->query('INSERT INTO mpesapayments (TransactionType,TransID,TransTime,TransAmount,BusinessShortCode,BillRefNumber,InvoiceNumber,OrgAccountBalance,ThirdPartyTransID,MSISN,FirstName,MiddleName,LastName) VALUES(:TransactionType,:TransID,:TransTime,:TransAmount:,:BusinessShortCode,:BillRefNumber,:InvoiceNumber,:OrgAccountBalance,:ThirdPartyTransID,:FirstName,:MiddleName,:LastName)');

		$this->db->bind(':TransactionType', $data['TransactionType']);
		$this->db->bind(':TransID', $data['TransID']);
		$this->db->bind(':TransTime', $data['TransTime']);
		$this->db->bind(':TransAmount', $data['TransAmount']);
		$this->db->bind(':BusinessShortCode', $data['BusinessShortCode']);
		$this->db->bind(':BillRefNumber', $data['BillRefNumber']);
		$this->db->bind(':InvoiceNumber', $data['InvoiceNumber']);
		$this->db->bind(':OrgAccountBalance', $data['OrgAccountBalance']);
		$this->db->bind(':ThirdPartyTransID', $data['ThirdPartyTransID']);
		$this->db->bind(':MSISN', $data['MSISN']);
		$this->db->bind(':FirstName', $data['FirstName']);
		$this->db->bind(':MiddleName', $data['MiddleName']);
		$this->db->bind(':LastName', $data['LastName']);

		try {
			$this->db->execute();
		} catch(PDOException $e){
			$errLog = fopen("error.txt", "a");
			fwrite($errLog, $e->getMessage());
			fclose($errLog);


			$failedTrans = fopen("failedTranscations.txt", "a");
			fwrite($failedTrans, json_encode($data));
			fclose($failedTrans);
		}

	}
}