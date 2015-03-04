// Variable to hold request
var request;

// Bind to the submit event of our form
$(document).ready(function () {
	console.log("ready");
	$(".timeago").timeago();
	var result = false;
$(".status").click(function(event){
	$(this).html("Accepted");
		
    // Abort any pending request
    if (request) {
        request.abort();
    }
    var $requestID = $(this).attr("value");
	console.log($requestID);
    // Let's disable the inputs for the duration of the Ajax request.
    this.disabled = true;

    // Fire off the request to /form.php
    request = $.ajax({
        url: "ajax.php",
        type: "post",
        data:{
				requestID : $requestID     
        } 
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
        
        console.log("h"+response);
        
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $(".status").prop("disabled", false);
    });

    // Prevent default posting of form
    event.preventDefault();
    
});

$(".join").click(function(event){
    // Abort any pending request
    if (request) {
        request.abort();
    }
    var $postID = $(this).attr("value");
	console.log($postID);
    // Let's disable the inputs for the duration of the Ajax request.
    $(this).disabled = true;

    // Fire off the request to /ajax.php
    request = $.ajax({
    	  datatype : "html",
        url: "ajax.php",
        type: "post",
        data:{
				postID : $postID  
        } 
    });

    // Callback handler that will be called on success
    request.done(function (response, textStatus, jqXHR){
        // Log a message to the console
       $(".join").remove();
       $("#afterResponse").before(response);
        console.log("h"+response);
        
    });

    // Callback handler that will be called on failure
    request.fail(function (jqXHR, textStatus, errorThrown){
        // Log the error to the console
        console.error(
            "The following error occurred: "+
            textStatus, errorThrown
        );
    });

    // Callback handler that will be called regardless
    // if the request failed or succeeded
    request.always(function () {
        // Reenable the inputs
        $(".status").prop("disabled", false);
    });

    // Prevent default posting of form
    event.preventDefault();
    
});
});