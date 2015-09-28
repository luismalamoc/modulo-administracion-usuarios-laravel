$(document).on("ready", function() 
{
	if ($('.btn-delete').length) 
	{
    	$('.btn-delete').click(function() 
        {
            var id = $(this).attr('id');        
            var form = $('#formDeleteUser');
            var action = form.attr('action').replace('USER_ID', id);
            var row =  $(this).parents('tr');
            
            row.fadeOut(1000);
            
            $.post(action, form.serialize(), function(result) 
            {
            	if (result.success === true) 
               	{  
                	setTimeout (function () 
                  	{
                    	row.delay(1000).remove();
                     	$("#listUsers").before('<div class="alert alert-dismissable alert-success">'+
                        	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        	'<strong>'+result.msg+'</strong>.</div>');                  
                  		}, 1000);                
               	} 
               	else 
               	{
                  	setTimeout (function () 
                  	{
                     	$("#listUsers").before('<div class="alert alert-dismissable alert-danger">'+
                        	'<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                        	'<strong>'+result.msg+'</strong>.</div>');                  
                     	}, 1000);            	
      			   	row.show();
               	}
            }, 'json');
        });
    }
});