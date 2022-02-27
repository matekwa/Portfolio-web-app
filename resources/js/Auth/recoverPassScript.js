const email = document.getElementById('loginEmail');
const btn = document.getElementById('Btn');
const form = document.getElementById('form');
const token = document.getElementById('token');

form.addEventListener('submit', (e) =>{
	e.preventDefault();
	return checkInputs();
});

function checkInputs(){
	const emailValue = email.value.trim();
	const tokenValue= token.value.trim();


	if (emailValue == "") {
		setErrorFor(email,"Please enter your email!");
	} else if(!isEmail(emailValue)){
		setErrorFor(email,"Invalid Email!");
	}else{
		setSuccessFor(email);

		btn.disabled= true;
		btn.innerHTML = "<div style='display:flex;align-items:center;justify-content:center;'><div class='loader'></div>&nbsp;&nbsp;Checking...</div>";
		let checkEmail = myAjax("POST","../resources/functions.php");

		checkEmail.onreadystatechange = function(){
				 if(checkEmail.responseText == 'emailDoesNotExist'){
					setErrorFor(email, "Email does not exist in our system.");
				} else if(checkEmail.responseText == 'empty'){
					setErrorFor(email, "Please enter your email!");
				} else if(checkEmail.responseText == 'invalidEmail'){
					setErrorFor(email, "Invalid Email!");
				} else if(checkEmail.responseText == 'emailNotSent'){
					setErrorFor(email, "Something went wrong :(, please try again later.");
				} else if(checkEmail.responseText == 'emailSent'){
					document.getElementById('status').innerHTML = "Email sent successfully, check your email inbox.";
				}
			}
			checkEmail.send("recoverMail="+emailValue+"&token="+tokenValue);
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