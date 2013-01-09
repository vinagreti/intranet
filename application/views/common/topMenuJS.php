<script type="text/javascript">

	$('.navBarTaskMenu').dropdown();
	$('.navBarConfigurationMenu').dropdown();

// The topMenu add task button functions
	$(".newTaskButton").live('click', function( e ){
		e.preventDefault();

		$('#tzadiDialogs').empty();

		$.post(base_url + "task/createForm", {
			form : "task/newTaskDialogForm"
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');
	})

	

	$("#saveNewTask").live('click', function( e ){
		newTaskFather = $('#newTaskFather').val(); 
		newTaskTitle = $('#newTaskTitle').val();
		$.post(base_url + "task/create", {
			taskFather : newTaskFather,
			taskTitle : newTaskTitle
		},function( response ) {
			$('#tzadiDialogs').modal('hide');
		});
	});


// The topMenu add demand button functions
	$(".newProjectButton").live('click', function( e ){

		e.preventDefault();

		$('#tzadiDialogs').empty();

		$.post(base_url + "project/createForm", {
			form : "create/newProjectDialogForm"
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');
	});
</script>