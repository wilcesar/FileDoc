<?php session_start();

include_once("conexao/conexao.php");

if ($_SESSION['LOG_SUCESSO'] != 'true') {
  echo 'Voce não tem permição para acessar esta página!';
  session_unset();
  $meta = '<meta http-equiv="refresh" content="0;URL=index.php" />';
  echo $meta;
}
$usuario = $_SESSION['ID_USUARIO'];

if (isset($_POST['down'])) {
  $id_down = $_POST['id_down'];

  $sql = "SELECT * FROM arquivos WHERE id_file = '$id_down'";
  $query = mysql_query($sql) or die("Erro ao selecionar dados!" . mysql_error());

  while ($resdown = mysql_fetch_array($query)) {
    $id_usuario = $resdown['id_usuario_file'];
    $arquivo = $resdown['caminho_file'];
    $URL_antes = 'http://localhost/filedoc/';
    $URL = $URL_antes . $id_usuario . '/' . $arquivo;
  }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>FileDOC</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <script type="text/javascript">
    jQuery(function($) {
      $("#date").mask("99/99/9999");
      $("#phone").mask("(99) 9999-9999");
    });
  </script>
  <?php
  function converteData($dataa)
  {
    if (strstr($dataa, "/")) {
      $data_array = explode("/", $dataa);
      return $data_array[2] . "-" . $data_array[1] . "-" . $data_array[0];
    } else {
      return null;
    }
  }
  function converteDataform($dataa)
  {
    if (strstr($dataa, "-")) {
      $data_array = explode("-", $dataa);
      return $data_array[2] . "/" . $data_array[1] . "/" . $data_array[0];
    } else {
      return null;
    }
  }
  ?>

</head>

<body>
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
        <div align="left" class="nav-collapse collapse">
          <ul class="nav">

            <li class="active"><a style="color:#F00" href="index.php?pgf=admin/paginas/logoff">SAIR</a></li>
          </ul>
        </div>

      </div>
    </div>
  </div>
  <table class="table table-striped table-hover ">
    <thead>
      <tr>
        <th>TIPO</th>
        <th>NOME</th>
        <th>DATA VENCIMENTO</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      <?php

      $select = "SELECT id_file, id_usuario_file, nome_file, tipo_file, caminho_file, data_file, id_tp, nome_tp, id_usuario, nome_usuario 
FROM arquivos inner join tipos_arquivo  inner join usuario 
on id_usuario_file = id_usuario and tipo_file = id_tp
 WHERE id_usuario_file = '$usuario' order by data_file";

      $qry = mysql_query($select) or die("Erro ao selecionar dados!" . mysql_error());
      $cont = mysql_num_rows($qry);

      if ($cont <= '0') { } else {
        while ($res = mysql_fetch_array($qry)) {
          $id_file = $res['id_file'];
          $nome_file = $res['nome_file'];
          $tipo_file = $res['nome_tp'];
          $caminho_file = $res['caminho_file'];
          $dataa = $res['data_file'];
          $data_file = converteDataform($dataa);

          $id_usuario = $res['id_usuario_file'];
          $arquivo = $res['caminho_file'];
          $URL_antes = 'admin/arquivos/';
          $URL = $URL_antes . $id_usuario . '/' . $arquivo;

          ?>
          <tr>
            <td><?php echo $tipo_file ?></td>
            <td><?php echo $nome_file ?></td>
            <td><?php echo $data_file ?></td>
            <td align="center">
              <a href="<?php echo   $URL ?>" class="btn btn-primary btn-lg">Download</a>

          </tr>
        <?php
        }
      }
      ?>
    </tbody>
  </table>

</body>

</html>