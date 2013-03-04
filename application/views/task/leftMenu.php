<div class="span2">
	<h4>Tarefas</h4>
	<ul class="nav nav-pills nav-stacked">
		<li <?php if($this->router->method == "index") echo('class="active"');?>>
			<a href="<?=base_url()?>task"><i class="icon-home icon-white"></i> Tarefas</a>
		</li>
	
		<li <?php if($this->router->method == "userActivities") echo('class="active"');?>>
			<a href="<?=base_url()?>task/userActivities"><i class="icon-home icon-white"></i> Histórico</a>
		</li>
	</ul>
</div>