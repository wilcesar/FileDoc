<?php

if(isset($_POST['deletar'])){
	$id_del = $_POST['id_del'];
			$pega_arquivo = "SELECT caminho_file, id_usuario_file FROM arquivos WHERE id_file = '$id_del'";
			$qry_arquivo = mysql_query($pega_arquivo);
			while($res_arquivo = mysql_fetch_array($qry_arquivo)){
				$arquivo_excluir = $res_arquivo['caminho_file'];
				$usuario_file = $res_arquivo['id_usuario_file'];
				$pasta = 'arquivos/'.$usuario_file;
				chdir($pasta);//ABRE A PASTA
				$del_arquivo = unlink("$arquivo_excluir");
			}
			
	$deletar = mysql_query("DELETE FROM arquivos WHERE id_file = '$id_del'");
	if($deletar){
		?>
<div class="alert alert-success">Excluido com sucesso</div>
<?php 	
	}else{
	?>
<div class="alert alert-error">Falha ao excluir</div>
<?php	
	}
}//fecha if do ISSET
 
$nome_file = '';
$tipo_file = '';
$caminho_file = '';
$data_file = '';
$id_user='';

	if(isset($_POST['filtrar'])){
		$id_user = $_POST['usuario_arquivo'];		
	}

?>
<a  class="btn btn-primary btn-lg" href="index.php?pgf=cadastros/cad_file">NOVO</a>
<form id="list_arquivo" name="list_arquivo" class="form-horizontal" method="post" enctype="multipart/form-data" action="">
  <fieldset>
    
    <select id="usuario_arquivo" name="usuario_arquivo">
      <option selected>Selecione o usuario...</option>
      <?php 
             $query = mysql_query("SELECT * FROM usuario WHERE admin_usuario <>'S'");
             while($user = mysql_fetch_array($query)) { ?>
      <option value="<?php echo $user['id_usuario'] ?>"><?php echo $user['nome_usuario'] ?></option>
      <?php } ?>
      </select>
      
      <button type="submit" id="filtrar" name="filtrar" class="btn">Filtrar</button>
      
      </fieldset>
</form>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>TIPO</th>
      <th>NOME</th>      
      <th>DATA VENCIMENTO</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 

$select="SELECT id_file, id_usuario_file, nome_file, tipo_file, caminho_file, data_file, id_tp, nome_tp, id_usuario, nome_usuario 
FROM arquivos inner join tipos_arquivo  inner join usuario 
on id_usuario_file = id_usuario and tipo_file = id_tp
 WHERE id_usuario_file = '$id_user' order by data_file";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
  $cont = mysql_num_rows($qry);

	if($cont <= '0'){
		
	}else{
		while($res = mysql_fetch_array($qry)){
			$id_file = $res['id_file'];
			$nome_file = $res['nome_file'];
			$tipo_file = $res['nome_tp'];
			$caminho_file = $res['caminho_file'];
			$dataa = $res['data_file'];
			$data_file = converteDataform($dataa);
			
?>
    <tr>
      <td><?php echo $tipo_file?></td>
      <td><?php echo $nome_file?></td>
      <td><?php echo $data_file?></td>
      <td align="center" ><a class="btn btn-primary btn-lg" href="index.php?pgf=edicao/edit_file&id=<?php echo $id_file?>">Editar</a></td>
      <td align="center" >
      <form name="form_del" id="form_del" method="post" action="">
          <input type="hidden" id="id_del" name="id_del" value="<?php echo $id_file; ?>"/>
          <input type="submit" class="btn btn-danger" name="deletar" id="deletar" value="Excluir" onclick="return excluir_registro()" />
          </form>
    </tr>
    <?php
		}
	}
?>
  </tbody>
</table>
