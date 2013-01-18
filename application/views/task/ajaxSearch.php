	<meta charset="utf-8"><link href="<?=base_url()?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

	<table class="table table-hover table-condensed">

	<thead>
		<tr>
			<th><small>ID </small></th>
			<th><small>Ação</small></th>
			<th><small>Título</small></th>
			<th><small>Responsável</small></th>
			<th><small>Tipo</small></th>
			<th><abbr title="Tarefa Pai"><small>TP</small></abbr></th>
			<th><small>Projeto</small></th>
			<th><small>Status</small></th>
			<th><small>Dead line</small></th>

		</tr>
	</thead>

	<tbody>
		<?php foreach($tasks as $task){ ?>
		<tr>

			<td><small><?=$task->taskID?></small></td>

			<td class="center">
				<ul class="nav">
					<li class="dropdown">
						<a class="actionButton" data-toggle="dropdown" href="#"><i class="icon-chevron-down"></i></a>
						<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

							<?php if($task->taskStatus == "1") { ?>
							<li >
								<a class="approveButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-thumbs-up"></i> Aprovar</a>
							</li>
							<?php } ?>
							<?php if($task->taskStatus == "1") { ?>
							<li>
								<a class="rejectButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-thumbs-down"></i> Rejeitar</a>
							</li>
							<?php } ?>
							<?php if($task->taskStatus == "3" OR $task->taskStatus == "4") { ?>
							<li>
								<a class="cancelButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-remove"></i> Cancelar</a>
							</li>
							<?php } ?>
							<?php if($task->taskStatus == "1" OR $task->taskStatus == "3") { ?>
							<li>
								<a class="startButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-play"></i> Iniciar</a>
							</li>
							<?php } ?>
							<?php if($task->taskStatus == "4") { ?>
							<li>
								<a class="finishButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-ok"></i> Finaizar</a>
							</li>
							<?php } ?>
							<?php if($task->taskStatus == "2" OR $task->taskStatus == "5" OR $task->taskStatus == "6") { ?>
							<li>
								<a class="rescueButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-warning-sign"></i> Resgatar</a>
							</li>
							<?php } ?>

							<li>
								<a class="commentButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-comment"></i> Comentar</a>
							</li>
							<li>
								<a class="activityButton" taskID="<?=$task->taskID?>" tabindex="-1"  href="#profile"><i class="icon-time"></i> Registrar atividade</a>
							</li>
						</ul>
					</li>
				</ul>
			</td>

			<td class="center"><small><a href="<?=base_url()?>task/view/<?=$task->taskID?>" target="_blank" rel="tooltip" title="<?=$task->taskTitle?>"><?=substr($task->taskTitle, 0, 80)?></a></small></td>
			<td class="center"><small><?=substr($task->taskResponsableName, 0, 20)?></small></td>
			<td class="center"><small><?=substr($task->taskKindName, 0, 20)?></small></td>

			<?php if($task->taskLink == 1) { $label = 'label-important'; $link = "Vinculada à tarefa $task->taskFather"; ?>
			<?php } else { $label = 'label-info'; $link = "Referenciada à tarefa $task->taskFather"; }?>
			<?php if($task->taskFather == 0) { if($task->taskLink == 1) { $link = "Vinculo direto com o projeto $task->taskProjectTitle"; } else { $link = "Referência direta ao projeto $task->taskProjectTitle"; } } ?>

			<td class="center"><small><a href="<?=base_url()?>task/view/<?=$task->taskFather?>" target="_blank" rel="tooltip" title="<?=$link?>"><span class="label <?=$label?>"><small><?=$task->taskFather?></small></span></a></small></td>
			<td class="center"><small><a href="<?=base_url()?>task/project/<?=$task->taskProject?>" target="_blank"><?=substr($task->taskProjectTitle, 0, 8)?></a></small></td>
			<td class="center "><span class="label <?=$task->taskLabel?>"><small><?=substr($task->taskStatusName, 0, 30)?></small></span></td>
			<td class="center"><small><?=substr($task->deadLineDate, 0, 20)?></small></td>
		</tr>
		<?php } ?>
	</tbody>
</table>  

<div class="row-fluid">
	<div class="span12">
		<div class="dataTables_info" id="DataTables_Table_0_info">Showing 1 to <?=$totalTasks?> of <?=$totalTasks?> entries</div>
	</div>
	<div class="span12 center">
		<div class="dataTables_paginate paging_bootstrap pagination">
			<ul>
				<li class="prev disabled"><a href="#">← Anterior</a></li>
				<li class="active"><a href="#">1</a></li>
				<li class="next disabled"><a href="#">Próxima → </a></li>
			</ul>
		</div>
	</div><!--/span12-->
</div><!--/row-fluid-->

<script src="<?=base_url()?>assets/js/task/ajaxSearch.js"></script>