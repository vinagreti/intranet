$(document).ready(function(){

	$('[data-rel="chosen"],[rel="chosen"]').chosen();

	$( "#saveNewCommentTask" ).button().live('click',function(e){
		e.preventDefault();

		var bValid = true,
		TaskComment = $( "#newTaskComment" ),
		newTaskCommentTipsField = $( "#newTaskCommentTipsField" );

		// form validation
		bValid = bValid && checkLength( TaskComment, "comentário", 1, 64000, newTaskCommentTipsField );
		
		// creating the Task
		if(bValid){

			$("#jqueryLoading").show();

			taskID = $("#commentTaskID");

			newTaskCommentTipsField.text( "" );

			$.post(base_url + "task/comment", {
				comment : TaskComment.val(),
				taskID : taskID.val()
			},function(response) {

				$("#jqueryLoading").hide();

				if(response == 1){

					TaskComment.text( );
					$('#tzadiDialogs').modal('hide');
					noty({"text":"Seu comentário foi inserido com sucesso","layout":"top","type":"information"});

				} else {

					$("#jqueryLoading").hide();
					noty({"text":"Problemas ao inserir o comentário. Um e-mail foi enviado para nossos técnicos e em breve entraremso em contato para lhe informar o que houve.","layout":"top","type":"error"});

				}


			});
		}
	});

// Update the tips field

	function updateTips( t, tips_field ) {

		tips_field

			.text( t )

			.addClass( "alert alert-error" );

	}


// Check the field length

	function checkLength( o, n, min, max, tips_field ) {

		if ( o.val().length > max || o.val().length < min ) {

			o.addClass( "alert alert-error" );

			setTimeout(function() {

				o.removeClass( "alert alert-error", 1500 );

			}, 7200 );

			updateTips(" O tamanho do(a) "+n+" deve ter entre "+min+" e "+max+" caracteres.", tips_field);

			return false;

		} else {

			return true;

		}

	}

});