<h3>Tarefa <?=$task->taskID?></h3>

<div class="row-fluid">
	<div class="span12">
		<form>
			<input type="hidden" class="taskID" name="taskID" value="<?=$task->taskID?>">
			<input type="text" class="taskTitle span10" name="taskTitle" size="16" id="taskTitle" value="<?=$task->taskTitle?>">

			<select class="taskResponsableUser" id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen">
				<option value="<?=$task->taskResponsableUser?>"><?=$task->taskResponsableName?></option>

				<?php foreach($users as $user) { ?>
					<?php if($user->userID != $task->taskResponsableUser){?>
					<option value="<?=$user->userID?>"><?=$user->userName?></option>
					<?php } ?>
				<?php } ?>

			</select>

	    <span class="add-on">
				<span class="dropdown">
					<a class="btn btn-info btn-mini dropdown-toggle" data-toggle="dropdown" rel="tooltip" title="Ações"><i class="icon-chevron-down"></i></a>
					<ul class="dropdown-menu" id="taskStatus" role="menu" aria-labelledby="dLabel" tabindex="-1">
						<?php if($task->taskStatus == "1") echo '<li><a href="#" class="approveButton" taskID="'.$task->taskID.'"><i class="icon-thumbs-up"></i> Aprovar</a></li>'; ?>
						<?php if($task->taskStatus == "1") echo '<li><a href="#" class="rejectButton" taskID="'.$task->taskID.'"><i class="icon-thumbs-down"></i> Rejeitar</a></li>'; ?>
						<?php if($task->taskStatus != "1" && $task->taskStatus != "5"  && $task->taskStatus != "2") echo '<li><a href="#" class="cancelButton" taskID="'.$task->taskID.'"><i class="icon-remove"></i> Cancelar</a></li>'; ?>
						<?php if($task->taskStatus != "5"  && $task->taskStatus != "2"  && $task->taskStatus != "4") echo '<li><a href="#" class="startButton" taskID="'.$task->taskID.'"><i class="icon-play"></i> Iniciar</a></li>'; ?>
						<?php if($task->taskStatus != "5"  && $task->taskStatus != "2") echo '<li><a href="#" class="finishButton" taskID="'.$task->taskID.'"><i class="icon-ok"></i> Finaizar</a></li>'; ?>
						<?php if($task->taskStatus == "5" || $task->taskStatus == "2") echo '<li><a href="#" class="reopenButton" taskID="'.$task->taskID.'"><i class="icon-warning-sign"></i> Reabrir tarefa</a></li>'; ?>
						<?php if($task->taskStatus != "1") echo '<li><a href="#" class="activityButton" taskID="'.$task->taskID.'"><i class="icon-time"></i> Registrar atividade</a></li>'; ?>
					</ul>
				</span>
	    </span>

	    <span class="input-xlarge uneditable-input"><?=$task->taskStatus?></span>

			<select class="taskKind" id="taskKind" name="taskKind" data-rel="chosen">
				<option value="<?=$task->taskKind?>"><?=$task->taskKindName?></option>

				<?php foreach($kinds as $kind) { ?>
				<?php if($kind->taskKindID != $task->taskKind){?>
				<option value="<?=$kind->taskKindID?>"><?=$kind->taskKindName?></option>
				<?php } ?>
				<?php } ?>

			</select>

			<span class="input-xlarge uneditable-input"><?=$task->projectTitle?></span>
			<span class="input-xlarge uneditable-input"><?=$task->taskCreatorName?></span>
			<span class="input-xlarge uneditable-input"><?=$task->deadLineDate?></span>
			<textarea class="taskDesc span10" id="taskDesc" name="taskDesc" rows="5"><?=$task->taskDesc?></textarea>
			<a class="btn btn-primary saveTaskEdition" href="#">Salvar</a>
			<a class="btn btn-warning commentButton" href="#">Comentar</a>
		</form>
	</div>
</div>
	


<?php foreach($taskComments as $comment) { ?>
	<div class="alert alert-warning">
		<p class="muted"><?=$comment->commentAction?> - <?=$comment->commentDate?>	- <?=$comment->userName?></p>
		<p class="text-info"><?=nl2br($comment->comment)?></p>
	</div>
<?php } ?>

<script type="text/javascript">
$(document).ready(function(){

	refresh = function refresh() {
		location.reload();
	}

	$(".commentButton").live('click', function( e ){
		e.preventDefault();
		taskID = $(this).attr('taskID');
		$.post(base_url + "task/comment", {
			form : true,
			taskID : "<?=$task->taskID?>"
		}, function( e ) {
			$('#tzadiDialogs').html( e );
			$('#tzadiDialogs').modal('show');
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

	/*
	Função do botão APROVAR: approveButton
	Este botão:
	- muda o status de uma tarefa para Approved "taskStatus= 3"
	- muda a tarefa para a tabela Approved
	*/
	$(".approveButton").live('click', function( e ){
		e.preventDefault();
		taskID = $(this).attr('taskID');
		if(globalConfirmAction("Deseja realmente aprovar a tarefa "+ taskID + "?")){
			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 3,
				taskID : taskID
			},function( e ) {
				if ( e ) {
					$.post(base_url + "task/saveActionComment", {
						comment : 'Successo!',
						commentTask : taskID,
						commentAction : 'Aprovada'
					});
					refresh();
				}
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
		e.preventDefault();
		taskID = $(this).attr('taskID');
		if(globalConfirmAction("Deseja realmente rejeitar a tarefa "+ taskID + '?')){
			$.post(base_url + "task/rejectTask", {
				form : true,
				taskID : taskID
			}, function( e ) {
				$('#tzadiDialogs').html( e );
				$('#tzadiDialogs').modal('show');
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
		if(globalConfirmAction("Deseja realmente cancelar a tarefa "+ taskID + '?')){
			$.post(base_url + "task/cancelTask", {
				form : true,
				taskID : taskID
			}, function( e ) {
				$('#tzadiDialogs').html( e );
				$('#tzadiDialogs').modal('show');
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
		if(globalConfirmAction("Deseja realmente iniciar a tarefa "+ taskID + '?')){
			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 4,
				taskID : taskID
			},function( e ) {
				if ( e ) {
					$.post(base_url + "task/saveActionComment", {
						comment : 'Successo!',
						commentTask : taskID,
						commentAction : 'Iniciada'
					});
					refresh();
				}
			});
		}
	});

	/*
	Função do botão REABRIR: reopenButton
	Este botão:
	- muda o status de uma tarefa para NEW "taskStatus= 1"
	- muda a tarefa para a tabela NEW
	*/
	$(".reopenButton").live('click', function( e ){
		e.preventDefault();
		taskID = $(this).attr('taskID');
		if(globalConfirmAction("Deseja realmente reabrir a tarefa "+ taskID + '?')){
			$.post(base_url + "task/reopenTask", {
				form : true,
				taskID : taskID
			}, function( e ) {
				$('#tzadiDialogs').html( e );
				$('#tzadiDialogs').modal('show');
			});
		}
	});

	/*
	Função do botão ACTIVITY: activityButton
	Este botão:
	- Abre o formulário para registro de atividades
	- insere um comentário na atividade selecionada
	*/
	$(".activityButton").live('click', function( e ){
		e.preventDefault();
		taskID = $(this).attr('taskID');
		$.post(base_url + "task/saveActivity", {
			form : true,
			taskID : taskID
		}, function( e ) {
			$('#tzadiDialogs').html( e );
			$('#tzadiDialogs').modal('show');
		});
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
		if(globalConfirmAction("Deseja realmente reabrir a tarefa "+ taskID + '?')){

			$.post(base_url + "task/update/" + taskID, {
				taskStatus : 6,
				taskID : taskID
			},function( e ) {
				if ( e ) {
					$.post(base_url + "task/finishTask", {
						form : true,
						taskID : taskID
					}, function( e ) {
						$('#tzadiDialogs').html( e );
						$('#tzadiDialogs').modal('show');
					});
				}
			});
		}
	});	
});
</script>