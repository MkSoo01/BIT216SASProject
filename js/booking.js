var dateFrom = document.getElementById("dateFrom");
var dateTo = document.getElementById("dateTo");
var form = document.getElementsByTagName("form");
var errorMsg = document.getElementsByClassName("errorMsg");
var invalidDateFrom = invalidDateTo = false;
form[1].style.display = "none";
function dateFromSelect(){
	if (dateFrom.value != ""){
		errorMsg[0].style.display = "none";
		dateFrom.style.border = "1px solid lightgrey";
		invalidDateFrom = false;
}
}

function dateToSelect(){
	if (dateTo.value != ""){
		errorMsg[1].style.display = "none";
		dateTo.style.border = "1px solid lightgrey";
		invalidDateTo = false;
}
}

//sign up function will be called when the sign up button clicked
function booking(){
	if (dateFrom.value == ""){
		errorMsg[0].style.display = "block";
		dateFrom.style.border = "1px solid red";
		invalidDateFrom = true;
	}else
		invalidUsername = false;
	if (dateTo.value == ""){
		errorMsg[1].style.display = "block";
		dateTo.style.border = "1px solid red";
		invalidDateTo = true;
	}else
		invalidDateTo = false;
	//alert("a"+ invalidUsername + "" + invalidPsw + "" + invalidCPsw + ""+ "" + invalidName + "" +
	// "" + invalidEmail + "" + invalidPhoneNo + "" + invalidAddress);
	invalid = [invalidDateFrom, invalidDateTo];
	for ( i = 0 ; i < invalid.length; i++){
		if (invalid[i]){
			document.getElementsByClassName("form-control")[i].focus();
			return false;
		}
	}
}
