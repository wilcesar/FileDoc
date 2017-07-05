<?php

	if(isset($_POST['enviar'])){
		$nome_usuario = $_POST['nome_usuario'];
		$email_usuario = $_POST['email_usuario'];
		$senha_usuario = $_POST['senha_usuario'];
		$senha_usuario2 = $_POST['senha_usuario2'];
		
		$dataa = $_POST['dtnasc_usuario'];
		$dtnasc_usuario = converteData($dataa);
		
		if(!empty($_POST['admin'])){
			$admin=$_POST['admin'];
		}else{
			$admin ='';
		}
		
		if($senha_usuario==$senha_usuario2){
		$senha_usuario = base64_encode($senha_usuario2);
		
		$insert = "INSERT INTO usuario(nome_usuario, email_usuario, senha_usuario, dtnasc_usuario, admin_usuario) VALUES		                    ('$nome_usuario','$email_usuario','$senha_usuario', '$dtnasc_usuario', '$admin')";
		
		$inserido = mysql_query($insert).mysql_error();
		?>
<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 
		} else{
		?>
<div class="alert alert-error">As senhas não conferem!</div>
<?php 
		}
	}else{
		
	}

?>
<form id="cad_usuario" name="cad_usuario" method="post" class="form-horizontal" action="">
  <fieldset>
    <legend>Cadastro de Usuário</legend>
    <label>Nome</label>
    <input type="text" id="nome_usuario" name="nome_usuario" placeholder="Digite o nome do usuário...">
    <label>E-mail</label>
    <input type="email" id="email_usuario" name="email_usuario" placeholder="Digite o email do usuário...">
    <label>Data Nascimento</label>
    <input type="text" id="date" name="dtnasc_usuario" placeholder="Digite a data de aniversário...">
    <label>Senha</label>
    <input type="password" id="senha_usuario" name="senha_usuario" placeholder="Digite a senha...">
    <input type="password" id="senha_usuario2" name="senha_usuario2" placeholder="Confirme a senha...">
    <br/>
    <div class="checkbox">
    <label>
    <input type="checkbox" id="admin" name="admin" value="S" >Administrador
    </label>
    <br/>
    <button type="reset" name="enviar" class="btn">Limpar</button>
    <button type="submit" id="enviar" name="enviar" class="btn btn-primary" class="btn">Gravar</button>
  </fieldset>
</form>
