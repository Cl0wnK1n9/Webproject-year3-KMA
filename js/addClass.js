function checkTeacher(){
	var level = document.getElementsByName("classLevel")[0].value;
	var url = "http://127.0.0.1/KMA/role/admin/getInfo.php?teacherLevel="+level;
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open( "GET", url, false); // false for synchronous request
    xmlHttp.send( null );
    var response = xmlHttp.responseText;
	var teacher_list = JSON.parse(response);
	console.log(response);
	var table="<td>TeacherID:</td><td><select name='teacherID'>";
	var i;
	for(i=0;i<teacher_list.length;i++){
		table+="<option value="+teacher_list[i]["ID"]+">"+teacher_list[i]["ID"]+"</option>";
	}
	table+="</select></td>"
	document.getElementsByName("teacherList")[0].innerHTML= table;
}

function classID(){
	var level = document.getElementsByName("classLevel")[0].value;
	var timeStamp = Math.floor(Date.now() / 1000);
	var classCode="";
	if(level=="beginer"){
		classCode+="BG";
	}
	if(level=="intermediate"){
		classCode+="IM";
	}
	if(level=="advanced"){
		classCode+="AD";
	}
	
	classCode+=timeStamp.toString();
	document.getElementsByName('classCode')[0].value=classCode;
}

function change(){
	var i;
	var checkpoint=document.getElementsByName('day[]');
	var result=checkpoint[0].checked;
	for (i=1;i<checkpoint.length;i++){
		result|=checkpoint[i].checked;
	}
	if (!result){
		document.getElementsByName("addClass")[0].disabled=true;
	}
	else{
		document.getElementsByName("addClass")[0].disabled=false;
	}
}