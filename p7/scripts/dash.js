/* JavaScript Document
	Made by Cody Coleman
   IAP 2011
   for 6.470
*/

// Code for editable START


$(document).ready(function(){
	
	// search
	/*
	$('#searchSubmit').click(function(){
		var keyword = $('#searchBox').val();
		
		$.ajax({
			type: "post",
			url: 'search.php',
			data: {'key': keyword},
			success: function(data){
				
				console.log(data);	
			}
		})
	});
	
	
	*/
	
	$('.delRes').click(function(e){
		var rid = $(this).attr('data-i');
		
		$.ajax({
			type: "post",
			url: 'delResume.php',
			data: {'rid': rid},
		})
		
		$(this).closest('li').slideUp();
		e.preventDefault();
	});
	
	$('.delUp').click(function(e){
		var id = $(this).attr('data-i');
		
		$.ajax({
			type: "post",
			url: 'remove.php',
			data: {'id': id, 'table': 'cover_letter'},
		})
		
		$(this).closest('li').slideUp();
		e.preventDefault();
	});
	
	$('.delJob').click(function(e){
		var id = $(this).attr('data-i');
		
		$.ajax({
			type: "post",
			url: 'delJob.php',
			data: {'jid': id},
		})
		
		$(this).closest('li').slideUp();
		e.preventDefault();
	});
	
	$('.delComp').click(function(e){
		var id = $(this).attr('data-i');
		
		$.ajax({
			type: "post",
			url: 'remove.php',
			data: {'id': id, 'table': 'company'},
		})
		
		$(this).closest('li').slideUp();
		e.preventDefault();
	});
	
	
	$("#upCovBut").click(function(){
		$('#coverUp').dialog('open');
	});
	
	
	$('#coverUp').dialog({
		autoOpen: false,
		height: 100,
		width: 500,
		modal: true,
		resizable: false,
		/*buttons: {
			Cancel: function(){
				// close dialog
				$(this).dialog('close');
			},
			Upload: function(){
					addNotice("<p>"+$('form:last').attr('id')+"</p>");
					$("form:last").submit()
			}
			
			
		}
		*/		
	});
	
	// Hide lower menus when brower loads
	$('.dashNav > li ul')
			.click(function(e){
				e.stopPropagation();
			})
			.hide();
	
	$('.dashNav > li, .nav > li > ul > li').toggle(function(){
				$(this)
					.addClass('current')
					.parent()
					.find('> li:not(.current)')
					.slideUp()
					.end()
					.end()
					.find('ul:first').slideDown();
				},
				function(){
				$(this)
					
					.parent()
					.find('> li:not(.current)')
					.slideDown()
					.end()
					.end()
					.removeClass('current').find('ul:first').slideUp();
				
				
					
					
			
			
	});
	

	
})
