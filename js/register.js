function isInteger(value) {
  return /^\d+$/.test(value);
}
function checkDay(){
	var year= document.getElementsByName("year")[0].value;
	var month= document.getElementsByName("month")[0].value;
	var day= document.getElementsByName("day")[0].value;
	if(month =='2'){
		if(year%4==0 && day>29){
			alert("Invalid day");
			document.getElementsByName("day")[0].selectedIndex=0;
		}
		if(year%4!=0 && day >28){
			alert("Invalid day");
			document.getElementsByName("day")[0].selectedIndex=0;
		}
	}
	if(month==4 || month==6 || month==9 || month==11){
		if (day>30){
		alert("Invalid day");
		document.getElementsByName("day")[0].selectedIndex=0;
		}
	}
}

function checkPhone(){
	var phonenum= document.getElementsByName("phonenumber")[0].value;
	if(phonenum.length !=0){
		if (phonenum.length<10 || phonenum.length>11 ){
			alert("Invalid phonenumber");
			document.getElementsByName("phonenumber")[0].value=""
		}
		if (!isInteger(phonenum)){
			alert("Invalid phonenumber");
			document.getElementsByName("phonenumber")[0].value=""
		}
	}
}

function checkRole(){
	var role = document.getElementsByName("role")[0].value;
	var table="";
	if (role=="parent"){
		table=`
			<div class="form-group col-md-12">
							      <label for="inputEmail4">Child ID</label>
							      <input type="text" class="form-control input" name="extendValue" required >
						    </div>
		`;
		document.getElementsByName("extend")[0].innerHTML= table;
	}
	else if(role=="student" || role =="teacher"){
		table=`
			<div class="form-group col-md-12 role">
							    <label for="inputAddress2" class="col-lg-1">Level: </label>
						    	<div class="form-group col-lg-6 dob">
								    <select name="extendValue" onchange="checkRole()">
											<option value="beginer">Beginer</option>
											<option value="intermediate">intermediate</option>
											<option value="advanced">Advanced</option>
									</select>
							    </div>
						    </div>
		`;
	}
	else {
		table = "";
	}
	document.getElementsByName("extend")[0].innerHTML= table;
}

function fillCheck(){
	var year= document.getElementsByName("year")[0].value;
	var month= document.getElementsByName("month")[0].value;
	var day= document.getElementsByName("day")[0].value;
	if(year=="" || month=="" || day==""){
		alert("Please fill in the form");
	}
}

function checkPass(){
	var pass1= document.getElementsByName("password")[0].value;
	var pass2= document.getElementsByName("repassword")[0].value;
	if (pass1!=pass2){
		alert("Password not match");
		document.getElementsByName("password")[0].value="";
		document.getElementsByName("repassword")[0].value="";
	}
}

function checkCard(){
	var card= document.getElementsByName("identityCard")[0].value;
	if (card.length!=12 && card.length!=0){
		alert("Wrong identity card number");
		document.getElementsByName("identityCard")[0].value="";		
	}
}