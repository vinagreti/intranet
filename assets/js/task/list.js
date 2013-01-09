$(document).ready(function(){

	var searchPattern = new Array();

	refreshList(searchPattern);


	if($(".listEmpty")){
		//$(".taskList").empty();
		//refreshList(searchPattern);
	} 
		/*
	Esta função solicita a confirmação de uma ação pelo usuário
	*/
	function confirmAction(taskID, action){
	   var retVal = confirm("Deseja realmente " + action + " a tarefa " + taskID + " ?");
	   if( retVal == true ){
		  return true;
	   }else{
		  return false;
	   }
	}

	function refreshList(searchPattern){

		$(".taskList").empty();

		$(".taskList").append("</br></br></br></br></br>Carregando...</br></br></br></br></br></br>");

		$.post(base_url+"task/ajaxSearch", {
			taskID : searchPattern["taskID"],
			taskFather : searchPattern["taskFather"],
			taskStatus : searchPattern["taskStatus"],
			searchPattern : searchPattern
		}, function( response ) {

			$(".taskList").empty();

			$(".taskList").append(response);

		});

		
	}

	/*
	Função do botão actionButton
	Este botão:
	- mostra as opções de ação sobre um registro da lista
	*/
	$('.actionButton').dropdown();

	/*
	Função do botão APROVAR: approveButton
	Este botão:
	- muda o status de uma tarefa para Approved "taskStatus= 3"
	- muda a tarefa para a tabela Approved
	*/
	$(".approveButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'aprovar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 3,
				taskID : taskID
			},function( response ) {

				refreshList(searchPattern);

			});

		}

	});

	/*
	Função do botão REJEITAR: rejectButton
	Este botão:
	- muda o status de uma tarefa para NEW "taskStatus= 2"
	- muda a tarefa para a tabela Rejected
	*/
	$(".rejectButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'rejeitar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 2,
				taskID : taskID
			},function( response ) {
				refreshList(searchPattern);
			});

		}

	});

	/*
	Função do botão CANCELAR: cancelButton
	Este botão:
	- muda o status de uma tarefa para CANCELLED "taskStatus= 5"
	- muda a tarefa para a tabela Cancelled
	*/
	$(".cancelButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'cancelar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 5,
				taskID : taskID
			},function( response ) {
				refreshList(searchPattern);
			});

		}

	});


	/*
	Função do botão INICIAR: startButton
	Este botão:
	- muda o status de uma tarefa para OnGOING "taskStatus= 4"
	- muda a tarefa para a tabela On Going
	*/
	$(".startButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'iniciar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 4,
				taskID : taskID
			},function( response ) {
				refreshList(searchPattern);
			});

		}

	});

	/*
	Função do botão FINALIZAR: finishButton
	Este botão:
	- muda o status de uma tarefa para FINISHED "taskStatus= 6"
	- muda a tarefa para a tabela FINISHED
	*/
	$(".finishButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'finalizar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 6,
				taskID : taskID
			},function( response ) {
				refreshList(searchPattern);
			});

		}

	});

	/*
	Função do botão RESGATAR: rescueButton
	Este botão:
	- muda o status de uma tarefa para NEW "taskStatus= 1"
	- muda a tarefa para a tabela NEW
	*/
	$(".rescueButton").live('click', function( e ){

		e.preventDefault();

		taskID = $(this).attr('taskID');

		if(confirmAction(taskID, 'resgatar')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 1,
				taskID : taskID
			},function( response ) {
				refreshList(searchPattern);
			});

		}

	});

	/*
	Função do botão COMENTAR: commentButton
	Este botão:
	- insere um comentário na tarefa selecionada
	*/
	$(".commentButton").live('click', function( e ){
		e.preventDefault();

		$('#tzadiDialogs').empty();

		taskID = $(this).attr('taskID');

		$.post(base_url + "task/commentForm/"+taskID, {
			form : "task/newTaskCommentDialogForm"
		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

		$('#tzadiDialogs').modal('show');
	});

	$(".taskListFilter").live('click', function( e ){
		$(".filter").toggle();
	});

	$(".filterID").live('change', function( e ){
		alert('falta implementar');
	});

	$(".taskListFilterSave").live('click', function( e ){

		$.post(base_url + "task/saveFilter/", {

		filterID : $("#filterID").val(),
		filterTaskID : $("#filterTaskID").val(),
		filterFatherID : $("#filterFatherID").val(),
		filterStatus1 : $("#filterStatus1").is(':checked'),
		filterStatus2 : $("#filterStatus2").is(':checked'),
		filterStatus3 : $("#filterStatus3").is(':checked'),
		filterStatus4 : $("#filterStatus4").is(':checked'),
		filterStatus5 : $("#filterStatus5").is(':checked'),
		filterStatus6 : $("#filterStatus6").is(':checked'),

		},function( response ) {
			$('#tzadiDialogs').append( response );
		});

	});

	$(".taskListFilterReset").live('click', function( e ){
		searchPattern = [];
		$("#filterID").attr("value", "");
		$("#filterTaskID").attr("value", "");
		$("#filterFatherID").attr("value", "");
		$("#filterStatus1").attr("checked", false);
		$("#filterStatus2").attr("checked", false);
		$("#filterStatus3").attr("checked", false);
		$("#filterStatus4").attr("checked", false);
		$("#filterStatus5").attr("checked", false);
		$("#filterStatus6").attr("checked", false);
		refreshList(searchPattern);
	});

	$(".taskFilterButton").live('click', function( e ){

		searchPattern["taskStatus"] = [];
		
		if ( $("#filterTaskID").val() )	searchPattern["taskID"] = $("#filterTaskID").val();
		if ( $("#filterFatherID").val() ) searchPattern["taskFather"] = $("#filterFatherID").val();
		if ( $("#filterStatus1").is(':checked') ) searchPattern["taskStatus"].push(1);
		if ( $("#filterStatus2").is(':checked') ) searchPattern["taskStatus"].push(2);
		if ( $("#filterStatus3").is(':checked') ) searchPattern["taskStatus"].push(3);
		if ( $("#filterStatus4").is(':checked') ) searchPattern["taskStatus"].push(4);
		if ( $("#filterStatus5").is(':checked') ) searchPattern["taskStatus"].push(5);
		if ( $("#filterStatus6").is(':checked') ) searchPattern["taskStatus"].push(6);

		refreshList(searchPattern);
	});

});