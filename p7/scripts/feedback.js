/* JavaScript Document
	Made by Cody Coleman
   IAP 2011
   for 6.470
*/

$(document).ready(function(){
	
		
		
		// open feedback on deman
		$("#feedback").click(function(){
			$('#feedBox').dialog('open');
		});
		
		
	
		$('#feedBox').dialog({
			autoOpen: false, // feedBox won't open automatically on page load
			height: 400,
			width: 400,
			modal: true,
			resizable: false, // feedBox is resizeable
			buttons: {
				Cancel: function(){
					// close dialog
					$(this).dialog('close');
				},
				Submit: function(){
					var message = $(this).find('#fbMess').text();
					var title = $(this).find('#fbTitle').text();
					
					// ajax function to send feedback without page reload
					$.ajax({
						type: "post",
						url: "feedback.php", // script to process feedback
						data: {'message': message, 'title': title},
						success: function(){
							addNotice('<p>Your message has been sent!</p>');
							$('#feedBox').dialog('close');
						}
						
					});
						
				}
				
				
			}
				
		});
		
		// Account code Start
		
		
		$("#moreAcc").hide();
	
		
		$("#accHead, #accImage").toggle(function(){
			$("#moreAcc").slideDown('fast','swing');
			$("#accImage").css('background-position', '0px -16px')
		},
		function(){
			$("#moreAcc").slideUp('fast','swing');
			$("#accImage").css('background-position', '-64px -16px')
		});
		

		// Account code End
	
		
})