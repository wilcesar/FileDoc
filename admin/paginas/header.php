<?php session_start();
include_once("../conexao/conexao.php");

if($_SESSION['LOG_SUCESSO'] != 'true'){
echo 'Voce não tem permição para acessar esta página!';
session_unset();
$meta = '<meta http-equiv="refresh" content="0;URL=../index.php" />';
echo $meta;
}
$usuario = $_SESSION['ID_USUARIO']; 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Adi Contabilidade</title>
<link href="../css/bootstrap.min.css" rel="stylesheet" media="screen">
<link type="text/css" href="../css/custom-theme/jquery-ui-1.8.20.custom.css" rel="stylesheet" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="../css/bootstrap-responsive.css" rel="stylesheet">

<!--<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="../js/jquery-ui-1.8.20.custom.min.js"></script>-->
<script type="text/javascript" src="../js/jquery-1.10.2.js"></script>
<script type="text/javascript" src="../js/jquery.maskedinput.js"></script>

<script type="text/javascript">
jQuery(function($){
   $("#date").mask("99/99/9999");
   $(".date").mask("99/99/9999");
   $("#phone").mask("(99) 9999-9999");
});

</script>
<?php 
function converteData($dataa) {
	if (strstr($dataa, "/")) {
		  $data_array = explode ("/", $dataa);
		  return $data_array[2] . "-". $data_array[1] . "-" . $data_array[0];
	} else {
		return null;
	}
}
function converteDataform($dataa) {
	if (strstr($dataa, "-")) {
		  $data_array = explode ("-", $dataa);
		  return $data_array[2]."/".$data_array[1]."/".$data_array[0];
	} else {
		return null;
	}
}
?>
</head>

<body>
<script src="http://code.jquery.com/jquery-latest.js"></script>
<script src="../js/bootstrap.min.js"></script><strong></strong>


<div id="cabecalho">
<div class="navbar navbar-inverse">
  <div class="navbar-inner">
    <div class="container">
 
      <!-- .btn-navbar é usado como alternador para conteúdo de barra de navegação colapsável -->
      <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
 
      <!-- Tenha certeza de deixar a marca se você quer que ela seja mostrada -->
      <a class="brand" href="index.php?pgf=paginas/home">Adi Contabilidade</a>
 
      <!-- Tudo que você queira escondido em 940px ou menos, coloque aqui -->
      <div class="nav-collapse collapse">
        <ul class="nav">
            <li class="active"><a href="index.php?pgf=paginas/home">Início</a></li>            
            <li><a href="index.php?pgf=listar/list_usuario">Usuários</a></li>
            <li><a href="index.php?pgf=listar/list_file">Arquivos</a></li>
            <li><a href="index.php?pgf=listar/list_tipo">Tipos Arq.</a></li>
            <li><a href="index.php?pgf=aniversario/list_aniversario">Aniversário</a></li>
            <li><a style="color:#F00" href="index.php?pgf=paginas/logoff">SAIR</a></li>
		</ul>
      </div>
 
    </div>
  </div>
</div>
</div><!--div cabecalho-->


<div class="span10">