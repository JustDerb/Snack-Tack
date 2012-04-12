$(document).ready(function() {
	//onloadChangeDate();
	
});

/*
function onloadChangeDate() {
	var form = document.forms["eventForm"];
	var fullDate = new Date();
	
	// Change all the default select options to today's date
	var month = form['month'];
	$(month[fullDate.getMonth()]).attr('selected', 'true');
	
	var date = form['date'];
	$(date[fullDate.getDate() - 1]).attr('selected', 'true');
	
	var year = form['year'];
	$(year[fullDate.getFullYear()]).attr('selected', 'true');
}
*/

function validateForm() {
	var form = document.forms["profileForm"];

	/*
	// Check basic info
	if (null == form['eventName'].value || "" == form['eventName'].value) {
		alert("The event does not have a name!");
		return false;
	}
	if (null == form['eventDescription'].value || "" == form['eventDescription'].value) {
		alert("The event does not have a description!");
		return false;
	}
	
	// Check food options
	var select = form['foodOptions'];
	if (!select[0].checked && !select[1].checked && !select[2].checked && !select[3].checked && !select[4].checked) {
		alert("You need to select one food option!");
		return false;
	}
	*/
	
	form.submit();
}
