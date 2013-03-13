<div class="box">

	<div data-original-title="" class="box-header">
		<h3></i><span class="break"></span>Tarefa <?=$task->taskID?></h3>
	</div>

	<div class="box-content">

		<form  class="form-horizontal">

			<input type="hidden" class="taskID" name="taskID" value="<?=$task->taskID?>">

			<fieldset>

				<div class="control-group">
					<label for="taskTitle" class="control-label">Título</label>
					<div class="controls ">
						<input type="text" class="taskTitle span10" name="taskTitle" size="16" id="taskTitle" value="<?=$task->taskTitle?>">
					</div>

					<label class="control-label" for="taskResponsableUser">Responsável</label>
					<div class="controls">
						<select class="taskResponsableUser" id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen">
							<option value="<?=$task->taskResponsableUser?>"><?=$task->taskResponsableName?></option>

							<?php foreach($users as $user) { ?>
								<?php if($user->userID != $task->taskResponsableUser){?>
								<option value="<?=$user->userID?>"><?=$user->userName?></option>
								<?php } ?>
							<?php } ?>

						</select>
					</div>

					<label class="control-label" for="taskStatus">Status</label>
					<div class="controls">
						<select class="taskStatus" id="taskStatus" name="taskStatus" data-rel="chosen">
							<option value="<?=$task->taskStatus?>"><?=$task->taskStatusName?></option>

							<?php foreach($statuses as $status) { ?>
							<?php if($status->taskStatusID != $task->taskStatus){?>
							<option value="<?=$status->taskStatusID?>"><?=$status->taskStatusName?></option>
							<?php } ?>
							<?php } ?>

						</select>
					</div>

					<label class="control-label" for="taskKind">Tipo</label>
					<div class="controls">
						<select class="taskKind" id="taskKind" name="taskKind" data-rel="chosen">
							<option value="<?=$task->taskKind?>"><?=$task->taskKindName?></option>

							<?php foreach($kinds as $kind) { ?>
							<?php if($kind->taskKindID != $task->taskKind){?>
							<option value="<?=$kind->taskKindID?>"><?=$kind->taskKindName?></option>
							<?php } ?>
							<?php } ?>

						</select>
					</div>

					<label class="control-label">Projeto</label>
					<div class="controls">
						<span class="input-xlarge uneditable-input"><?=$task->projectTitle?></span>
					</div>

					<label class="control-label">Criado por</label>
					<div class="controls">
						<span class="input-xlarge uneditable-input"><?=$task->taskCreatorName?></span>
					</div>

					<label class="control-label">DeadLine</label>
					<div class="controls">
						<span class="input-xlarge uneditable-input"><?=$task->deadLineDate?></span>
					</div>

					<label class="control-label" for="taskDesc">Descrição</label>

					<div class="controls">
						<textarea class="taskDesc span10" id="taskDesc" name="taskDesc" rows="5"><?=$task->taskDesc?></textarea>
					</div>

				</div>

				 <div class="control-group">
					<div class="controls">
						<a class="btn btn-primary saveTaskEdition" href="#">Salvar</a>
						<a class="btn btn-warning commentButton" href="#">Comentar</a>
					</div>
				</div>

			</fieldset>
		</form>
	</div>
</div><!--end: box-->

<?php foreach($taskComments as $comment) { ?>
	<div class="alert alert-warning">
		<p class="muted"><?=$comment->commentAction?> - <?=$comment->commentDate?>	- <?=$comment->userName?></p>
		<p class="text-info"><?=nl2br($comment->comment)?></p>
	</div>
<?php } ?>

<script type="text/javascript">
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
</script>