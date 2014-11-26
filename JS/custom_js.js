/**
 * custom js to find out the winner
 */
function check_js(value)
{
	var htmlas = $('#interaction').text();
	var index = htmlas.indexOf('I think the animal is:');
	
    if(index !== -1)
    {        
    	$('#results').html(
    	        '<div class="alert alert-success alert-dismissable">'+
    	            '<button type="button" class="close" ' + 
    	                    'data-dismiss="alert" aria-hidden="true">' + 
    	                '&times;' + 
    	            '</button>' + 
    	            'You Won This Game. Please press reset on the top to start again' + 
    	         '</div>');

   	 event.preventDefault(); 
    } 
}