// JavaScript Document


$(document).ready(function(){
	
	$('#coverUp').dialog({
		autoOpen: false,
		height: 250,
		width: 300,
		modal: true,
		resizable: false,
		buttons:{
			Cancel: function(){
				// c4lose dialog
				$(this).dialog('close');
			},
			Apply: function(){
				
					var rid = $(this).find('#appResume').val();
					var cid = $(this).find('#appCover').val();
					
					$.ajax({
					type: 'post',
					url: 'sub.php',
					data: {'rid': rid, 'cid': cid},
					success: function(data){
						if(data == "dashboard.php"){
							//addNotice("<p>" + data + "</p>");
							window.location.href=data;
						}
						else{
							addNotice("<p>" + data + "</p>");
							
						}
						
					}
					
					});	
					
					$(this).dialog('close');
			}
		}
		
	})
	
	
	
	$('#apply').click(function(){
		$('#coverUp').dialog('open');
	})
	
	
});