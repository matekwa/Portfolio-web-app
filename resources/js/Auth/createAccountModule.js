const form = document.getElementById('createAccountForm');
const createAccountBtn = document.getElementById('createAccountBtn');
const email = document.getElementById('emailCreate');
const username = document.getElementById('usernameCreate');
const phone = document.getElementById('phoneCreate');
const pass1 = document.getElementById('pass1');
const pass2 = document.getElementById('pass2');
let status= document.getElementById('status');


form.addEventListener('submit',(e)=> {
	e.preventDefault();

	return checkInputs();	
});

function checkInputs(){
	const emailValue = email.value.trim();
	const usernameValue = username.value.trim();
	const phoneValue = phone.value.trim().replace(/[^0-9]/g,"");
	const pass1Value = pass1.value.trim();
	const pass2Value = pass2.value.trim();

	if (emailValue === '') {
		setErrorFor(email,'Email cannot be blank.');
		return false;
	} else if(!isEmail(emailValue)){
		setErrorFor(email,'Email is invalid.');
		return false;
	}else{
		setSuccessFor(email);
	}

	if (usernameValue === '') {
		setErrorFor(username,'Username cannot be blank.');
		return false;
	} else if(usernameValue.length < 3 && usernameValue.length > 16){
		setErrorFor(username,"3 - 16 characters required.");
		return false;
	} else{
		setSuccessFor(username);
	}

	if (phoneValue === '') {
		setErrorFor(phone,'Enter your phone number.');
		return false;
	} else if(phoneValue.length != 10){
		setErrorFor(phone,'Invalid phone number.');
		return false;
	} else if(phoneValue[0] != 0){
		setErrorFor(phone,'Use the format: 07X XXX XXXX.');
		return false;
	} else{
		setSuccessFor(phone);
	}

	if (pass1Value === '') {
		setErrorFor(pass1,'Enter a password.');
		return false;
	} else if(pass1Value.length < 5){
		setErrorFor(pass1,'Password too weak.');
		return false;
	} else{
		setSuccessFor(pass1);
	}
	if (pass2Value === '') {
		setErrorFor(pass2,'This field cannot be left out.');
		return false;
	} else if(pass1Value != pass2Value){
		setErrorFor(pass2,'Passwords does not match!');
		return false;
	}else{
		setSuccessFor(pass2);
	}
	
			if (isChecked() == false) {
		status.innerHTML = "<div style = 'color:red;'>Read terms and conditions</div>";
		return false;
	} else{
		status.innerHTML = "<div style = 'color:green; font-weight:600;'>That`s all, Please wait...</div>";
		createAccountBtn.disabled = true;
		createAccountBtn.innerHTML = "<div style='display:flex;align-items:center;'><div class='loader'></div>&nbsp;&nbsp;Processing...</div>";
		let newuser = myAjax("POST", "../resources/functions.php");
				newuser.onreadystatechange = function(){
					if (ajaxStatus(newuser) == true){
					  if (newuser.responseText.replace(/^\s+|\s+$/g, "") == "signup_success"){
					  	 	window.scrollTo(0,0);
					      document.getElementById("createAccountForm").innerHTML = "<p style = 'font-size:15px;'>Account created successfully <span style='font-weight: bold; font-style: italic'>" + usernameValue + "</span>, now check your email inbox at <span style='color: blue'>"+ emailValue + "</span> to confirm your Email for account activation.</p>";
					    
					  } else {
					      status.innerHTML = "<div style = 'color:red;'>"+newuser.responseText+"</div>";
					      createAccountBtn.disabled = false;
					      createAccountBtn.innerHTML = "Try again";
					      return false;
					  }
					}
					}
				newuser.send("emailCreate="+emailValue+"&usernameCreate="+usernameValue+"&phoneCreate="+phoneValue+"&passwordCreate="+pass2Value);	
	}
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

function isChecked() {
    let checked = document.getElementById("terms").checked;
    if (checked) {
		return true;
	} else {
		return false;
	}
}

function checkEmail(){
 emailValue = email. value.trim();
 if (emailValue == '') {
 	setErrorFor(email,"Email cannot be blank");
 	return false;
 } else{
 	let emailCheck = myAjax("POST", "../resources/functions.php")
        emailCheck.onreadystatechange = function()
		 {
			if (ajaxStatus(emailCheck) == true) {
				if (emailCheck.responseText.replace(/^\s+|\s+$/g, "") === 'wrong_format') {
					setErrorFor(email,'Email is invalid.');
					return false;
	            	} else if(emailCheck.responseText.replace(/^\s+|\s+$/g, "") === 'exist'){
	            		setErrorFor(email,'Email exists for another account.');
	            		return false;
	            	} else{
	            		setSuccessFor(email);            		
	            	}
			}
		}
		emailCheck.send('emailCheck='+emailValue);
 }
}

function checkUsername(){
 usernameValue = username.value.trim();
 if (usernameValue == '') {
 	setErrorFor(username,"Username cannot be blank!");
 	return false;
 } else{
		let usernameCheck = myAjax("POST", "../resources/functions.php")
        usernameCheck.onreadystatechange = function()
		 {
			if (ajaxStatus(usernameCheck) == true) {
				if (usernameCheck.responseText.replace(/^\s+|\s+$/g, "") === 'ok') {
					setSuccessFor(username); 
	            	} else{
	            		  setErrorFor(username,usernameCheck.responseText);
								return false;          		
	            	}
			}
		}
		usernameCheck.send('usernameCheck='+usernameValue);	
 }
}


