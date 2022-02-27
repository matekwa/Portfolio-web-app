const form = document.getElementById('loginForm');
const loginBtn = document.getElementById('loginBtn');
const loginEmail = document.getElementById('loginEmail');
const loginPassword = document.getElementById('loginPassword');
const loginStatus = document.getElementById('status');

form.addEventListener('submit',(e) =>{
	e.preventDefault();
	return checkInput();
});


function checkInput(){
	const emailValue = loginEmail.value.trim();
	const passwordValue = loginPassword.value.trim();
	if (isChecked) {
		const rememberMe = "checked";
	} else{
		const rememberMe = "unChecked";
	}
	if (emailValue == "") {
		setErrorFor(loginEmail,"Email cannot be blank.");
		return false;
	} else if(!isEmail(emailValue)){
		setErrorFor(loginEmail,"Invalid Email.");
		return false;
	} else{
		setSuccessFor(loginEmail);
	}

	if (passwordValue === "") {
		setErrorFor(loginPassword, "Password is required.");
		return false;
	} else{
		setSuccessFor(loginPassword);
	}

	loginBtn.disabled= true;
	loginBtn.innerHTML = "<div style='display:flex;align-items:center;justify-content:center;'><div class='loader'></div>&nbsp;&nbsp;Validating...</div>";
	let checkDetails = myAjax("POST","../resources/functions.php");

	checkDetails.onreadystatechange = function(){
			if (checkDetails.responseText == 'wrongEmail') {
				setErrorFor(loginEmail,"Wrong Email");
				return false;
			} else if(checkDetails.responseText == 'emailDoesNotExist'){
				setErrorFor(loginEmail, "Email does not exist. Create an account first.");
				return false;
			} else if(checkDetails.responseText == 'wrongPassword'){
				setErrorFor(loginPassword,"Wrong Password.");
				return false;
			} else if(checkDetails.responseText == 'loginFailed'){
				loginStatus.innerHTML = "<div style = 'color:red;'>Log in failed. Try again.</div>";
				loginBtn.disabled = false;
				loginBtn.innerHTML = "Try Again";
				return false;
			} else if(checkDetails.responseText == 'welcome') {
				loginStatus.innerHTML = "<div style = 'color:green;'>Log In successfull. Redirecting...</div>";
				window.location = "index.php?welcome";
			}
		}
		checkDetails.send("loginEmail="+emailValue+"&loginPassword="+passwordValue+"&rememberMe="+rememberMe);
}

function setErrorFor(input,message){
	const formControl = input.parentElement;
	const small = formControl.querySelector('small');

	small.innerText = message;
	formControl.className  = "formcontrol error";
	loginBtn.disabled = false;
	loginBtn.innerHTML = "Try Again";
	return false;
}

function setSuccessFor(input){
	const formControl = input.parentElement;
	formControl.className  = "formcontrol success";
}

function isEmail(email){
	var re =  /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	return re.test(String(email).toLowerCase());
}

function isChecked() {
    let checked = document.getElementById("rememberMe").checked;
    if (checked) {
		return true;
	} else {
		return false;
	}
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