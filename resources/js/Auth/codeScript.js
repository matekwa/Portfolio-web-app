const code = document.getElementById('code');
const btn = document.getElementById('Btn');
const form = document.getElementById('form');
const email = document.getElementById('email');

form.addEventListener('submit', (e) =>{
	e.preventDefault();
	return checkInputs();
});

function checkInputs(){
	const codeValue = code.value.trim();
	const emailValue = email.value.trim();


	if (codeValue == "") {
		setErrorFor(code,"Please enter a code!");
	} else if(codeValue.length != 6){
		setErrorFor(code,"Code must be 6 characters!");
	}else{
		setSuccessFor(code);

		btn.disabled= true;
		btn.innerHTML = "<div style='display:flex;align-items:center;justify-content:center;'><div class='loader'></div>&nbsp;&nbsp;Confirming...</div>";
		let checkCode = myAjax("POST","../resources/functions.php");

		checkCode.onreadystatechange = function(){
				 if(checkCode.responseText == 'cookieExpired'){
					setErrorFor(code, "Sorry, your code has expired.");
				} else if(checkCode.responseText == 'noParameter'){
					setErrorFor(code, "No parameters received, try again");
				} else if(checkCode.responseText == 'wrongCode'){
					setErrorFor(code, "Wrong code!");
				} else if (checkCode.responseText == 'redirect'){
					window.location = "reset-password.php?email="+emailValue;
				}
			}
			checkCode.send("code="+codeValue+"&email="+emailValue);
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