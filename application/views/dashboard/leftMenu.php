<div class="span2">

	<h4>Menu</h4>

	    <ul class="nav nav-pills nav-stacked">
				<li <?php if($this->router->method =="index") echo 'class="active"'; ?>><a href="<?=base_url()?>dashboard"><i class="icon-home"></i><span class="hidden-tablet"> Inicio</span></a></li>
				<li <?php if($this->router->method =="serverInfo") echo 'class="active"'; ?>><a href="<?=base_url()?>dashboard/serverInfo"><i class="icon-info-sign"></i><span class="hidden-tablet"> Server Info</span></a></li>
				<li <?php if($this->router->method =="phpInfo") echo 'class="active"'; ?>><a href="<?=base_url()?>dashboard/phpInfo"><i class="icon-info-sign"></i><span class="hidden-tablet"> PHP Info</span></a></li>
				<li <?php if($this->router->method =="gitInfo") echo 'class="active"'; ?>><a href="<?=base_url()?>dashboard/gitInfo"><i class="icon-info-sign"></i><span class="hidden-tablet"> Git Info</span></a></li>
				<li <?php if($this->router->method =="mysqlInfo") echo 'class="active"'; ?>><a href="<?=base_url()?>dashboard/mysqlInfo"><i class="icon-info-sign"></i><span class="hidden-tablet"> MySQL Info</span></a></li>

			</ul>

</div>