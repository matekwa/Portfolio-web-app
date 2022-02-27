const btn = document.getElementById('payBtn');
const name = document.getElementById('fullName');
const phoneNumber = document.getElementById('phone');
const amount = document.getElementById('amount');
const form = document.getElementById('mpesaForm');

form.addEventListener("submit", function(e){
	e.preventDefault();

	 checkInputs();
})

function checkInputs(){
	let nameValue = name.value.trim();
	let phoneValue = phoneNumber.value.trim().replace(/[^0-9]/g, "");
	let amountValue = amount.value.trim();

	if (nameValue == "") {
		setErrorFor(name, "Please provide you name.");
		return false;
	} else{
		setSuccessFor(name);
	}

	 if(phoneValue == ""){
		setErrorFor(phone, "Please enter your phone number");
	} else if (phoneValue[0] != 0){
		setErrorFor(phone,'Use the format: 07X XXX XXXX.');
		return false;
	} else if(phoneValue.length != 10){
		setErrorFor(phone,'Invalid phone number.');
		return false;
	} else{
		let cutPhonenumber = phoneValue.substr(1,9);
		phoneValue = "254".concat(cutPhonenumber);
		setSuccessFor(phone);
	}

	if (amountValue == "") {
		setErrorFor(amount, "Kindly enter any amount.");
		return false;
	} else{
		setSuccessFor(amount);
	}

	btn.disabled = true;
	btn.innerHTML = "<div style='display:flex;align-items:center;'><div class='loader'></div>&nbsp;&nbsp;Processing...</div>";
	let transactionInitiate = myAjax("POST", "../resources/mpesaPayment.php");
	 transactionInitiate.onreadystatechange = function() {
			if (ajaxStatus(transactionInitiate) == true) {
				if (transactionInitiate.responseText === "phoneEmpty") {
					setErrorFor(phone, "Please enter your phone number");
					return false
				} else if (transactionInitiate.responseText === "nameEmpty") {
					setErrorFor(name, "Please provide you name.");
					return false;
				} else if (transactionInitiate.responseText === "noAmount") {
					setErrorFor(amount, "Kindly enter any amount.");
					return false;
				} else{
					alert(transactionInitiate.responseText);
				}
			}
		}
		transactionInitiate.send('mpesaPhone='+phoneValue+"&mpesaAmount="+amountValue+"&fullName="+nameValue);
}


function setErrorFor(input,message){
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');

	small.innerText = message;
	formControl.className  = "formcontrol error";
}

function setSuccessFor(input){
	const formControl = input.parentElement;
	formControl.className  = "formcontrol success";
}

function myAjax(method, url) {
    let x;
    try{
	//For Opera 8.0+,Firefox,Safari and chrome
	x = new XMLHttpRequest();
} catch(e){
	try{
		//For Internet Explore Browsers
	x = new ActiveXObject('Msxml2.XMLHTTP');
	} catch{
		try{
		x = new ActiveXObject("Microsoft.XMLHTTP");
			} catch(e){
				//Browser doesn't support AJAX object
				alert("Browser doesn't support JavaScript please get an updated browser.");
			}
	}
}
x.open(method,url,true);
x.setRequestHeader("Content-type","application/x-www-form-urlencoded");
return x;
}

function ajaxStatus(x) {
	if (x.readyState == 4 && x.status == 200) {
		return true;
	}
}