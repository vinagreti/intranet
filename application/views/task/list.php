<div class="span10">

	<h3>Tarefas</h3>
	<h5><a class="taskListFilter" href="#"><i class="icon-search"></i> Filtro</a></h5>


	<div class="row-fluid">

		<div class="filter hide">

			<form method="post" action="#" class="form-horizontal filterForm">

				<div style="background:EEEEEE; padding-top:10px; margin-bottom:5px;">

					<div class="control-group warning">
						<label class="control-label" for="filterID">Filtro pré-definido: </label>
						<div class="controls">
							<select class="filterID">
								<option></option>
								<?php foreach ($taskFilters as $filter) { ?>
								<option value="<?=$filter->searchPattern?>"><?=$filter->filterTitle?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="control-group warning">
						<label class="control-label" for="filterFrojectID">Projeto: </label>
						<div class="controls">
							<select id="filterFrojectID">
								<option></option>
								<?php foreach ($taskProjects as $project) { ?>
								<option value="<?=$project->projectID?>"><?=$project->projectTitle?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="control-group warning">
						<label class="control-label" for="filterResponsableID">Responsável: </label>
						<div class="controls">
							<select id="filterResponsableID">
								<option></option>
								<?php foreach ($users as $user) { ?>
								<option value="<?=$user->userID?>"><?=$user->userName?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="control-group warning">
						<label class="control-label" for="filterTaskID">Task number: </label>
						<div class="controls">
							<input type="text" id="filterTaskID">
						</div>
					</div>

					<div class="control-group warning">
						<label class="control-label" for="filterFatherID">Task father: </label>
						<div class="controls">
							<input type="text" id="filterFatherID">
						</div>
					</div>

					<div class="control-group warning">

						<label class="control-label">Status: </label>
						
						<div class="controls">

							<label class="checkbox inline">
							  <input id="filterStatus1" type="checkbox">
							  <span class="label"><small>New</small></span>
							</label>

							<label class="checkbox inline">
							  <input id="filterStatus2" type="checkbox">
							  <span class="label label-inverse"><small>Rejected</small></span>
							</label>

							<label class="checkbox inline">
							  <input id="filterStatus3" type="checkbox">
							  <span class="label label-success"><small>Approved</small></span>
							</label>

							<label class="checkbox inline">
							  <input id="filterStatus4" type="checkbox">
							  <span class="label label-warning"><small>On going</small></span>
							</label>

							<label class="checkbox inline">
							  <input id="filterStatus5" type="checkbox">
							  <span class="label label-important"><small>Cancelled</small></span>
							</label>

							<label class="checkbox inline">
							  <input id="filterStatus6" type="checkbox">
							  <span class="label label-info"><small>Finished</small></span>
							</label>

						</div>

					</div>

				</div>

				<p>
					<button type="button" src="#" class="taskFilterButton btn btn-small btn-primary" href="#">Filtrar</button>
					<button type="button" src="#" class="taskListFilterReset btn btn-small btn-info" href="#">Reset</button>
					<button type="button" src="#" class="taskListFilter btn btn-small btn-danger" href="#">Cancelar</button>
					<button type="button" src="#" class="taskListFilterSave btn btn-small btn-warning" href="#">Salvar filtro</button>
				</p>

			</form>
		</div>
	</div>

	<div class="box taskList">
		
	</div><!--/box -->

</div><!--/span10-->