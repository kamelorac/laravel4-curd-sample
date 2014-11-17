$('document').ready(function(){
	$("#btnRegister").click(function(e){
		
		$('#frmRegister').validate({
			rules : {
				inputName : {
					minlength : 3,
					required : true
				},
				inputEmail : {
					minlength : 3,
					email : true,
					required : true
				},
				inputPassword : {
					minlength : 3,
					required : true
				}
			},
			message : {
				inputName : "Required",

			}, 
			highlight: function(element) {
		        $(element).closest('.form-group').addClass('has-error');
		    },
		    unhighlight: function(element) {
		        $(element).closest('.form-group').removeClass('has-error');
		    }
		});
	});


	$("#btnLogin").click(function(e){
		$('#frmLogin').validate({
			rules : {
				inputEmail : {
					minlength : 3,
					email : true,
					required : true
				},
				inputPassword : {
					minlength : 3,
					required : true
				}
			},
			message : {
				inputName : "Required",

			}, 
			highlight: function(element) {
		        $(element).closest('.form-group').addClass('has-error');
		    },
		    unhighlight: function(element) {
		        $(element).closest('.form-group').removeClass('has-error');
		    }
		});
	});

});