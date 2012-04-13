$(document).ready(function() {
	
});

function validateForm() {
	var form = document.forms["findForm"];

	// Check basic info
	if (null == form['terms'].value || "" == form['terms'].value) {
		alert("You need to enter a search term!");
		return false;
	}
		
	form.submit();
}
