<div class="row-fluid">
  <div class="span8 offset2 hero-unit">
    <div class="row-fluid">
      <div class="span2">
        <p><i class="icon-ban-circle icon-4x center"></i></p>
      </div>
      <div class="span10">
        <p>Você não tem permissão para acessar este recurso.</p>
        <p class="text-error"><?=$this->session->flashdata('methodName')?></p>
        <p><a href="#" class="btn btn-block btn-large btn-primary requestPermission" value="<?=$_SERVER['HTTP_REFERER']?>">Solicitar permissão</a></p>
      </div>
    </div>    
  </div>
</div>