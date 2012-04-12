$(document).ready(function() {
	onloadChangeDate();
	
});

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

function validateForm() {
	var form = document.forms["eventForm"];

	// Check basic info
	if (null == form['eventName'].value || "" == form['eventName'].value) {
		alert("You need to give the event a name!");
		return false;
	}
	if (null == form['eventDescription'].value || "" == form['eventDescription'].value) {
		alert("You need to give the event a description!");
		return false;
	}
	
	// Check food options
	var foodOptions = form["foodOptions"];
	var flag = false;
	for (var i = 0; i < foodOptions.length; i++) {
		if (foodOptions[i].checked)
			flag = true;
	}
	if (!flag) {
		alert("You need to select a food option!");
		return false;
	}
	
	form.submit();
}
