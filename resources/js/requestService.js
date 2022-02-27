const form = document.getElementById('hireForm');
const hireBtn = document.getElementById('hireBtn');
const service = document.getElementById('service');
const name = document.getElementById('clientName');
const email = document.getElementById('clientEmail');
const phone = document.getElementById('clientPhonenumber');
const description = document.getElementById('serviceDescription');
const status = document.getElementById('hireStatus');

hireForm.addEventListener('submit',(e) => {
	e.preventDefault();

	return checkInputs();
});

function checkInputs(){
	serviceValue = service.value;
	nameValue = name.value.trim();
	emailValue = email.value.trim();
	phoneValue = phone.value.trim().replace(/[^0-9]/g,"");
	descriptionValue = "No description";
	descriptionValue = description.value.trim();

	if (serviceValue == "" || nameValue == "" || emailValue == "" || phoneValue == "") {
		status.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Please Fill All the fields.</div>";
		return false;
	} else if(phoneValue.length != 10){
		status.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Invalid phone number.</div>";
		return false;
	} else if(phoneValue[0] != 0){
		status.innerHTML = "<div style = 'color:#F80000; font-size:15px;'>Use the format: 07X XXX XXXX for phone number.</div>";
		return false;
	} else{
		hireBtn.disabled = true;
		hireBtn.innerHTML = "<div style='display:flex;align-items:center;'><div class='loader'></div>&nbsp;&nbsp;Sending...</div>";
		let serviceRequest = myAjax("POST", "../resources/functions.php");
				serviceRequest.onreadystatechange = function(){
					if (ajaxStatus(serviceRequest) == true){
					  if (serviceRequest.responseText.replace(/^\s+|\s+$/g, "") == "send"){
					  		form.innerHTML = "<div style='color:#dadae6; font-size:14px;display:flex;flex-direction:column;align-items:center;justify-content:center;'><img src='../resources/images/success.PNG' width='70px;' style='background:#dadae6;border-radius:50%;box-shadow: 0 2px 5px rgba(0, 0, 0, .3);margin-bottom:15px;'>Request received, We'll get back to you ASAP.</div>";			    
					  } else {
					      status.innerHTML = "<div style = 'color:red;'>"+serviceRequest.responseText+"</div>";
					      hireBtn.disabled = false;
					      hireBtn.innerHTML = "Send again";
					      return false;
					  }
					}
					}
				serviceRequest.send("cService="+serviceValue+"&cName="+nameValue+"&cEmail="+emailValue+"&cPhone="+phoneValue+"&cDescription="+descriptionValue);	
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