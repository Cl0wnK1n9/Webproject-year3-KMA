function check(){
	var username=document.getElementsByName("username")[0].value;
	var pass=document.getElementsByName("password")[0].value;
	if (username==="" || pass===""){
		alert("Please fill in the form");
		
	}
}