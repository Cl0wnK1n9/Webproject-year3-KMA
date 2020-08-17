function send_request(url){
	var xmlHttp = new XMLHttpRequest();
	xmlHttp.open("GET",url,false);
	xmlHttp.send( null );
	var response = xmlHttp.responseText;
	return JSON.parse(response);
}