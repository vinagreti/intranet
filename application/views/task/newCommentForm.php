<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
<h3>Comentár a tarefa <?=$taskID?></h3>
</div>

<div class="modal-body">

<form class="form-vertical">
	<label for="newComment" class="control-label">Comentário *</label>
	<textarea rows="5" taskID="<?=$taskID?>" class="input-block-level" placeholder="Comentário" id="newComment" name="newComment"></textarea>
</form>

</div>

<div class="modal-footer">
<a href="#" class="btn btn-primary" id="saveNewComment">Salvar</a>
<a href="#" class="btn" data-dismiss="modal">Fechar</a>
</div>