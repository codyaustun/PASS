/* JavaScript Document
	Made by Cody Coleman
   IAP 2011
   for 6.470
*/

// Code for editable START


$(document).ready(function(){
	
	
		
		
	/*
	label {
  	display: block;
	}
	label.valid {
  	width: 24px;
  	background: url(valid.png) center center no-repeat;
  	display: inline-block;
  	text-indent: -9999px;
}	
	*/
	
	$("#firstName").keypress(function(e){
		var info = $(this).val();
		$("#firstNameC").text(info);
		
		yay();
		
	})
	
	$("#firstName").keyup(function(){
		var info = $(this).val();
		$("#firstNameC").text(info);
		yay();
			
	})
	
	$("#lastName").keypress(function(){
		var info = $(this).val();
		$("#lastNameC").text(info);
		yay();
	})
	
	$("#lastName").keyup(function(){
		var info = $(this).val();
		$("#lastNameC").text(info);
		yay();
	})
	
	$('#loginBut').click(function(e){
		
		var $form = $(this).closest('#loginForm');
		var email = $form.find('#email').val();
		var password = $form.find('#password').val();
		
		$.ajax({
			type: "post",
			url: "login.php",
			data: {"email": email, "password": password},
			success: function(data){
				if(data == "dashboard.php"){
					window.location.href=data;
				}
				else{
					addNotice("<p>" + data + "</p>");	
				}
				
				
				
			},
		})
		
		e.preventDefault();
	});
	
	
	$('#signUpSubmit').click(function(e){
		
		var $form = $(this).closest('#signUp');
		var email_su = $form.find('#email_su').val();
		var password_su = $form.find('#password_su').val();
		var firstName = $form.find('#firstName').val();
		var lastName = $form.find('#lastName').val();
		var confirmPass = $form.find('#confirm').val();
		
		var dict = {
			'email_su': email_su,
			'password_su': password_su,
			'firstName': firstName,
			'lastName': lastName, 
			'confirm': confirmPass,
			
		}
		
		$.ajax({
			type: "post",
			url: "login.php",
			data: dict,
			success: function(data){
				if(data == "dashboard.php"){
					//addNotice("<p>" + data + "</p>");
					window.location.href=data;
				}
				else{
					addNotice("<p>" + data + "</p>");	
				}
				
				
			},
		})
		
		e.preventDefault();
	});
	
});

function yay(){
	if($("#firstName").val() == "" && $('#lastName').val() == ""){
		$("#yay").text("");
		$("#hi").text("");
	}else
	{
		$("#yay").text("!");
		$("#hi").text("Hi");	
	}
	
}

