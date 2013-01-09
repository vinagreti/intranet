$(document).ready(function(){

	$( "#saveNewProject" ).button().click(function(e){
		e.preventDefault();

		var bValid = true,
		projectTitle = $( "#newProjectTitle" ),
		projectDesc = $( "#newProjectDesc" ),
		newProjectTipsField = $( "#newProjectTipsField" );

		// form validation
		bValid = bValid && checkLength( projectTitle, "título", 3, 200, newProjectTipsField );
		bValid = bValid && checkLength( projectDesc, "descrição", 0, 200, newProjectTipsField );

		// creating the project
		if(bValid){

			$("#jqueryLoading").show();

			$(".registerTipsField").text( "" );

			$.post(base_url + "project/create", {
				projectTitle : projectTitle.val(), 
				projectDesc : projectDesc.val(),
				projectResponsableUser : sessionUserID,
				projectCreatorUser : sessionUserID,
			},function(response) {

				$("#jqueryLoading").hide();

				if(response == 1){

					projectTitle.text( );
					projectDesc.text( );
					$('#newProjectDialog').modal('hide');
					noty({"text":"Seu projeto foi inserido com sucesso","layout":"top","type":"information"});

				} else {

					$("#jqueryLoading").hide();
					noty({"text":"Problemas ao inserir o projeto. Um e-mail foi enviado para nossos técnicos e em breve entraremso em contato para lhe informar o que houve.","layout":"top","type":"error"});

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