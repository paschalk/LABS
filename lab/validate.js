function validateForm(){
	var fname = document.forms["user_details"]["first_name"].value;
	var lname = document.forms["user_details"]["last_name"].value;
	var city = document.forms["user_details"]["user_city"].value;

	if(fname == null || lname ==  "" || city == ""){
		alert("all details are required were not supplied");
		return false;
	}
	return true;
}