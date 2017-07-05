<?php

	if(isset($_POST['enviar'])){
		$nome_tp = $_POST['nome_tp'];
		
		$insert = "INSERT INTO tipos_arquivo(nome_tp) VALUE('$nome_tp')";
		
		$inserido = mysql_query($insert).mysql_error();
		?>
<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 
		}
	
		
	

?>
<form id="cad_tp" name="cad_tp" method="post" class="form-horizontal" action="">
  <fieldset>
    <legend>Cadastro de Tipo de Arquivo</legend>
    <label>Nome</label>
    <input type="text" id="nome_usuario" name="nome_tp"  required placeholder="Digite o nome do tipo do arquivo...">
    <br/>
    <button type="reset" name="enviar" class="btn">Limpar</button>
    <button type="submit" id="enviar" name="enviar" class="btn btn-primary" class="btn">Gravar</button>
  </fieldset>
</form>
