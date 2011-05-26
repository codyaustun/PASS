/* JavaScript Document
	Made by Cody Coleman
   IAP 2011
   for 6.470
*/


	
	// note code Start
	
	/*
	 addNotice('<p>Welcome to Pass!!</p>');
	 
	 setInterval(function() {
	console.log('hi');
    addNotice('<p>Your New Job Awaits!!</p>');
  }, 3000);
  
  */
  
  	
  
	  $('#growl')
		  .find('.closeG')
		  .live('click', function() {
			$(this)
			  .closest('.notice')
			  .animate({
				border: 'none',
				height: 0,
				marginBottom: 0,
				marginTop: '-6px',
				opacity: 0,
				paddingBottom: 0,
				paddingTop: 0,
				queue: false
			  }, 1000, function() {
				$(this).remove();
			  });
		  });

	
	function addNotice(notice){
		
		if($('#growl .notice').length >= 5){
			$('#growl > .notice:first').fadeOut('slow', function(){
		
			$(this).remove()
			
			});	
		}
	
		var $notice = $('<div class="notice"></div>')
			.append($('<div class="content"></div>').html($(notice)))
			.append('<div class="closeG"></div>')
			.hide()
			
			if ($('#growl .notice').length > 0){
				$notice.insertAfter('#growl .notice:last')
					   .fadeIn(1000, function($notice){
						   var blah = this;
						   setTimeout(function(){$(blah).find('.closeG').click()}, 1000);
					   });
			}else{
				$notice.appendTo('#growl')
				       .fadeIn(1000,function(){
						   var blah = this;
						   setTimeout(function(){$(blah).find('.closeG').click()}, 1000);
					   });
			}
		
	}
	
	
	// note code End
	

