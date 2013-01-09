<ul class="nav">

	<li <?php if($this->router->class == 'dashboard'){ echo 'class="active"';}?> ><a href="<?=base_url()?>dashboard">Dash</a></li>
</ul>

<ul class="nav">
	<li <?php if($this->router->class == 'git'){ echo 'class="active"';}?> ><a href="<?=base_url()?>git">Git</a></li>

</ul>

<ul class="nav">
	<li class="dropdown <?php if($this->router->class == 'task'){ echo 'active';}?>">
		<a class="navBarTaskMenu" data-toggle="dropdown" href="#">Task <i class="icon-chevron-down"></i></a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
			<li><a tabindex="-1" href="#" class="newTaskButton">Nova Tarefa</a></li>
			<li><a tabindex="-1" href="#" class="newProjectButton">Novo Projeto</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1" href="<?=base_url()?>task" target="blank">Listar Tarefas</a></li>
		</ul>
	</li>


</ul>