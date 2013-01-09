<div class="span10" id="content">

	<h3><span class="break"></span>Repositórios</h3>

	<div class="box">

		<div class="box-content">
			<table class="table table-striped table-condensed">
				<thead>
					<tr>
						<th><small>Repository</small></th>
						<th><small>Branch</small></th>
						<th><small>Remote Address</small></th>
						<th><small>Actions</small></th>
					</tr>
				</thead>

				<tbody>
					<?php foreach($repos as $repo){ ?>
					<tr>
						<td class="span3"><small><?=$repo['name']?></small></td>
						<td class="span2"><small><?=$repo['branch']?></small></td>
						<td class="span6"><small><?=$repo['remote']?></small></td>
						<td class="center">
							<a class="btn btn-info btn-small" href="<?=base_url()?>git/log/<?=$repo['name']?>">
								<i class="icon-search icon-white"></i>  
							</a>
							<a class="btn btn-success btn-small" href="<?=base_url()?>git/pull/<?=$repo['name']?>/<?=$repo['branch']?>">
								<i class="icon-ok icon-white"></i> 
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>            
		</div>
	</div><!--/box-->
</div>


