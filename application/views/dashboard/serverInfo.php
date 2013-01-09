<div class="span10">

	<h3>Server Info</h3>

	<table class="table table-condensed table-hover">
		<thead>
			<tr>
				<th>Info</th>
				<th>Value</th>
			</tr>
		</thead>
		<tbody>

			<?php foreach($serverInfo as $key => $cont) { ?>
				<?php if($key != "HTTP_COOKIE") { ?> 
					<tr>
						<td><small><?=$key?></small></td>
						<td><small><?=$cont?></small></td>
					</tr>
				<?php } ?>
			<?php	} ?>

		</tbody>
	</table>
</div>