// JavaScript Document


$(document).ready(function(){
	
	$('#selCompany').dialog({
		autoOpen: false,
		height: 200,
		width: 300,
		modal: true,
		resizable: false,
		buttons: {
			Cancel: function(){
				// close dialog
				$(this).dialog('close');
			},
			Select: function(){
					var val = $(this).find('#appCompany').val();
					var jid =  $('#top').attr('data-i');
					var field = "employer_id";
					var table = "job_postings";
					
					
					
					$.ajax({
						type:"post",
						url: "update.php",
						data: {"table":table, "field":field, "id":jid, "value":val},
						success: function(){ addNotice('<p> Saved. </p>')
						}
					});
					
					$('#appCompany').find('option').each(function(){
						if($(this).val() == val){
							$(".company label span").text($(this).text());		
						}
						
					});
					
					$(this).dialog('close');
			}
			
			
		}
			
	});
	
	$('.containSelect input').hide();
	
	$('.indPic').click(function(){
		$(this).addClass('indPicHover');
		$('#individual').attr('checked', 'true');
		$('.compPic').removeClass('compPicHover');
		var jid =  $('#top').attr('data-i');
		var field = "employer_type"
		var table = "job_postings"
		var val = "individual"
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":jid, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		
		var uid =  $('#top').attr('data-u');
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":'employer_id', "id":jid, "value":uid},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		
		e.preventDefault();
		// console.log($('#individual').attr('checked'))
	})
	
	$('.compPic').click(function(){
		$(this).addClass('compPicHover');
		$('#company').attr('checked', 'true');
		$('.indPic').removeClass('indPicHover');
		
		$('#selCompany').dialog('open');
		
		var jid =  $('#top').attr('data-i');
		var field = "employer_type"
		var table = "job_postings"
		var val = "company"
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":jid, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		// console.log($('#individual').attr('checked'))
	})
	
	$('.individual label').click(function(){
		$('.indPic').addClass('indPicHover');
		$('.compPic').removeClass('compPicHover');
		
		
		
		var jid =  $('#top').attr('data-i');
		var field = "employer_type"
		var table = "job_postings"
		var val = "individual"
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":jid, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});	
		
		var uid =  $('#top').attr('data-u');
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":'employer_id', "id":jid, "value":uid},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		// console.log($('#individual').attr('checked'))
	})
	
	$('.company label').click(function(){
		$('.indPic').removeClass('indPicHover');
		$('.compPic').addClass('compPicHover');
		
		$('#selCompany').dialog('open');	
		
		
		var jid =  $('#top').attr('data-i');
		var field = "employer_type"
		var table = "job_postings"
		var val = "company"
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":jid, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		// console.log($('#individual').attr('checked'))	
	})
	
	
})


$(document).ready(function(){
	
	
	// Publish a job 
	$('#jobSubmit').click(function(){
		var jid =  $('#top').attr('data-i');
		var table = "job_postings"
		var field="visible"
		var val = "true"
		
		
		$.ajax({
			type:"post",
			url: "update.php",
			data: {"table":table, "field":field, "id":jid, "value":val},
			success: function(){ addNotice('<p> Saved. </p>')}
		});
		
	});
	
	
	// datepicker UI
	
	$('.date').datepicker({
		  showOn: 'both',
		  numberOfMonths: 1,
		  buttonText: 'Choose a date',
  		  buttonImage: 'images/calendar.png',
		  minDate: '0d',
		  dateFormat: "M dd, yy",
		  buttonImageOnly: true,
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
		var table = element.closest('.entry').attr('data-t');
		var id =  element.closest('.entry').attr('data-i');
		
		
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
				var table = element.closest('.entry').attr('data-t');
				var id =  element.closest('.entry').attr('data-i');
				
				
				$.ajax({
					type:"post",
					url: "update.php",
					data: {"table":table, "field":field, "id":id, "value":val},
					success: function(){ addNotice('<p> Saved. </p>')}
				});
				
				
				
				// addNotice('<p> table '+ table + '<br /> field '+ field +' <br /> value '+ val +'<br /> id '+ id+'</p>');
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
							   }else{
									$(this).removeClass('clear')   
							   }
						   });
				});
			
			}
			
			}
			
			formHints.init();
			
			
			// In case of Samples Start
			$('.editableForm').live('focus', function(){  
				
					// Click action
					var $editable = $(this);
					var $parent = $editable.parent().parent().parent().parent().parent()
					
					
					// code in case you click a sample
					if($editable.parent().hasClass('sample')){
						var $parent = $editable.parent().parent()
						$parent.find('.emptySideRow').remove()
						var $sample = $parent.find('.sample');
						var $clone = $sample.clone();
						
						$sample.removeClass('sample');
						$parent.find('.entry:last').after($clone);
						
						newElement($sample);
						
						formHints.init();
					}
					
					if ($editable.parent().parent().parent().hasClass('sample')
					|| $editable.parent().parent().parent().parent().hasClass('sample')){
						
						
						var $parent = $editable.parent().parent().parent().parent().parent()
						var $sample = $parent.find('.sample');
						$parent.find('.emptySideRow').remove()
						var $clone = $sample.clone().hide();
						
						$sample.removeClass('sample');
							
						$parent.find('.entry:last').after($clone);
						newElement($sample);
						
						
						if($parent.find('.control > div:first').length != 0){
							$parent.find('.control > div:first').click();
						}else{
							$parent.parent().find('.control > div:first').click();
						}
					};
					
					
					
			})
			
		// In case of Samples End
		
		
		function newElement(element, jid){
				var $item = element	
				if (!jid){
					var jid = $('#top').attr('data-i');
				}
				var dict = {}
				var len = $item.find('.editableForm').length;
				var fields = new Array(len)
				var vals = new Array(len)
				
				
				$item.find('.editableForm').each(function(ind){
					fields[ind] = $(this).attr('name');
					vals[ind] = $(this).val();
					
				});
				
				var table = $item.attr('data-t')
				
				dict = {'fields[]': fields, 'vals[]': vals, 'jid': jid, 'table': table};
				$.ajax({
					type: "post",
					url: "newJ.php",
					data: dict,
					success: function(data){
						$item.attr('data-i', data);
					}
				})
			}
		
		
		// remove education, experience, or activity Start
			
			$('.close').live('click', function(){
				
				var $parent = $(this).parent().parent()
				var $super = $parent.parent()
				if ($parent.hasClass('sample')){
					$parent.parent().parent().find('.control > div:first').click();
				}
				else{
					$parent
						.fadeOut('slow', function(){
							
							deleteElement($(this));

							
						});
				}
				
				
			});
			
			function deleteElement($item){
				var id = $item.attr('data-i')
				var table = $item.attr('data-t')
				
				$.ajax({
					type: "post",
					url: "remove.php",
					data: {"table": table, "id": id},
					success: function(data){
						$item.remove;	
					}
				
				});
				
			}
			
			// remove education, experience, or activity End
			
			$('.sectionTitle').toggle(function(){
				
				$(this)
					.after('<div class="hideMes">Click again to show hidden material.</div>')
					.parent()
					.find('.sideRow, .manage, #contactForm')
					.toggle()
					
			},
			function(){
				
				$(this).parent()
					.find('.sideRow, .manage')
					.toggle()
					.parent()
					.find('.hideMes')
					.remove()
					
			});
			
				$("#fix_hours").click(function() {
   			 $("#selectopt1").show("slow");
    		 
   			 	 
    	});
		$("#fix_hours2").click(function() {
   			 $("#selectopt1").hide("slow");
  			 $("#cal").hide("slow");
			 $("#selectopt2").hide("slow");	
 			 $("#advtime").attr('checked', false);  
			 $("#simptime").attr('checked', false);  
			
   			 	 
  		  });
		  	$("#simptime").click(function() {
   			 $("#cal").show("slow");
			 $("#advtime").attr('checked', false);  
    		 $("#selectopt2").hide("slow");	
				});
				
		$("#advtime").click(function() {
  			 $("#cal").hide("slow");
			 $("#simptime").attr('checked', false);  
			 $("#selectopt2").show("slow");	 
  		  });
		$("#app").click(function(){
			$(".select1").val($(".select1 option:selected").val());
			$(".select2").val($(".select2 option:selected").val());
			$(".select3").val($(".select3 option:selected").val());
			$(".select4").val($(".select4 option:selected").val());
		});
});