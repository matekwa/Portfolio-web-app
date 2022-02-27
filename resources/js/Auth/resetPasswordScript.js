const pass1 = document.getElementById('newPass1');
const pass2 = document.getElementById('newPass2');
const btn = document.getElementById('Btn');
const form = document.getElementById('form');
const token2 = document.getElementById('token2');
const status = document.getElementById('status');
const email = document.getElementById('email');

form.addEventListener('submit', (e) =>{
	e.preventDefault();
	return checkInputs();
});

function checkInputs(){
	const pass1Value = pass1.value.trim();
	const pass2Value = pass2.value.trim();
	const emailValue = email.value.trim();

	if (pass1Value > 5) {
		setErrorFor(pass1,"Password too weak.");
	} else if(pass1Value == ""){
		setErrorFor(pass1,"New password is required!");
	} else{
		setSuccessFor(pass1);
	} 
	if(pass2Value == ""){
		setErrorFor(pass2,"Please confirm new password!");
	} else if(pass1Value != pass2Value){
		setErrorFor(pass2,"Passwords do not match!");
	} else{
		setSuccessFor(pass2);

		btn.disabled= true;
		btn.innerHTML = "<div style='display:flex;align-items:center;justify-content:center;'><div class='loader'></div>&nbsp;&nbsp;Confirming...</div>";
		let passChange = myAjax("POST","../resources/functions.php");

		passChange.onreadystatechange = function(){
				 if(passChange.responseText == 'pass1Blank'){
					setErrorFor(pass1, "New password is required!");
				} else if(passChange.responseText == 'pass2Blank'){
					setErrorFor(pass2, "Please confirm new password!");
				} else if(passChange.responseText == 'unmatch'){
					setErrorFor(pass2, "Passwords do not match!");
				} else if (passChange.responseText == 'timeExpired'){
					status.innerHTML = "Your Time Period Has Expired.";
					btn.disabled = true;
					btn.innerText = "Try Again";
					return false;
				} else if (passChange.responseText == 'noTokens'){
					status.innerHTML = "No tokens received.";
					btn.disabled = true;
					btn.innerText = "Try Again";
					return false;
				} else if(passChange.responseText == 'success'){
					window.location = "login.php?success"
				}
			}
			passChange.send("pass1="+pass1Value+"&pass2="+pass2Value+"&token2="+token2+"&resetEmail="+emailValue);
		}
}


function setErrorFor(input,message){
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');

	small.innerText = message;
	formControl.className = "formcontrol error";
	btn.disabled = false;
	btn.innerText = "Try Again";
	return false;
}


function setSuccessFor(input){
	const formControl = input.parentElement;
	formControl.className = "formcontrol success";
}


function isEmail(email){
	var re =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
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