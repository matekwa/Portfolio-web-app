const messageForm = document.getElementById('contactMeForm');
const contactName = document.getElementById('name');
const contactEmail = document.getElementById('email');
const contactPhone = document.getElementById('phone');
const subject = document.getElementById('subject');
const contactMessage = document.getElementById('message');
const contactStatus = document.getElementById('status');
const messageBtn = document.getElementById('messageBtn');

messageForm.addEventListener('submit',(e) => {
	e.preventDefault();

	return checkInputs();
});

function checkInputs(){
	nameValue = contactName.value.trim();
	emailValue = contactEmail.value.trim();
	phoneValue = contactPhone.value.trim().replace(/[^0-9]/g , "");
	subjectValue = subject.value.trim();
	messageValue = contactMessage.value.trim();

	if (nameValue == "" || emailValue == "" || phoneValue == "" || subjectValue == "" || messageValue == "") {
		contactStatus.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Please Fill All the fields.</div>";
		return false;
	} else if(phoneValue.length != 10){
		contactStatus.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Invalid phone number.</div>";
		return false;
	} else if(phoneValue[0] != 0){
		contactStatus.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Use the format: 07X XXX XXXX for phone number.</div>";
		return false;
	} else{
		messageBtn.disabled = true;
		messageBtn.innerHTML = "<div style='display:flex;align-items:center;'><div class='loader'></div>&nbsp;&nbsp;Sending...</div>";
		let sendMessage = myAjax("POST", "../resources/functions.php");
		sendMessage.onreadystatechange = function(){
			if (ajaxStatus(sendMessage) == true){
			  if (sendMessage.responseText.replace(/^\s+|\s+$/g, "") == "sent"){
			  	contactStatus.innerHTML = "<div style = 'color:green;'>Message sent successfully!</div>"
			  } else {
			  		messageBtn.disabled = false;
			  		messageBtn.innerHTML = "Try again";
			      contactStatus.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>"+sendMessage.responseText+"</div>";
			      return false;
			  }
			}
			}
		sendMessage.send("contactName="+nameValue+"&contactEmail="+emailValue+"&contactPhone="+phoneValue+"&subject="+subjectValue+"&contactMessage="+
			messageValue);	
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