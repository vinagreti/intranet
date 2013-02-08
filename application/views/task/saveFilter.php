<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Salvar o filtro atual</h3>
</div>

<div class="modal-body">

<form class="form-vertical">
	<label for="filterTitle" class="control-label">Nome do novo filtro *</label>
	<input rows="5" class="filterTitle input-block-level" placeholder="Comentário" name="filterTitle" />

	<label class="checkbox inline">
	  <input id="filterDefault" value="true" type="checkbox">Default
	</label>
</form>

</div>

<div class="modal-footer">
<a href="#" class="btn btn-primary saveFilter">Salvar</a>
<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>

<script src="<?=base_url()?>assets/js/task/saveFilter.js"></script>