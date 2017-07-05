<div class="page-header">
  <h3>Aniversariantes do Mês</h3>
</div>

<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>NOME</th>
      <th>Data</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php 

$select="SELECT id_usuario,nome_usuario,dtnasc_usuario FROM usuario WHERE MONTH(dtnasc_usuario) = MONTH(CURDATE( ))";

$qry = mysql_query($select) or die("Erro ao selecionar dados!".mysql_error());
  $cont = mysql_num_rows($qry);

	if($cont <= '0'){
		
		//echo 'nenhum dado encontrado';

		
	}else{
		while($res = mysql_fetch_array($qry)){
			$id_usuario = $res['id_usuario'];
			$nome_usuario = $res['nome_usuario'];
			$data = $res['dtnasc_usuario'];
			$dtnasc_usuario = date('d/m/Y',strtotime($data));
			$dtnasc_usuario_dia = date('d',strtotime($data));
			$atual=date('d');
?>
	<?php if($dtnasc_usuario_dia == $atual){?>
    <tr class="info">
      <td ><?php echo $nome_usuario?></td>
      <td ><?php echo $dtnasc_usuario?></td>
      <td  align="center"><a class="btn btn-info" href="index.php?pgf=aniversario/manda_mensagem&id=<?php echo $id_usuario?>">Enviar Mensagem</a></td></tr>
      
	<?php }elseif($dtnasc_usuario_dia > $atual){?>
    <tr >
    <td ><?php echo $id_usuario?></td>
      <td ><?php echo $nome_usuario?></td>
      <td ><?php echo $dtnasc_usuario?></td>
      <td align="center"><a class="btn btn-success" href="index.php?pgf=aniversario/manda_mensagem&id=<?php echo $id_usuario?>">Enviar Mensagem</a></td>
    </tr>
	<?php }else{?>
    <tr >
    <td ><?php echo $id_usuario?></td>
      <td ><?php echo $nome_usuario?></td>
      <td ><?php echo $dtnasc_usuario?></td>
      <td align="center"><a class="btn btn-danger" href="index.php?pgf=aniversario/manda_mensagem&id=<?php echo $id_usuario?>">Enviar Mensagem</a></td>
    </tr>
    
    
	<?php }
		}
	}
?>
  </tbody>
</table>
