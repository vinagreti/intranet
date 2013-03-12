$(document).ready(function(){

  $('#deadLine').datetimepicker({
    language: 'pt-BR'
  });

	$("#taskSourceProject").live('click', function( e ){
		$(".newTaskProjectSelect").show();
		$(".newTaskTaskSelect").hide();
	});

	$("#taskSourceTask").live('click', function( e ){
		$(".newTaskProjectSelect").hide();
		$(".newTaskTaskSelect").show();			
	});

	$("#test").live('click', function( e ){
		console.log($('#newTaskFather').find(':selected').attr('project'));
	});

	if (typeof newTask !== 'function') {
		newTask = function newTask(){
			$("#saveNewTask").live('click', function( e ){

				$("#saveNewTask").button('loading');

				if ( $('button[name="taskSource"].active').val() == 'task' ) {
					taskFather = $('#newTaskFather').val();
					taskProject = $('#newTaskFather').find(':selected').attr('project');
				}
				if ( $('button[name="taskSource"].active').val() == 'project' ){
					taskFather = 0;
					taskProject = $('#newTaskProject').val();
				} 

				var valid = true;
				console.log(taskFather);
				valid = valid && globalValidateLenght(1, 65535, $('#newTaskTitle').val(), 'Favor definir o título da tarefa');
				valid = valid && globalValidateLenght(1, 65535, $('#taskKind').val(), 'Favor definir o tipo da tarefa');
				valid = valid && globalValidateLenght(1, 65535, $('#deadLineDate').val(), 'Favor definir o deadline da tarefa');
				valid = valid && globalValidateLenght(1, 65535, taskFather, 'Favor definir o vínculo da tarefa');

				if ( valid ) {
					$.post(base_url + "task/newTask", {
						taskFather : taskFather,
						taskProject : taskProject,
						taskKind : $('#taskKind').val(),
						taskResponsableUser : $('#taskResponsableUser').val(),
						taskTitle : $('#newTaskTitle').val(),
						taskDesc : $('#newTaskDesc').val(),
						taskLink : $('button[name="taskLink"].active').val(),
						deadLineDate: $('#deadLineDate').val()		
					},function( response ) {
						$('#tzadiTaskForm').modal('hide');
						$("#saveNewTask").button('reset')
					});
				} else {
					$("#saveNewTask").button('reset');
				}


			});
		};
		newTask();
	}
});