<h3>Git log</h3>

<?php foreach($history as $item_array){ ?>
<div class="row-fluid sortable ui-sortable">
	<div class="box span12" style="">
		<div class="box-header">
			<p><i class="icon-time"></i><span class="break"></span><?=$item_array['date']?></p>
		</div>
		<div class="box-content">
			<ul>
				<li><?='Hash = ' . $item_array['hash']?></li>
				<li><?='Author = ' . $item_array['author']?></li>
				<li><?='Message = ' . $item_array['message']?></li>
			</ul>
		</div>
	</div><!--/span-->
</div>
<hr>
<?php } ?>
