<?php
$id = $_GET['id'];

$select="SELECT id_file, caminho_file, id_usuario_file, nome_file, tipo_file, data_file,delete_file, id_tp, nome_tp, id_usuario, nome_usuario 
FROM arquivos inner join tipos_arquivo  inner join usuario 
on id_usuario_file = id_usuario and tipo_file = id_tp 
WHERE id_file='$id'";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
while($res = mysql_fetch_array($qry)){
	
	$id_usuario = $res['id_usuario_file'];
	$nome_usuario = $res['nome_usuario'];
	$id_file = $res['id_file'];	
	$nome_file = $res['nome_file'];
	$tipo_file = $res['tipo_file'];
	$nome_tp_file = $res['nome_tp'];
	$caminho_file = $res['caminho_file'];
	
	$dataa = $res['data_file'];
	$data_file = converteDataform($dataa);
	
	$dataa = $res['delete_file'];
	$data_delete = converteDataform($dataa);
}

if(isset($_POST['atualizar'])){
	
	$data = date('ymdhis');
		$usuario_arquivo_up = $_POST['usuario_arquivo'];
		$tipo_arquivo_up = $_POST['tipo_arquivo'];
		$nome_arquivo_up = $_POST['nome_arquivo'];
		$dataa = $_POST['data_arquivo'];
		$data_arquivo_up =converteData($dataa); 
		
		/*if(empty($_FILES['file_arquivo']['name'])!=='1'){
				$dir = './arquivos/'.$id_usuario.'/';
				
				if(!is_dir($dir)) { 
				mkdir('./arquivos/'.$id_usuario);
				}
				
				$tmpName = $_FILES['file_arquivo']['tmp_name'];
				$name_file = $_FILES['file_arquivo']['name'];
				$name_file_dir= $dir.$data.$name_file;
				$name_file_adir= $data.$name_file;
				unlink('./arquivos/'.$id_usuario.'/'.$caminho_file);//deleta arquivo da pasta
				if(move_uploaded_file($tmpName, $name_file_dir)){
			
		echo $update = "UPDATE arquivos SET id_usuario_file ='$usuario_arquivo_up', nome_file ='$nome_arquivo_up',tipo_file = '$tipo_arquivo_up', data_file ='$data_arquivo_up', caminho_file = '$name_file_adir' WHERE id_file = '$id'";
				}	
			
		}else{*/
			 $update = "UPDATE arquivos SET id_usuario_file ='$usuario_arquivo_up', nome_file ='$nome_arquivo_up',tipo_file = '$tipo_arquivo_up', data_file ='$data_arquivo_up' WHERE id_file = '$id'";
			
		
		//}
	
	$atualizar = mysql_query($update).mysql_error();
	?>
<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 

	$meta = '<meta http-equiv="refresh" content="2;URL=index.php?pgf=listar/list_usuario" />';	
	//echo $meta;	
}

?>
<form id="edit_arquivo" name="edit_arquivo" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    
    <label for="">Usuário</label>
    <select id="usuario_arquivo" name="usuario_arquivo">
      <option value="<?php echo $id_usuario ?>"><?php echo $nome_usuario ?></option>
      <?php 
             $query = mysql_query("SELECT * FROM usuario WHERE admin_usuario <>'S'");
             while($user = mysql_fetch_array($query)) { ?>
      <option value="<?php echo $user['id_usuario'] ?>"><?php echo $user['nome_usuario'] ?></option>
      <?php } ?>
    </select>
    
    <label>Tipo</label>
    
    <select id="tipo_arquivo" name="tipo_arquivo">
      <option value="<?php echo $tipo_file ?>"><?php echo $nome_tp_file ?></option>
      <?php 
             $query = mysql_query("SELECT * FROM tipos_arquivo");
             while($tipos = mysql_fetch_array($query)) { ?>       
      <option value="<?php echo $tipos['id_tp'] ?>"><?php echo $tipos['nome_tp'] ?></option>
      <?php } ?>
    </select>
    
    <label>Nome</label>
    <input type="text" id="nome_arquivo" name="nome_arquivo" value="<?php echo $nome_file?>">
    
    <label>Data vencimento</label>
    <input type="text" class="date" name="data_arquivo"  value="<?php echo $data_file?>"/>
    
    <label>Data Exclusão</label>
    <input type="text" class="date" name="data_delete"  value="<?php echo $data_delete?>"/>
    
    <br/>
    <button type="submit" id="atualizar" name="atualizar" class="btn">Atualizar</button>
  </fieldset>
</form>

