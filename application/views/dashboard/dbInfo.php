<div class="row-fluid">
	<div class="span12 well">
		<h4>Dados gerais</h4>
		<div class="row-fluid">
			<div class="span4">
				<p><span class="text-warning">Número de usuários: </span><?=$resume->user?></p>
				<p><span class="text-warning">Número de produtos: </span><?=$resume->product?></p>
				<p><span class="text-warning">Número de fornecedores: </span><?=$resume->supplier?></p>
			</div>
			<div class="span4">
				<p><span class="text-warning">Número de emails: </span><?=$resume->mail?></p>
				<p><span class="text-warning">Número de emails enviados: </span><?=$resume->sentMail?></p>
				<p><span class="text-warning">Número de emails na fila: </span><?=$resume->queueMail?></p>
			</div>
			<div class="span4">
				<p><span class="text-warning">Número de cotações: </span><?=$resume->currency?></p>
				<p><span class="text-warning">Número de orçamentos: </span><?=$resume->budget?></p>
				<p><span class="text-warning">Número de sessões: </span><?=$resume->session?></p>
			</div>
		</div>
	</div>
</div>

<div class="row-fluid">
	<div class="span12 well">
		<h4>Usuários</h4>

	<table class="table table-hover table-condensed tablesorter">
		<thead>
			<tr>
				<th class="span1"></th>
				<th class="span1">id</th>
				<th class="span2">Nome</th>
				<th class="span2">Email</th>
				<th class="span2">Identidade</th>
				<th class="span2">Tipo de uauário</th>
				<th class="span1">Data</th>
			</tr>
		</thead>
		<tbody class="listBody">
			<?php foreach($users as $user) { ?>
			<tr>
				<td class="span1"><img src="<?=$user["img"]?>" style="width:40px;"></td>
				<td class="span1"><?=$user["_id"]?></td>
				<td class="span2"><?=$user["name"]?></td>
				<td class="span2"><?=$user["email"]?></td>
				<td class="span2"><a href="http://<?=$user['identity']?>.tzadi.com"><?=$user["identity"]?></a></td>
				<td class="span2"><?=$user["kind"]?></td>
				<td class="span1"><?=date("d/m/Y H:i", $user["register"])?></td>
			</tr>
			<?php } ?>
		</tbody>
	</table>

	</div>
</div>