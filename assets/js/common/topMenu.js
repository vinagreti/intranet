$(document).ready(function(){

// botão para alterar o projeto em que está trabalhando
	$(".projectSelect").live('click', function( e ){
		project = $(this).attr('id');
		$.post(base_url + "user/ChangeProject", {
			project : project
		},function( e ) {
			document.location.reload()
		});
	});

// The topMenu add task button functions
	$(".newTaskButton").live('click', function( e ){
		if (typeof newTaskForm !== 'function') {
			newTaskForm = function (){
				e.preventDefault();

				$('#tzadiTaskForm').empty();

				$.post(base_url + "task/newTask", {
					form : true
				},function( response ) {
					$('#tzadiTaskForm').append( response );
				});
				$('#tzadiTaskForm').modal('show');
			}

			newTaskForm();
		} else {
			$('#tzadiTaskForm').modal('show');
		}		
	});

	// The topMenu calc button
	$(".calcButton").live('click', function( e ){
		if (typeof taskCalc !== 'function') {
			taskCalc = function (){
				e.preventDefault();

				$('#tzadiCalc').empty();

				$.post(base_url + "calc", {
					form : true
				},function( response ) {
					$('#tzadiCalc').append( response );
				});

				$('#tzadiCalc').modal('show');
			}

			taskCalc();
		} else {
			$('#tzadiCalc').modal('show');
		}		
	})

// The topMenu add project button functions
	$(".newProjectButton").live('click', function( e ){

		e.preventDefault();

		$('#tzadiDialogs').empty();

		$.post(base_url + "task/createProjectForm", {
			form : "create/newProjectDialogForm"
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');
	});

// save new project button - should be in te new project js file
	$("#saveNewProject").live('click', function( e ){

		$("#saveNewProject").button('loading');

		var valid = true;
		valid = valid && globalValidateLenght(1, 65535, $('#newProjectTitle').val(), 'Favor definir o título do Projeto');

		if ( valid ) {
			$.post(base_url + "task/createProject", {
				projectTitle : $('#newProjectTitle').val()
			},function( response ) {
				$('#tzadiDialogs').modal('hide');
				$("#saveNewProject").button('reset');
			});
		} else {
			$("#saveNewProject").button('reset');
		}

	});
});