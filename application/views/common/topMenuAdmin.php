<ul class="nav pull-right">
	<li class="dropdown">
		<a class="navBarConfigurationMenu" data-toggle="dropdown" href="#" rel="tooltip" title="Configurações de conta">
			<?=$this->session->userdata('userName')?>
			<i class="icon-chevron-down"></i>
		</a>
		<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">

			<li><a tabindex="-1"  href="#profile">Perfil</a></li>
			<li><a tabindex="-1"  href="#configuracoes">Configurações</a></li>
			<li class="divider"></li>
			<li><a tabindex="-1"  href="<?=base_url()?>logout">Logout</a></li>

		</ul>
	</li>
</ul>