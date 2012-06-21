var debounce=function(func, threshold, execAsap) {
    var timeout;
    return function debounced () {
        var obj = this, args = arguments;
        function delayed () {
            if (!execAsap)
                func.apply(obj, args);
            timeout = null; 
        };
        if (timeout)
            clearTimeout(timeout);
        else if (execAsap)
            func.apply(obj, args);
        timeout = setTimeout(delayed, threshold || 100); 
    }; 
};

function insertResult(data)
{	
	// Retrieve all the key's and values's
	//$.each(data, function(key, value) {
	//	//Do something with them
	//	if (key == 'name')
	//		$('#resultsTable').append('<li>'+value+'</li>');
	//});
	$('#resultsTable').append('<li><a href="http://www.facebook.com/'+data.id+'">'+data.name+'</a> ('+data.category+')</li>');
}

$("#orgtext").keyup(debounce(function() {
    var searchbox = $(this).val();
    if(searchbox!='') {		
        $.ajax({
                type: "GET",
                url: "https://graph.facebook.com/search",
                data: {
                	q: searchbox,
                	metadata: '1',
                	type: 'page',
                	access_token: fb_auth_token // Outputted in <header> by PHP
                },
                dataType: 'jsonp',
                cache: true,
                success: function(json){
                	//console.log(json);
                	                	
                	//Clear results
					$('#resultsTable').empty();
					$('#resultsTable').append('<li>Search Results</li>');

					// Loop through each data item
                	$.each(json.data, function(index, dataObj) {
                		insertResult(dataObj);
                  	});
                }
        });
        
    } else {return false; }  
}
,350 /*determines the delay in ms*/
,false /*should it execute on first keyup event, 
       or delay the first event until 
       the value in ms specified above*/
));
