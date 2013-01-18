$(document).ready(function(){
	if (typeof newTask !== 'function') {
		newTask = function newTask(){
			$("#saveNewTask").live('click', function( e ){
				newTaskFather = "";
				newTaskProject = "";

				taskResponsableUser = $('#taskResponsableUser').val();
				taskKind = $('#taskKind').val();
				newTaskTitle = $('#newTaskTitle').val();
				date = $('#deadLineDate').val();
				time = $('#deadLineTime').val();
				deadLineDate = date+" "+ time;
				if ( $("#taskLink1").is(':checked') ) taskLink = 1;
				if ( $("#taskLink2").is(':checked') ) taskLink = 0;

				if ( $("#taskSource1").is(':checked') ) newTaskProject = $('#newTaskProject').val();
				if ( $("#taskSource2").is(':checked') ) {
					fatherSelect = $('#newTaskFather');
					newTaskFather = fatherSelect.val();
					newTaskProject = fatherSelect.find(':selected').attr('projectID');
				} 
				$.post(base_url + "task/newTask", {
					taskFather : newTaskFather,
					taskProject : newTaskProject,
					taskKind : taskKind,
					taskResponsableUser : taskResponsableUser,
					taskTitle : newTaskTitle,
					taskLink : taskLink,
					deadLineDate: deadLineDate		
				},function( response ) {
					$('#tzadiDialogs').modal('hide');
				});
			});
		};
		newTask();
	}
});