$(document).ready(function () {
	/*
		Define the csrf token for ajax request to validate the
		header request is valid or not for all ajax request.

	*/
	$.ajaxSetup({
	    headers: {
	        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	    }
	});
	
	/**
 		* function for get select option for product.
 		*
 		* @param client_id
 		* 
 		*
		* @return html 
 		* 
 		*/
	function getOptionClient(client_id) {
		$('#product_id').html('');
		$.ajax({
	        type: "POST",
	        url: HOST + '/product/search',
	        data: { client_id: client_id }, 
	        success: function( data ) {
	        	let html = '';
	        	$.each( data, function( key, value ) {
	        		html += '<option value="'+ value.product_id +'">'+ value.product_description +'</option>';
				});
				$('#product_id').html(html);
	        }
    	});
	}
	//define the onchang event for client change and get products accordingly 
	$(document).on('change','#client_id' , function (e){
		getOptionClient($(this).val());// call function with current value
	});
	getOptionClient($('#client_id').val());// call function on load page with default client

//block for submit form
	$('#search_form').submit(function(e){
		e.preventDefault();
		var form = $(this);
    	var url = form.attr('action');

		$('#invoice_table tbody').html('');
		//Request ajax to retrive data according to form filled
		$.ajax({
	        type: "POST",//defined method of reuqest
	        url: url,
	        data: form.serialize(), //serialized the form fields value
	        success: function( data ) { //Block for check Ajax response
	        	
	        	var html = '';
	        	$.each( data, function( key, value ) { //loop for process the reponse data
	        		html += `
	        		<tr>
	        			<td>${value.invoice_num}</td>
	        			<td>${value.invoice_date}</td>
	        			<td>${value.product}</td>
	        			<td>${value.qty}</td>
	        			<td>${value.price}</td>
	        			<td>${value.total}</td>
	        		</tr>
	        		`;
				});
				if(html == ''){
					html = '<tr><td colspan="6" align="center">No data.</td></tr>';
				}
				$('#invoice_table tbody').html(html);//Replace the view with resulted data
	        }
    	});	
	});
});