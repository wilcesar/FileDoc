<?php 
if(isset($_POST['deletar'])){
	$id_del = $_POST['id_del'];
	 
	$deletar = mysql_query("DELETE FROM usuario WHERE id_usuario = '$id_del'");
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
?>
<a class="btn btn-primary btn-lg" href="index.php?pgf=cadastros/cad_usuario">NOVO</a>
<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>#</th>
      <th>NOME</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 

$select="SELECT * FROM usuario WHERE nome_usuario <> 'administrador'";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
  $cont = mysql_num_rows($qry);

	if($cont <= '0'){
		
		echo 'nenhum dado encontrado';

		
	}else{
		while($res = mysql_fetch_array($qry)){
			$id_usuario = $res['id_usuario'];
			$nome_usuario = $res['nome_usuario'];
			
		

?>
    <tr>
      <td><?php echo $id_usuario?></td>
      <td><?php echo $nome_usuario?></td>
      <td align="center"><a class="btn btn-primary" href="index.php?pgf=edicao/edit_usuario&id=<?php echo $id_usuario?>">Editar</a></td>
      <td align="center"><form name="form_del" id="form_del" method="post" action="">
          <input type="hidden" id="id_del" name="id_del" value="<?php echo $id_usuario; ?>"/>
          <input type="submit" class="btn btn-danger" name="deletar" id="deletar" value="Excluir" onclick="return excluir_registro()" />
        </form></td>
    </tr>
    <?php
		}
	}
?>
  </tbody>
</table>
