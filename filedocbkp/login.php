<?php session_start();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logando...</title>
</head>

<body>
<?php 

include_once('conexao/conexao.php');

$email = $_POST['txt_email'];
//$senha = $_POST['txt_password'];
$senha = base64_encode($_POST['txt_password']);

//verificando os dados do usuario no banco de dados

$sql_verlogin = "SELECT id_usuario FROM usuario WHERE email_usuario = '$email' AND senha_usuario = '$senha'";
$qry_ver_login = mysql_query($sql_verlogin) or die("Erro ao selecionar dados do usuario".mysql_error());

$cont = mysql_num_rows($qry_ver_login);

if($cont < '1' or $cont > '1'){
	$meta = '<meta http-equiv="refresh" content="2;URL=index.php" />';
	
	echo $meta;
	
	echo 'Login ou senha errados!';
	
	}else{
	$pega_dados = "SELECT * FROM usuario WHERE email_usuario = '$email' AND senha_usuario = '$senha'";
	$query_pega_dados = mysql_query($pega_dados);
	$res = mysql_fetch_array($query_pega_dados);
	
	$id_usuario = $res['id_usuario'];
	$nome = $res['nome_usuario'];
	$email = $res['email_usuario'];
	$admin = $res['admin_usuario'];
	
		//deleta arquivos com data passou
		$data = date('Y-m-d');
		$select = "Select * FROM arquivos WHERE delete_file <= '$data'";
		$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
  		$cont = mysql_num_rows($qry);

	if($cont <= '0'){
		
	}else{
		while($res = mysql_fetch_array($qry)){
			$id_file = $res['id_file'];
			$nome_file = $res['nome_file'];
			//$tipo_file = $res['nome_tp'];
			$caminho_file = $res['caminho_file'];
			//$dataa = $res['data_file'];
			//$data_file = converteDataform($dataa);
			
			
		echo $id_del = $id_file;
		$pega_arquivo = "SELECT caminho_file, id_usuario_file FROM arquivos WHERE id_file = '$id_del'";
		$qry_arquivo = mysql_query($pega_arquivo);
		while($res_arquivo = mysql_fetch_array($qry_arquivo)){
			echo $arquivo_excluir = $res_arquivo['caminho_file'];
			$usuario_file = $res_arquivo['id_usuario_file'];
		    $pasta = 'admin/arquivos/'.$usuario_file;
			chdir($pasta);//ABRE A PASTA
			$del_arquivo = unlink("$arquivo_excluir");
		}
		
		$deletar = mysql_query("DELETE FROM arquivos WHERE id_file = '$id_del'");
		if($deletar){
			
		}else{
			
		}}}

	
	
	//criando as sessions do usuario
	$_SESSION['ID_USUARIO'] = $id_usuario;
	$_SESSION['NOME'] = $nome;
	$_SESSION['EMAIL'] = $email;	
	$_SESSION['LOG_SUCESSO'] = "true";	
	
	if($admin == 'S'){
	
	$meta = '<meta http-equiv="refresh" content="0;URL=admin/index.php" />';
	
	}else{
	$meta = '<meta http-equiv="refresh" content="0;URL=arquivos_cliente.php" />';
	
	}
	//echo $meta;
	}
?>
</body>
</html>