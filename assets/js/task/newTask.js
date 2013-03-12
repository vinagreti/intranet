$(document).ready(function(){

  $('#deadLine').datetimepicker({
    language: 'pt-BR'
  });

	$(".taskSource").live('change', function( e ){
		
		if ( $("#taskSource1").is(':checked') ){
			$(".newTaskProjectSelect").show();
			$(".newTaskTaskSelect").hide();
		} 
		if ( $("#taskSource2").is(':checked') ) {
			$(".newTaskProjectSelect").hide();
			$(".newTaskTaskSelect").show();			
		}
	});

	if (typeof newTask !== 'function') {
		newTask = function newTask(){
			$("#saveNewTask").live('click', function( e ){

				$('.loading').show();

				newTaskFather = "";
				newTaskProject = "";

				taskResponsableUser = $('#taskResponsableUser').val();
				taskKind = $('#taskKind').val();
				newTaskTitle = $('#newTaskTitle').val();
				newTaskDesc = $('#newTaskDesc').val();
				deadLineDate = $('#deadLine').val();
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
					taskDesc : newTaskDesc,
					taskLink : taskLink,
					deadLineDate: deadLineDate		
				},function( response ) {
					$('#tzadiTaskForm').modal('hide');
					$('.loading').hide();
				});

			});
		};
		newTask();
	}
});