$(document).ready(function(){

	/*
	Função do botão COMENTAR: commentButton
	Este botão:
	- inicia a inserção de comentário na tarefa selecionada
	*/
	$(".commentButton").live('click', function( e ){
		e.preventDefault();

		$('#tzadiDialogs').empty();

		taskID = $('.taskID').val();

		$.post(base_url + "task/newCommentForm/", {
			taskID : taskID
		},function( response ) {
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


	/*
	Função do botão SALVAR: approveButton
	Este botão:
	- muda o status de uma tarefa para Approved "taskStatus= 3"
	- muda a tarefa para a tabela Approved
	*/
	$(".saveTaskEdition").live('click', function( e ){

		e.preventDefault();

		taskID = $('.taskID').val();
		taskTitle = $('.taskTitle').val();
		taskResponsableUser = $('.taskResponsableUser').val();
		taskStatus = $('.taskStatus').val();
		taskKind = $('.taskKind').val();
		taskDesc = $('.taskDesc').val();

		$.post(base_url + "task/update/"+taskID, {
			taskResponsableUser : taskResponsableUser,
			taskTitle : taskTitle,
			taskStatus : taskStatus,
			taskKind : taskKind,
			taskDesc : taskDesc
		},function( response ) {
			alert('Salvo com sucesso! - melhorar alertas');
		});

	});

});