<script type="text/javascript">

	$('.navBarTaskMenu').dropdown();
	$('.navBarConfigurationMenu').dropdown();

// The topMenu add task button functions
	$(".newTaskButton").live('click', function( e ){
		e.preventDefault();

		$('#tzadiDialogs').empty();

		$.post(base_url + "task/createTaskForm", {
			form : "task/newTaskDialogForm"
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');
	})

	$("#saveNewTask").live('click', function( e ){
		newTaskFather = $('#newTaskFather').val(); 
		taskResponsableUser = $('#taskResponsableUser').val();
		taskKind = $('#taskKind').val();
		newTaskTitle = $('#newTaskTitle').val();
		$.post(base_url + "task/createTask", {
			taskFather : newTaskFather,
			taskKind : taskKind,
			taskResponsableUser : taskResponsableUser,
			taskTitle : newTaskTitle
		},function( response ) {
			$('#tzadiDialogs').modal('hide');
		});
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

</script>