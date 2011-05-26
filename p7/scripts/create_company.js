// JavaScript Document



$(document).ready(function(){
	
	// datepicker UI
	
	$('.dateC').datepicker({
		  showOn: 'both',
		  numberOfMonths: 1,
		  buttonText: 'Choose a date',
  		  buttonImage: 'images/calendar.png',
		  dateFormat: "M dd, yy",
		  buttonImageOnly: true,
		  changeYear: true,
		  changeMonth: true,
		  showAnim: 'fadeIn'
	});
	
	// editForm adjustable length Start
	$('.editForm').live('blur', function(){adjustForm(this)});
	$('.editFormNA').live('blur', function(){update(this)});
	$('.editableAreaForm').live('blur', function(){adjustForm(this)});
	
	function update(which){
		var element = $(which);
		
		var val = element.val();
		var field = element.attr('name');
		var table = $('.entry').attr('data-t');
		var id =  $('.entry').attr('data-i');
		
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":id, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
	}
	
	function adjustForm(which, start){
			element = $(which)
			
			if(element.hasClass('editableAreaForm')  && element.val() != ""){
				var width = element.width()
				var $test = $('<div class="editableAreaForm editableForm"></div>')
								.css({'width':'600px'})
								.append(element.val())
								.appendTo('body');
						if(element.hasClass('title')){
							$test.addClass('title');	
						}
					var height = $test.height();
					if (element.hasClass('bold')){
								height += 3;
					}
					
					$test.remove();
					
					element.height(height);
				
			}
			else{
				if (element.val()){
				
					var $test = $('<span class="adjust"></span>').append(element.val()).appendTo('body');
						if(element.hasClass('title')){
							$test.addClass('title');	
						}
					var width = $test.width();
					if (element.hasClass('bold')){
								width += 3;
					}
					
					$test.remove();
					element.width(width);
				
				
				}
			}
			
			if(element.closest('.entry').attr('data-i') && !start){
				var val = element.val();
				var field = element.attr('name');
				var table = $('.entry').attr('data-t');
				var id =  $('.entry').attr('data-i');
				
				
				$.ajax({
					type:"post",
					url: "update.php",
					data: {"table":table, "field":field, "id":id, "value":val},
					success: function(){ addNotice('<p> Saved. </p>')}
				});
				
				
				
				addNotice('<p> table '+ table + '<br /> field '+ field +' <br /> value '+ val +'<br /> id '+ id+'</p>');
			}
			
		};
		
		$('.editForm, .editableAreaForm').each(function(){adjustForm(this, 'start')});
		
		
		var formHints = {
			
			init: function(){
				
				
				$('textarea.clear').each(function(){
					
					var initial = $(this).val()
					$(this).data('default', initial)
						   .addClass('inactiveInput')
						   .focus(function(){
							   
							   var $clear = $(this);
							   $clear.removeClass('inactiveInput');
							   
							   if ($clear.val() == $clear.data('default')) {
								   $clear.val('');
							   };
							   
						   })
						   .blur(function(){
							   if ($(this).val() == ''){
								   $(this).val($(this).data('default'));
							   };
						   });
				});
			
			}
			
			}
			
			formHints.init();
			
			
			
	
})
