<div class="span10" id="content">
	<!-- start: Content -->

	<div class="row-fluid sortable ui-sortable">
		<div class="box span12">

			<div data-original-title="" class="box-header">
				<h2></i><span class="break"></span># <?=$task->taskID?></h2>
			</div>

			<div class="box-content">

				<form  method="post" action="<?=base_url()?>task/view/<?=$task->taskID?>" class="form-horizontal">
					<fieldset>

						<div class="control-group">
							<label for="taskTitle" class="control-label">Título</label>
							<div class="controls ">
								<input type="text" class="span10" name="taskTitle" size="16" id="taskTitle" value="<?=$task->taskTitle?>">
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="taskResponsableUser">Responsável</label>
							<div class="controls">
								<select id="taskResponsableUser" name="taskResponsableUser" data-rel="chosen">
									<option value="<?=$task->taskResponsableUser?>"><?=$task->taskResponsableName?></option>

									<?php foreach($users as $user) { ?>
									<?php if($user->userID != $task->taskResponsableUser){?>
									<option value="<?=$user->userID?>"><?=$user->userName?></option>
									<?php } ?>
									<?php } ?>

								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="taskStatus">Status</label>
							<div class="controls">
								<select id="taskStatus" name="taskStatus" data-rel="chosen">
									<option value="<?=$task->taskStatus?>"><?=$task->taskStatusName?></option>

									<?php foreach($statuses as $status) { ?>
									<?php if($status->taskStatusID != $task->taskStatus){?>
									<option value="<?=$status->taskStatusID?>"><?=$status->taskStatusName?></option>
									<?php } ?>
									<?php } ?>

								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="taskKind">Tipo</label>
							<div class="controls">
								<select id="taskKind" name="taskKind" data-rel="chosen">
									<option value="<?=$task->taskKind?>"><?=$task->taskKindName?></option>

									<?php foreach($kinds as $kind) { ?>
									<?php if($kind->taskKindID != $task->taskKind){?>
									<option value="<?=$kind->taskKindID?>"><?=$kind->taskKindName?></option>
									<?php } ?>
									<?php } ?>

								</select>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label">Criado por</label>
							<div class="controls">
								<span class="input-xlarge uneditable-input"><?=$task->taskCreatorName?></span>
							</div>
						</div>

						<div class="control-group">
							<label class="control-label" for="taskDesc">Descrição</label>

							<div class="controls">
								<textarea class="textarea span10" id="taskDesc" name="taskDesc" rows="5"><?=$task->taskDesc?></textarea>
							</div>

						</div>

						<div class="form-actions">
							<button class="btn btn-primary" type="submit">Salvar</button>
							<button class="btn btn-inverse">Salvar e Listar</button>
							<button class="btn">Cancelar</button>
						</div>

					</fieldset>
				</form>
			</div>
		</div><!--/span-->

	</div>

</div><!-- end: Content -->