$(document).ready(function(){

	$('[data-rel="chosen"],[rel="chosen"]').chosen();

	$( "#saveNewTask" ).button().click(function(e){
		e.preventDefault();

		var bValid = true,
		TaskTitle = $( "#newTaskTitle" ),
		TaskDesc = $( "#newTaskDesc" ),
		TaskDemand = $( "#newTaskDemand" ),
		newTaskTipsField = $( "#newTaskTipsField" );

		// form validation
		bValid = bValid && checkLength( TaskDemand, "demand", 1, 256, newTaskTipsField );
		bValid = bValid && checkLength( TaskTitle, "título", 3, 200, newTaskTipsField );
		bValid = bValid && checkLength( TaskDesc, "descrição", 0, 64000, newTaskTipsField );
		
		// creating the Task
		if(bValid){

			$("#jqueryLoading").show();

			$(".registerTipsField").text( "" );

			$.post(base_url + "task/create", {
				TaskTitle : TaskTitle.val(), 
				TaskDesc : TaskDesc.val(),
				TaskDemand : TaskDemand.val(),
				TaskResponsableUser : sessionUserID,
				TaskCreatorUser : sessionUserID,
			},function(response) {

				$("#jqueryLoading").hide();

				if(response == 1){

					TaskTitle.text( );
					TaskDesc.text( );
					$('#tzadiDialogs').modal('hide');
					noty({"text":"Sua tarefa foi inserida com sucesso","layout":"top","type":"information"});

				} else {

					$("#jqueryLoading").hide();
					noty({"text":"Problemas ao inserir a demanda. Um e-mail foi enviado para nossos técnicos e em breve entraremso em contato para lhe informar o que houve.","layout":"top","type":"error"});

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