<div class="row-fluid">
  <div class="span4 offset4 well">
    <form class="form-horizontal form-signin">
      <h4 class="form-signin-heading">Por favor, identifique-se</h4>
      <p><input type="text" class="input-block-level" placeholder="Email" id="email" name="email"></p>
      <p><input type="password" class="input-block-level" placeholder="Senha" id="password" name="password"></p>
      <p><a class="btn btn-large btn-primary btn-block" id="submitLogin">Entrar</a></p>
    </form>
  </div>
</div> <!-- /container -->

<script type="text/javascript">
  $(document).ready(function(){
    $("#submitLogin").live("click", function() {
      $.post("<?=base_url()?>user/submitLogin", {
        email : $("#email").val(),
        password : $("#password").val()
      }, function( e ) {
        if( e ) {
          http_referer = window.location = "<?=$this->session->flashdata('HTTP_REFERER')?>";
          if (http_referer) window.location = "<?=base_url()?>" + http_referer;
          else window.location = "<?=base_url()?>task";
        }
      }, "json");
    });
  });
</script>
</body>
</html>
