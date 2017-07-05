<?php
$id = $_GET['id'];
$admin_up='';
$select="SELECT *FROM usuario WHERE id_usuario='$id'";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
while($res = mysql_fetch_array($qry)){
	
	$id_usuario = $res['id_usuario'];
	$nome_usuario = $res['nome_usuario'];
	$email_usuario = $res['email_usuario'];
	$dataa = $res['dtnasc_usuario'];
	$dt_nasc_usuario = converteDataform($dataa);
	$admin = $res['admin_usuario'];
}

if(isset($_POST['atualizar'])){
	
	$nome_usuario_up = $_POST['nome_usuario'];
	$email_usuario_up = $_POST['email_usuario'];
	$senha_usuario_up = $_POST['senha_usuario'];
	$senha_usuario2_up = $_POST['senha_usuario2'];
	$dataa = $_POST['dtnasc_usuario'];
	$dtnasc_usuario_up = converteData($dataa);
	 if(isset($_POST['admin'])){
		 $admin_up='S';
		 }
	
	if($senha_usuario_up == $senha_usuario2_up){
			
		if($senha_usuario_up == ''){
			
		$update = "UPDATE usuario SET nome_usuario='$nome_usuario_up', email_usuario='$email_usuario_up',dtnasc_usuario='$dtnasc_usuario_up' WHERE id_usuario='$id', admin_usuario = '$admin_up'";
			
		}else{
			
		$senha_usuario_up = base64_encode($senha_usuario2_up);
		$update = "UPDATE usuario SET nome_usuario='$nome_usuario_up', email_usuario='$email_usuario_up',dtnasc_usuario='$dtnasc_usuario_up',senha_usuario='$senha_usuario_up' WHERE id_usuario='$id'";
		
		}
	
	$atualizar = mysql_query($update).mysql_error();
	?>
<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 

	$meta = '<meta http-equiv="refresh" content="2;URL=index.php?pgf=listar/list_usuario" />';	
	//echo $meta;	
	}else{
		?>

<div class="alert alert-error">As senhas não conferem!</div>
<?php 
	}
}

?>
<form id="edit_usuario" name="edit_usuario" method="post" action="">
  <fieldset>
    <legend>Cadastro de Usuário</legend>
    <label>Nome</label>
    <input type="text" id="nome_usuario" name="nome_usuario" value="<?php echo $nome_usuario?>" >
    <label>E-mail</label>
    <input type="text" id="email_usuario" name="email_usuario" value="<?php echo $email_usuario?>">
    <label>Data Nascimento</label>
    <input type="text" id="date" name="dtnasc_usuario" value="<?php echo $dt_nasc_usuario?>">
    <label>Senha</label>
    <input type="password" id="senha_usuario" name="senha_usuario" >
    <input type="password" id="senha_usuario2" name="senha_usuario2">
    <br/>
    
    <?php if($admin ==''){
	?><input type="checkbox" id="admin" name="admin" >Administrador<?php 
	}else{
	?><input type="checkbox" id="admin" name="admin" checked="checked">Administrador<?php
	}
	?>
    <br/>
    <button type="submit" id="atualizar" name="atualizar" class="btn">Atualizar</button>
  </fieldset>
</form>
