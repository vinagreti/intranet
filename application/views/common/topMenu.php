<ul class="nav">
	<li <?php if($this->router->class == 'dashboard'){ echo 'class="active"';}?> >
		<a href="<?=base_url()?>dashboard" rel="tooltip" title="Dashboard">Dash</a>
	</li>
</ul>
<ul class="nav">
	<li <?php if($this->router->class == 'git'){ echo 'class="active"';}?> >
		<a href="<?=base_url()?>git" rel="tooltip" title="Git features">Git</a>
	</li>
</ul>
<ul class="nav">
	<li <?php if($this->router->class == 'gp'){ echo 'class="active"';}?> >
		<a href="<?=base_url()?>gp" rel="tooltip" title="Boas práticas">GP</a>
	</li>
</ul>
<ul class="nav">
	<li class="dropdown <?php if($this->router->class == 'task'){ echo 'active';}?>">
		<a class="navBarTaskMenu" data-toggle="dropdown" href="#" rel="tooltip" title="Tarefas">
			Task <i class="icon-chevron-down"></i>
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li><a tabindex="-1" href="#" class="newTaskButton">Nova Tarefa</a></li>
			<li><a tabindex="-1" href="#" class="newProjectButton">Novo Projeto</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1" href="<?=base_url()?>task">Listar Tarefas</a></li>
		</ul>
	</li>
</ul>