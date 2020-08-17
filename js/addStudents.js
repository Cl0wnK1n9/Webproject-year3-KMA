function listClass(){
	var i;
	var level = document.getElementsByName("classLevel")[0].value;
	switch(level){
		case "beginer":
			level="BG";break;
		case "intermediate":
			level="IM";break;
		case "advanced":
			level="AD";break;
		default:
			level="BG";
	}
	var url = "http://127.0.0.1/KMA/role/admin/getInfo.php?classLevel="+level;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false); // false for synchronous request
    xmlHttp.send( null );
    var response = xmlHttp.responseText;
	var class_list = JSON.parse(response);
	table=`<select name='class'>`;
	for (i=0;i<class_list.length;i++){
		table+='<option value="'+class_list[i]['ID']+'">'+class_list[i]['ID']+"</option>";
	}
	table+=`</select>`;
	document.getElementsByName("classID")[0].innerHTML=table;
}

function listStudent(){
	var i;
	var level = document.getElementsByName("classLevel")[0].value;
	var url = "http://127.0.0.1/KMA/role/admin/getInfo.php?studentLevel="+level;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false); // false for synchronous request
    xmlHttp.send( null );
    var response = xmlHttp.responseText;
	var student_list = JSON.parse(response);
	table="";
	for(i=0;i<student_list.length;i++){
		var url = "http://127.0.0.1/KMA/role/admin/getInfo.php?studentID="+student_list[i]["ID"];
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open( "GET", url, false); // false for synchronous request
		xmlHttp.send( null );
		var response = xmlHttp.responseText;
		var studentID = JSON.parse(response);
		table+=student_list[i]["ID"]+"-"+studentID[0]["username"]+"<button id='"+student_list[i]["ID"]+"' onclick="+"pushStudent('"+student_list[i]["ID"]+"');document.getElementById('"+student_list[i]["ID"]+"').disabled=true>+</button><br />";
	}
	document.getElementsByName("studentID")[0].innerHTML=table;
}

function pushStudent(studentID){
	student.push(studentID);
	console.log(student);
}
function addStudent(){
	var classCode = document.getElementsByName("class")[0].value;
	var i;
	for(i=0;i<student.length;i++){
		var url = "http://127.0.0.1/KMA/role/admin/updateInfo.php?class="+classCode+"&student="+student[i];
		var xmlHttp = new XMLHttpRequest();
		xmlHttp.open( "GET", url, false); // false for synchronous request
		xmlHttp.send( null );
		var response = xmlHttp.responseText;
		console.log(response);
		if(response=="ERROR"){
			alert("Failed! Please try again");
			location.reload(); 
		}
		else{
			alert("Add successed");
			location.reload(); 
		}
	}
	if(student.length ==0){
		alert("Failed! Please try again");
		location.reload(); 
	}
}
student=[];
