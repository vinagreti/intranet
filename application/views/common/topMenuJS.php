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
		newTaskFather = "";
		newTaskProject = "";

		taskResponsableUser = $('#taskResponsableUser').val();
		taskKind = $('#taskKind').val();
		newTaskTitle = $('#newTaskTitle').val();

		if ( $("#taskLink1").is(':checked') ) taskLink = "Vinculada";
		if ( $("#taskLink2").is(':checked') ) taskLink = "Referenciada";

		if ( $("#taskSource1").is(':checked') ) newTaskProject = $('#newTaskProject').val();
		if ( $("#taskSource2").is(':checked') ) {
			fatherSelect = $('#newTaskFather');
			newTaskFather = fatherSelect.val();
			newTaskProject = fatherSelect.find(':selected').attr('projectID');
		} 

		$.post(base_url + "task/createTask", {
			taskFather : newTaskFather,
			taskProject : newTaskProject,
			taskKind : taskKind,
			taskResponsableUser : taskResponsableUser,
			taskTitle : newTaskTitle,
			taskLink : taskLink			
		},function( response ) {
			$('#tzadiDialogs').modal('hide');
		});
	});

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

</script>