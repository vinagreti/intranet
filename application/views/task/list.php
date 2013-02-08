<?=$searchPattern?>
<div class="span10">

	<div class="row-fluid">
		<h3>Tarefas</h3>
	</div>
	
	<div class="row-fluid">
		<div class="span4" id="selectFilterForm">

			<div class="input-prepend">

			  <div class="btn-group">
			    <button class="navBarConfigurationMenu btn dropdown-toggle" data-toggle="dropdown">
			      <i class="icon-search"></i>
			    </button>
				<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

					<li><a class="taskListFilter" href="#" rel="tooltip" title="Filtro avançado">Filtro avançado</a></li>
					<li><a class="taskListFilterSave" href="#" rel="tooltip" title="Salvar o filtro atual">Salvar filtro</a></li>
					<li><a class="taskListFilterSetDefault" href="#" rel="tooltip" title="Marcar o filtro atual como padrão do seu perfil">Default</a></li>
				</ul>
			  </div>

				<select class="filterID span11">
					<?php foreach ($taskFilters as $filter) { ?>
						<?php if($filter->default == 'true') $defaultFilter = '<option value='.$filter->filterID.'>'.$filter->filterTitle.'</option>'; ?>
					<?php } ?>

					<?php if($defaultFilter) echo $defaultFilter; else echo "<option value=''>Todas</option>"; ?>

					<?php foreach ($taskFilters as $filter) { ?>
						<?php if($filter->default != 'true') echo '<option value='.$filter->filterID.'>'.$filter->filterTitle.'</option>'; ?>
					<?php } ?>
				</select>
			</div>
		</div>

		<div class="span4 hide" id="createFilterForm">
			<div class="input-prepend">
				<span class="add-on">Filtro</span>
				<input type="text" class="filterName span10" placeholder="Informe o nome do novo filtro" />
			</div>
		</div>

		<div class="span4">
			<a class="taskFilterRefresh btn btn-info" href="#" rel="tooltip" title="Atualizar lista"><i class="icon-refresh icon-white"></i></a>
			<a class="taskListFilterReset btn btn-danger" href="#" rel="tooltip" title="Limpar filtro"><i class="icon-remove icon-white"></i></a>
		</div>
	</div>
	

	<div id="filter" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="Filtro" aria-hidden="true">
	</div>

	<div class="box taskList">
		
	</div><!--/box -->

</div><!--/span10-->

<script src="<?=base_url()?>assets/js/task/list.js"></script>