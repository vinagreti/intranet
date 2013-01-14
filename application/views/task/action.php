<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3><?=$action?> a tarefa <?=$taskID?></h3>
</div>

<div class="modal-body">

<div class="alert alert-error hide">
  <strong>Erro!</strong> Favor comentar sua ação.
</div>

<form class="form-vertical">
	<label for="newComment" class="control-label">Comente a ação *</label>
	<textarea rows="5" class="input-block-level" placeholder="Comentário" id="actionComment" name="actionComment"></textarea>
</form>

</div>

<div class="modal-footer">
<a href="#" class="btn btn-primary" id="saveAction">Salvar</a>
<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>