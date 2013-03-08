<div class="row-fluid">
	<h3>Tarefas</h3>
</div>

<div class="row-fluid"> <!-- inicio filtro -->
	<div class="span4"> <!-- inicio seletor de filtro padrão -->
		<form>
			<fieldset>
				<div class="input-prepend">
					<div class="btn-group">
						<button class="openSearchForm btn">
							<i class="icon-search"></i>
						</button>
					</div>
					<select id="selectFilters" class="span11">
						<option></option>
						<?php foreach($filters as $filter) { ?>
						<option value="<?=$filter->filterID?>" <?php if($filter->default) echo 'selected';?>>
						<?=$filter->filterTitle?>
						</option>
						<?php } ?>
					</select>
				</div>
			</fieldset>
		</form>
	</div> <!-- fim seletor de filtro padrão -->
	<div class="span5"> <!-- inicio botões -->
		<a class="refreshList btn btn-info" href="#" rel="tooltip" title="Atualizar lista"><i class="icon-refresh icon-white"></i></a>
		<a class='saveCurrentSearch btn btn-success' rel="tooltip" title="Salvar filtro atual"><i class="icon-download-alt icon-white"></i></a>
		<a class='setSearchAsDefault btn btn-warning' rel="tooltip" title="Tornar filtro padrão"><i class="icon-star icon-white"></i></a>
		<a class="showAllTasks btn btn-danger" href="#" rel="tooltip" title="Listar tudo"><i class="icon-remove icon-white"></i></a>
	</div> <!-- fim botões -->
</div> <!-- fim do filtro -->

<div class="row-fluid"> <!-- inicio do indicador de total de tarefas retornadas -->
	<div class="span12">
		<p class="text-warning">Foram localizadas <b class="total"></b> tarefas</p>
	</div>
</div><!-- fim do indicador de total -->

<div class="row-fluid"> <!-- inicio da tabela -->
	<table class="table table-hover table-condensed">
		<thead>
			<tr>
				<th><small>Nº </small></th>
				<th><small>Ação</small></th>
				<th><small>Título</small></th>
				<th><small>Responsável</small></th>
				<th><small>Tipo</small></th>
				<th><abbr title="Tarefa Pai"><small>TP</small></abbr></th>
				<th><small>Projeto</small></th>
				<th><small>Status</small></th>
				<th><small>Vencimento</small></th>
			</tr>
		</thead>
		<tbody class="listBody"></tbody>
	</table>  
</div> <!-- fim da tabela -->

<div class="actionSelect hide">
  <div class="dropdown">
    <button class="btn btn-small btn-primary dropdown-toggle" data-toggle="dropdown"><i class="icon-large icon-chevron-down"></i></button>
    <ul class="dropdown-menu">
			<li>
				<a class="approveButton" tabindex="-1"  href="#profile">
					<i class="icon-thumbs-up"></i> Aprovar
				</a>
			</li>
			<li>
				<a class="rejectButton" tabindex="-1"  href="#profile">
					<i class="icon-thumbs-down"></i> Rejeitar
				</a>
			</li>
			<li>
				<a class="cancelButton" tabindex="-1"  href="#profile">
					<i class="icon-remove"></i> Cancelar
				</a>
			</li>
			<li>
				<a class="startButton" tabindex="-1"  href="#profile">
					<i class="icon-play"></i> Iniciar
				</a>
			</li>
			<li>
				<a class="finishButton" tabindex="-1"  href="#profile">
					<i class="icon-ok"></i> Finaizar
				</a>
			</li>
			<li>
				<a class="rescueButton" tabindex="-1"  href="#profile">
					<i class="icon-ambulance"></i> Resgatar
				</a>
			</li>
			<li>
				<a class="commentButton" tabindex="-1"  href="#profile">
					<i class="icon-comment"></i> Comentar
				</a>
			</li>
			<li>
				<a class="activityButton" tabindex="-1"  href="#profile">
					<i class="icon-time"></i> Registrar atividade
				</a>
			</li>
    </ul>
  </div>
</div>

	<div class="row-fluid">
	<div class="span12">
	<div class="row-fluid">
	<div class="span12">
	<p class="text-center text-warning">Mostrando <b class="loaded">10</b> de <b class="total"></b> tarefas</p>
	</div>
	</div>
	<div class="row-fluid">
	<div class="span12" id="paginationButtons">	
	<div class="span6">
	<a id="showMore" class="btn btn-success btn-large btn-block">Próximas 10</a>
	</div>
	<div class="span6">
	<a id="showAll" class="btn btn-info btn-large btn-block">Todas</a>
	</div>
	</div>
	</div>
	</div>
</div><!--/row-fluid-->


<div id="filteDialogr" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Filtro" aria-hidden="true"></div>

<div class="span4 hide" id="createFilterForm">
	<div class="input-prepend">
		<span class="add-on">Filtro</span>
		<input type="text" class="filterName span10" placeholder="Informe o nome do novo filtro" />
	</div>
</div>

<script src="<?=base_url()?>assets/js/task/search.js"></script>