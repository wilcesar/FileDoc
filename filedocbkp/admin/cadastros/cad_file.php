<?php
$porcento = 0;
	$id_usuario = $_SESSION['ID_USUARIO'];
	if(isset($_POST['enviar'])){
	
		$porcento = 40;
		
		$data = date('ymdhis');
		$usuario_arquivo = $_POST['usuario_arquivo'];
		$tipo_arquivo = $_POST['tipo_arquivo'];
		$nome_arquivo = $_POST['nome_arquivo'];
		
		$dataa = $_POST['data_arquivo'];
		$data_arquivo= converteData($dataa);
		
		$dataa = $_POST['data_delete_arquivo'];
		$data_delete_arquivo = converteData($dataa);
		 	
				$dir = './arquivos/'.$usuario_arquivo.'/';
				
				if(!is_dir($dir)) { 
				mkdir('./arquivos/'.$usuario_arquivo);
				}
				
				$tmpName = $_FILES['file_arquivo']['tmp_name'];
				$name_file = $_FILES['file_arquivo']['name'];
				$name_file_dir= $dir.$data.$name_file;
				$name_file_adir= $data.$name_file;
				$porcento = 70;
				if(move_uploaded_file($tmpName, $name_file_dir)){
									
						
		$insert = "INSERT INTO arquivos(id_usuario_file,tipo_file, nome_file, caminho_file, data_file, delete_file) 
					VALUES ($usuario_arquivo,'$tipo_arquivo','$nome_arquivo','$name_file_adir','$data_arquivo', '$data_delete_arquivo')";
		
		$inserido = mysql_query($insert).mysql_error(); 
		$porcento = 100;
		?>

<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 
		} else{
		?>
<div class="alert alert-error">Erro ao cadastrar</div>
<?php
		echo("erro:").mysql_error(); 
		} 
		
	}

?>
<div class="progress progress-striped active">
  <div class="bar" style="width:<?php echo $porcento ?>%;"></div>
</div>
<form id="cad_arquivo" name="cad_arquivo" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    <legend>Cadastr de Arquivos</legend>
    <label for="">Usuário</label>
    <select id="usuario_arquivo" name="usuario_arquivo">
      <option selected>Selecione...</option>
      <?php 
             $query = mysql_query("SELECT * FROM usuario WHERE admin_usuario <>'S'");
             while($user = mysql_fetch_array($query)) { ?>
      <option value="<?php echo $user['id_usuario'] ?>"><?php echo $user['nome_usuario'] ?></option>
      <?php } ?>
    </select>
    <label>Tipo</label>
    <select id="tipo_arquivo" name="tipo_arquivo">
      <option selected>Selecione...</option>
      <?php 
             $query = mysql_query("SELECT * FROM tipos_arquivo");
             while($tipos = mysql_fetch_array($query)) { ?>
      <option value="<?php echo $tipos['id_tp'] ?>"><?php echo $tipos['nome_tp'] ?></option>
      <?php } ?>
    </select>
    <label>Nome</label>
    <input type="text" id="nome_arquivo" name="nome_arquivo" placeholder="Digite o nome do arquivo...">
    <label>Arquivo</label>
    <input type="file" id="file_arquivo" name="file_arquivo">
    <label>Data de vencimento</label>
    <input type="text" id="data_arquivo" name="data_arquivo" class="date">
    <label>Data Exclusão</label>
    <input type="text" id="data_delete_arquivo" name="data_delete_arquivo" class="date" />
    <br/>
    <button type="submit" id="enviar" name="enviar" class="btn">Gravar</button>
  </fieldset>
</form>
