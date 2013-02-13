$(document).ready(function(){
	if (typeof ajaxSearchFile !== 'function') {
		ajaxSearchFile = function ajaxSearchFile(){
			/*
			Função do botão ACTIVITY: activityButton
			Este botão:
			- Abre o formulário para registro de atividades
			- insere um comentário na atividade selecionada
			*/
			$(".activityButton").live('click', function( e ){

				e.preventDefault();

				$('#tzadiDialogs').empty();

				taskID = $(this).attr("taskID");

				$.post(base_url + "task/activity/", {
					form : true,
					taskID : taskID
				}, function( response ) {
					$('#tzadiDialogs').append( response );
					$('#time1').clockface();
					$('#time2').clockface();
					$('#date1').datepicker();
					$('#date2').datepicker();
				});

				$('#tzadiDialogs').modal('show');

			});

			/*
			Função do botão actionButton
			Este botão:
			- mostra as opções de ação sobre um registro da lista
			*/
			$('.actionButton').dropdown();

			function listAction(taskID, status, action){

				$('#tzadiDialogs').empty();

				$.post(base_url + "task/action/", {
					form : true,
					taskID : taskID,
					action : action
				},function( response ) {
					$('#tzadiDialogs').append( response );
				});

				$('#tzadiDialogs').modal('show');

				$("#saveAction").live('click', function( e ){
					if($('#actionComment').val() != ""){
						actionComment = $('#actionComment').val();
						$.post(base_url + "task/action", {
							comment : actionComment,
							commentTask : taskID,
							commentAction : action
						});
						$.post(base_url + "task/update/" + taskID, {
							taskStatus : status,
							taskID : taskID
						}, function( e ){
							loadList(searchPattern);
						});

						$('#tzadiDialogs').modal('hide');

					} else {
						$('.alert').show();
					}
				});
			}

			/*
			Função do botão APROVAR: approveButton
			Este botão:
			- muda o status de uma tarefa para Approved "taskStatus= 3"
			- muda a tarefa para a tabela Approved
			*/
			$(".approveButton").live('click', function( e ){

				e.preventDefault();

				taskID = $(this).attr('taskID');

				if(globalConfirmAction("Deseja realmente iniciar a terafa "+ taskID + '?')){

					$.post(base_url + "task/update/" + taskID, {
						taskStatus : 3,
						taskID : taskID
					},function( response ) {

						loadList(searchPattern);

					});
					$.post(base_url + "task/action", {
						comment : 'Aprovado',
						commentTask : taskID,
						commentAction : 'Aprovar'
					});
				}
			});

			/*
			Função do botão REJEITAR: rejectButton
			Este botão:
			- Abre um formulário para inserir um comentário
			- muda o status de uma tarefa para REJECTED "taskStatus= 2"
			*/
			$(".rejectButton").live('click', function( e ){
				taskID = $(this).attr('taskID');
				action = "Rejeitar";
				listAction(taskID, 2, action);
			});



			/*
			Função do botão CANCELAR: cancelButton
			Este botão:
			- muda o status de uma tarefa para CANCELLED "taskStatus= 5"
			- muda a tarefa para a tabela Cancelled
			*/
			$(".cancelButton").live('click', function( e ){
				taskID = $(this).attr('taskID');
				action = "Cancelar";
				listAction(taskID, 5, action);
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

				if(globalConfirmAction("Deseja realmente iniciar a terafa "+ taskID + '?')){

					$.post(base_url + "task/update/" + taskID, {
						taskStatus : 4,
						taskID : taskID
					},function( response ) {
						loadList(searchPattern);
					});
					$.post(base_url + "task/action", {
						comment : 'Iniciado',
						commentTask : taskID,
						commentAction : 'Iniciar'
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
				taskID = $(this).attr('taskID');
				action = "Finalizar";
				listAction(taskID, 6, action);
			});

			/*
			Função do botão RESGATAR: rescueButton
			Este botão:
			- muda o status de uma tarefa para NEW "taskStatus= 1"
			- muda a tarefa para a tabela NEW
			*/
			$(".rescueButton").live('click', function( e ){
				taskID = $(this).attr('taskID');
				action = "Resgatar";
				listAction(taskID, 1, action);
			});

			/*
			Função do botão COMENTAR: commentButton
			Este botão:
			- insere um comentário na tarefa selecionada
			*/
			$(".commentButton").live('click', function( e ){

				e.preventDefault();

				$('#tzadiDialogs').empty();

				taskID = $(this).attr("taskID");

				$.post(base_url + "task/newCommentForm/", {
					taskID : taskID
				}, function( response ) {
					$('#tzadiDialogs').append( response );
				});

				$('#tzadiDialogs').modal('show');
			});

			$("#saveNewComment").live('click', function( e ){
				newComment = $('#newComment').val();
				taskID = $('#newComment').attr("taskID");
				$.post(base_url + "task/newComment", {
					comment : newComment,
					commentTask : taskID
				},function( response ) {
					$('#tzadiDialogs').modal('hide');
				});
			});

		};
		
		ajaxSearchFile();
	}
});