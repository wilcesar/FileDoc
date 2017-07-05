<?php
include_once("paginas/header.php");

?>
    
    <div id="conteudo">
    <?php
		//ESTRUTURA DOS LINKS
		//index.php?pgf=lista/lista_banner
		//index.php?pgf=cadastros/cad_mercadorias
		//index.php?pgf=lista/lista_banner
		foreach ($_REQUEST as $___opt => $___val) {
		  $$___opt = $___val;
		}
		if(empty($pgf)) {
		include("paginas/home.php");
		}
		elseif(substr($pgf, 0, 4)=='http' or substr($pgf, 
		0, 1)=="/" or substr($pgf, 0, 1)==".") 
		{
		echo '<br><font face=arial size=11px><br><b>A página não existe.</b><br>Por favor selecione uma página a partir do Menu Principal.</font>'; 
		}
		else {
		include("$pgf.php");
		}
		
?>        
  
</div><!--fecha div id conteudo -->
     <?php include_once("paginas/footer.php");?>
    