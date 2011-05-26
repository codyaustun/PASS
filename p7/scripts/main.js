/* JavaScript Document
	Made by Cody Coleman
   IAP 2011
   for 6.470
*/

// Code for editable START


$(document).ready(function(){
	
		// datepicker UI
	
	$('.dateC').datepicker({
		  minDate: new Date(2007, 1 - 1, 1) ,
		  showOn: 'both',
		  numberOfMonths: 1,
		  dateFormat: "M yy",
		  showAnim: 'fadeIn',
		 
		  onClose: function(dateText, inst) {
			  	  console.log('hi');
				  console.log(dataText);
				  $(this).val(dataText);
				  adjustForm(this);
			  
		  }

	});
	
	
	// alert("hi");
	$(".open").slideUp();
	
	$("#delResume").hover(function(){
		$(this).text("(Delete Resume)");
	},
	function(){
		$(this).text("(x)");
	});
	
	$('#delResume').click(function(e){
		
		var rid = $('#title').attr('data-i');
		
		$.ajax({
			type: "post",
			url: "delResume.php",
			data: {"rid": rid}
		});
		
	});
		
		
		$('.editable, .editable-area') 
			/*
			// Adds hover highlighting
			.live('mouseover mouseout',function(event){
					// Hover action
					if(event.type == 'mouseover'){
							$(this).addClass('ed-hover');
							
					}
					else{
							$(this).removeClass('ed-hover');
					}
					
			})
			*/
			.live('click', function(){  
				
					// Click action
					var $editable = $(this);
					
					
					if ($editable.parent().parent().parent().parent().hasClass('mywrap')
					|| $editable.parent().parent().parent().parent().parent().hasClass('mywrap')){
						
						return;	
					}
					
					// code in case you click a sample
					
					if ($editable.parent().parent().parent().hasClass('sample')
					|| $editable.parent().parent().parent().parent().hasClass('sample')){
						
						
						var $parent = $editable.parent().parent().parent().parent().parent()
						var $sample = $parent.find('.sample');
						var $clone = $sample.clone().hide();
						
						$sample.removeClass('sample');
							
						$parent.find('.entry:last').after($clone);
						
						
						if($parent.find('.control > div:first').length != 0){
							$parent.find('.control > div:first').click();
						}else{
							$parent.parent().find('.control > div:first').click();
						}
					};
					
					
					
					
					if ($editable.hasClass('active-inline')){
						return;
					};
					
					var contents = $.trim($editable.html());
					var widthEd = $editable.width();
					var heightEd = $editable.height();
					
					$editable
						.addClass('active-inline')
						.empty();
						
					var editElement = $editable.hasClass('editable') ? 
							'<input type="text" />' : '<textarea></textarea>';
					
					$(editElement)
						.css({height: heightEd, width:widthEd, border:'none', padding: '0px', margin: '0px'})
						.val(contents)
						.appendTo($editable)
						.focus()
						.blur(function(){
							$editable.trigger('blur');
						});
			})
			.live('blur',function(){
					// Blur action
					
					var $editable = $(this);
					
					var contents = $editable.find(':first-child:input').val();
					
					$editable
						.contents()
						.replaceWith(contents)
						.end()
						.removeClass('active-inline');
			});

			 // Code for editable END			
			
	
			// Hide and show ed-sample Start
			
			$('#ed-show, #ex-show, #act-show').toggle(function(){
				$(this).parent().parent().find('.sample').slideUp('fast');
				$(this).text('Show Example');
			},
			function(){
				$(this).parent().parent().find('.sample').slideDown('fast');
				$(this).text('Hide Example')
			});
			
			// Hide and show ed-sample End 
			
			// New ed Start
			$("#ed-new, #ex-new, #act-new").click(function(){
				
					var $parent = $(this).parent().parent();
					var $new = $parent.find('.sample')
									  .clone()
									  .removeClass('sample')
									  .attr('style', 'display: block');
									  
					$parent.find('.emptySideRow').remove()
					$parent.find('.sample').before($new);
						
					newElement($new);
			});
			
			// New ed End
			
			
			function newElement(element, rid){
				var $item = element	
				if (!rid){
					var rid = $('#title').attr('data-i');
				}
				var dict = {}
				var len = $item.find('.editableForm').length;
				var fields = new Array(len)
				var vals = new Array(len)
				var seq = $item.closest('.sideRow').find('.entry:not(".sample")').length
				
				$item.find('.editableForm').each(function(ind){
					fields[ind] = $(this).attr('name');
					vals[ind] = $(this).val();
					
				});
				
				var table = $item.attr('data-t')
				
				dict = {'fields[]': fields, 'vals[]': vals, 'rid': rid, 'table': table, 'seq': seq};
				$.ajax({
					type: "post",
					url: "new.php",
					data: dict,
					success: function(data){
						$item.attr('data-i', data);
					}
				})
			}
			
			
			
			
			
			// toggle sideRow
			$('.sectionTitle').toggle(function(){
				
				$(this).parent()
					.after('<div class="hideMes">Click again to show hidden material.</div>')
					.parent()
					.find('.sideRow, .manage, #contactForm')
					.toggle()
					
			},
			function(){
				
				$(this).parent()
					.parent()
					.find('.sideRow, .manage')
					.toggle()
					.parent()
					.find('.hideMes')
					.remove()
					
			});
	
			
			
			$('#education .open').sortable({
				connectWith: '.connectEd',
				revert: true,
				opacity: .75,
				items: '.storage, .emptySideRow',
				remove: function(event, ui) {orphan(this) },
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectEd')}
			});
			
			$('#education .sideRow').sortable({
				connectWith: '.connectEd',
				revert: true,
				opacity: .75,
				items: '.ed:not(".sample"), .emptySideRow',
				remove: function(event, ui) {orphan(this) },
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectEd')}
			});
			
			$('#experience .open').sortable({
				connectWith: '.connectEx',
				revert: true,
				items: '.storage',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectEx')}
			});
			
			$('#experience .sideRow').sortable({
				connectWith: '.connectEx',
				revert: true,
				items: '.ex:not(".sample"), .emptySideRow',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectEx')}
			});
			
			$('#activities .open').sortable({
				connectWith: '.connectAct',
				revert: true,
				opacity: .75,
				items: '.storage',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectAct')}
			});
			
			$('#activities .sideRow').sortable({
				connectWith: '.connectAct',
				revert: true,
				opacity: .75,
				items: '.act:not(".sample"), .emptySideRow',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectAct')}
			});
			
			$('#skills .open').sortable({
				connectWith: '.connectSk',
				revert: true,
				opacity: .75,
				items: '.storage',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectSk')}
			});
			
			$('#skills .sideRow').sortable({
				connectWith: '.connectSk',
				revert: true,
				opacity: .75,
				items: '.sk:not(".sample"), .emptySideRow',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectSk')}
			});
			
			$('#interests .open').sortable({
				connectWith: '.connectInt',
				revert: true,
				opacity: .75,
				items: '.storage',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectInt')}
			});
			
			$('#interests .sideRow').sortable({
				connectWith: '.connectInt',
				revert: true,
				opacity: .75,
				items: '.entry:not(".sample"), .emptySideRow',
				receive: function(event, ui) { adopt(ui.item, this) },
				stop: function(event,ui) {mix('.connectInt')}
			});
			
			// drag and drop with sideRow and storage End
			
			
		
			
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
							
							orphan($super);
							
						});
				}
				
				
			});
			
			// remove education, experience, or activity End
			
			// cut education, experience, or activiies Start
			
			$('.cut').live('click', function(){
				
				var $parent = $(this).parent().parent()
				
				
				
				if ($parent.hasClass('sample')){
					$parent.parent().parent().find('.control > div:first').click();
				}
				else{
					$parent
						.fadeOut('slow', function(){
							cut($(this));
							
						});
				}
				
				
			});
			
			
			// Storage JS START 
			$('.storeButton').click(function(e){
				
				
				
				var $store = $(this).parent().find('.open');
				
				$store.slideToggle();		
				
				e.stopPropagation();
				
			});
			
			$('.open').each(function(){
				var len = $(this).find('.storage').length
				if(len > 5){
					$(this).addClass('openScroll');	
				}
			});
			
			// Storage JS END 
			
			
			
			/*
			$('.editForm').live('focus', function(){editHigh(this)});
			
			
			
			function editHigh(it){
				$(it).addClass('editInput');	
			}
			
			*/
			
			// editForm adjustable length Start
			$('.editForm').live('blur', function(){adjustForm(this)});
			$('.editableAreaForm').live('blur', function(){adjustForm(this)});
			
			
			
			$('.editForm').each(function(){adjustForm(this, 'start')});
			// editForm adjustable length End
			
			
			
			
			convertEdit.init();
			convertEdit.initA();
			
			
		// In case of Samples Start
			$('.editableForm').live('focus', function(){  
				
					// Click action
					var $editable = $(this);
					var $parent = $editable.parent().parent().parent().parent().parent()
					
					
					// connectEd or education
					// connectEx or experience
					// connectAct or activities
					
					
					if ($editable.parent().parent().parent().parent().hasClass('mywrap')
					|| $editable.parent().parent().parent().parent().parent().hasClass('mywrap')){
						
						$editable.blur()
					}
					
					// code in case you click a sample
					if($editable.parent().hasClass('sample')){
						var $parent = $editable.parent().parent()
						$parent.find('.emptySideRow').remove()
						var $sample = $parent.find('.sample');
						var $clone = $sample.clone();
						
						$sample.removeClass('sample');
						$parent.find('.entry:last').after($clone);
						
						newElement($sample);
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
		
	
})


// Functions
// Converting to forms Start
// Massive Failure
var convertEdit ={
	init: function(){
		$('.entry').find('.editable').each(function(){
			var $convert = $(this)
			var $field = $convert.attr('data-field');
			var $type = $convert.attr('data-type');
			var widthEd = $convert.width() - 10;
			var heightEd = $convert.height();
			var info = $.trim($convert.text());
			
			
				var $form = $('<input></input>')
			
			
			$form
				.addClass('editForm')
				.addClass('editableForm')
				.css({height: heightEd, width:widthEd})
				.val(info)
				.attr('name', $field)
				//.appendTo('body')
				
			if ($type == 'bold'){
				$form.addClass('bold')
			}
			
			if($type == 'italic'){
				$form.addClass('italic')
			}
			
			if($type == 'dateC'){
				$form.addClass('dateC');
				$('.dateC').datepicker({
					  numberOfMonths: 1,
					  minDate: '-13y',
					  dateFormat: "M yy",
					  showAnim: 'fadeIn',
					  changeYear: true,
					  changeMonth: true,
					  
					   onClose: function(dateText, inst) {
						  $(this).val(dateText);
						  adjustForm(this);
			  
		 				}
				});	
			}
			
			adjustForm($form)
				
			$convert.replaceWith($form);
			

		})
		
	},
	
	initA: function(){
		$('.entry').find('.editable-area').each(function(){
			var $convert = $(this)
			var $field = $convert.attr('data-field');
			var $type = $convert.attr('data-type');
			var heightEd = $convert.height();
			var info = $.trim($convert.html());
			
			var $form = $('<textarea></textarea>');
			
			$form
				.addClass('editableAreaForm')
				.addClass('editableForm')
				.css({height: heightEd})
				.html(info)
				.attr('name', $field)
				
			if ($type == 'bold'){
				$form.addClass('bold')
			}
			
			if($type == 'italic'){
				$form.addClass('italic')
			}
			
			adjustForm($form);
			$convert.replaceWith($form);
				
		})
			
	}
}

// Converting to forms End


function adjustForm(which, start){
	element = $(which)
	
	if(element.hasClass('editableAreaForm')){
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
				if(element.hasClass('bold')){
					$test.addClass('bold');	
				}
			
			var width = $test.width() + 2;
			
			
			
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
			success: function(){ addNotice('<p> Success! </p>')}
		});
		
		
		
		// addNotice('<p> table '+ table + '<br /> field '+ field +' <br /> value '+ val +'<br /> id '+ id+'</p>');
	}
	
};




function cut($item){
	
	rid = 2; // This will cause an error in real deployment
			var id = $item.attr('data-i')
			var table = $item.attr('data-t')
			
			$.ajax({
					type:"post",
					url: "updateR.php",
					data: {"table":table, "rid":rid, "id":id},
					success: function(){ addNotice('<p> Success! </p>');
				
	
					var $new = $('<div class="storage"></div>')
										.append('<div class="mywrap"></div>')
					var $parent = $item.parent()
					var $box = $item.parent().parent().find('.open')
					
					if ($box.find('.storage').length >= 5){
						$box.addClass('openScroll')
					}
					else{
						$box.removeClass('openScroll')
					}
					
					$new.find('.mywrap').append($item.clone().attr('style', 'display: block;'))
					$new.appendTo($box);
					$item.remove();
					
					orphan($parent);
		 }
	
	});
	
}

// cut education, experience, or activiies End


// adopt after sort START
	
	function adopt($item, which){
		
		$(which).find('.emptySideRow').remove()
		
		if ($(which).hasClass('sideRow')){
			$item.replaceWith($item.find('.entry'))
		}
		else{
			$parent = $item.closest('.open')
			len = $parent.find('.storage').length;
			var $new = $('<div class="storage"></div>')
							.append('<div class="mywrap"></div>')
			$new.find('.mywrap').append($item.clone())
			$new.appendTo('body');
			$item.replaceWith($new);
			if(len >= 5){
				$parent.addClass('openScroll');	
			}
			
			
		}
		
	};
	
	// adopt after sort End
	
	// orphan after sort Start
	function orphan(which){
		if(!$(which).hasClass('connectInt') && !$(which).hasClass('connectSk' && !$(which).hasClass('.connectInt'))){
			if ($(which).hasClass('sideRow') && $(which).children().length == 2){
				var $new = $('<div class="emptySideRow">Drag Here!</div>')
				
				$(which).find('>*:first').before($new);
				
			}
		}
		else{
			if ($(which).hasClass('sideRow') && $(which).children().length == 1){
				var $new = $('<div class="emptySideRow">Drag Here!</div>')
				
				$(which).find('>*:first').before($new);
				
			}	
		}
	};
	// orphan after sort End
	
	
			
			
// drag and drop with sideRow and storage Start

function mix(class){
	
	$(class).each(function(){
		class = class
		if(!$(this).hasClass('open')){
			$(this).find('.entry:not(".sample")').each(function(seq){
				var id = $(this).attr('data-i')
				var table = $(this).attr('data-t')
				var rid = $('#title').attr('data-i');
				var $item = $(this)
				
				
				var elementRID = 0;
				
				$.ajax({
					type: "post",
					url: "rid.php",
					data: {"table": table, "id": id},
					success: function(data){
						if(rid != data){
							
							if(data != 2){
								$clone = $item.clone();
								
								newElement($clone, data);
								
								var $new = $('<div class="storage"></div>')
											.append('<div class="mywrap"></div>')
								$new.find('.mywrap').append($clone)
								var $open = $item.parent().parent().find('.open')
								$new.appendTo($open);	
							}
							$.ajax({
								type:"post",
								url: "updateR.php",
								data: {"table":table, "rid":rid, "id":id},
								success: function(){}
							});								
							
																	
						}
					}
				})
				
				
				
				
				
				
				
				$.ajax({
					type:"post",
					url: "update.php",
					data: {"table":table, "field":'sequence', "id":id, "value":seq},
					success: function(){}
				});
				
			
				
			});
			
		}
		else{
			$(this).find('.entry:not(".sample")').each(function(){
				var rid = $('#title').attr('data-i');
				var id = $(this).attr('data-i')
				var table = $(this).attr('data-t')
				var $item = $(this)
				
				$.ajax({
					type: "post",
					url: "rid.php",
					data: {"table": table, "id": id},
					success: function(data){
						if(data == rid){
							rid = 2; // This will cause an error in real deployment
							
							
							$.ajax({
									type:"post",
									url: "updateR.php",
									data: {"table":table, "rid":rid, "id":id},
									success: function(){ addNotice('<p> Success! </p>')}
								});
						}
					}
				});
			})
		}
	});
	
};

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