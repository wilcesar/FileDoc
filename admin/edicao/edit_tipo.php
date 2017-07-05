<?php
$id = $_GET['id'];
$admin_up='';
$select="SELECT *FROM tipos_arquivo WHERE id_tp='$id'";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
while($res = mysql_fetch_array($qry)){
	
	$id_tp = $res['id_tp'];
	$nome_tp = $res['nome_tp'];
}

if(isset($_POST['atualizar'])){
	
	$nome_tp_up = $_POST['nome_tp'];
	
	$update = "UPDATE tipos_arquivo SET nome_tp='$nome_tp_up' WHERE id_tp = '$id'";
	
	
	$atualizar = mysql_query($update).mysql_error();
	?>
<div class="alert alert-success">Inserido com Sucesso!</div>
<?php 

	$meta = '<meta http-equiv="refresh" content="2;URL=index.php?pgf=listar/list_tipo" />';	
	//echo $meta;	
	}else{
		
	}


?>
<form id="edit_usuario" name="edit_usuario" method="post" action="">
  <fieldset>
    <legend>Edição Tipo</legend>
    <label>Nome</label>
    <input type="text" id="nome_tp" name="nome_tp" value="<?php echo $nome_tp?>" >
    <br/>
    <button type="submit" id="atualizar" name="atualizar" class="btn">Atualizar</button>
  </fieldset>
</form>
