$(document).ready(function(){
	$('.navBarTaskMenu').dropdown();
	$('.navBarConfigurationMenu').dropdown();

// The topMenu add task button functions
	$(".newTaskButton").live('click', function( e ){
		e.preventDefault();

		$('#tzadiDialogs').empty();

		$.post(base_url + "task/newTask", {
			form : true
		},function( response ) {
			$('#tzadiDialogs').append( response );
			$('#deadLineTime').clockface();
			$('#deadLineDate').datepicker();
		});

		$('#tzadiDialogs').modal('show');
	})

	// The topMenu calc button
	$(".calcButton").live('click', function( e ){
		if (typeof taskCalc !== 'function') {
			taskCalc = function taskSaveFilter(){
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

	$(".taskSource").live('change', function( e ){
		
		$(".linkSelect").show();

		if ( $("#taskSource1").is(':checked') ){
			$(".projectSelect").show();
			$(".taskSelect").hide();
		} 
		if ( $("#taskSource2").is(':checked') ) {
			$(".projectSelect").hide();
			$(".taskSelect").show();			
		}
	});

// The topMenu add demand button functions
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

	$("#saveNewProject").live('click', function( e ){
		newProjectTitle = $('#newProjectTitle').val();
		$.post(base_url + "task/createProject", {
			projectTitle : newProjectTitle
		},function( response ) {
			$('#tzadiDialogs').modal('hide');
		});
	});
});