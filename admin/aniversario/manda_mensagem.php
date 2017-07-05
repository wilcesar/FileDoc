<?php 

$id_usuario = $_GET['id'];
$select = "SELECT email_usuario FROM usuario WHERE id_usuario = '$id_usuario'";
$qry = mysql_query($select) or die ("Erro ao selecionar dados!".mysql_error());
$cont = mysql_num_rows($qry);

if($cont <= '0'){
	
echo 'Nemum da do encontrado!';	
	
}else{
	while($res = mysql_fetch_array($qry)){
	$email_recebe = $res['email_usuario'];	
	}
	
}

if (isset($_POST['BTEnvia'])){
 
        //Variaveis de POST, Alterar somente se necessário 
        //====================================================
        $assunto = $_POST['assunto'];
        $texto = $_POST['texto'];
        
        //====================================================
 
 
        //REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
        //====================================================
        $email_remetente = "robson@adicontabilidade.com.br"; // deve ser um email do dominio
        //====================================================
 
 
        //Configurações do email, ajustar conforme necessidade
        //====================================================
        $email_destinatario = $email_recebe; // qualquer email pode receber os dados
        
        $email_assunto = $assunto;
        //====================================================
 
 
        //Monta o Corpo da Mensagem
        //====================================================
        $email_conteudo = $texto;
        //====================================================
 
 
        //Seta os Headers (Alerar somente caso necessario)
        //====================================================
        $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Subject: $email_assunto","Return-Path:  $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
        //====================================================
 
 
        //Enviando o email
        //====================================================
        if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){
                echo "</b>E-Mail enviado com sucesso!</b>";
        }
        else{
                echo "</b>Falha no envio do E-Mail!</b>";
        }
        //====================================================
}
?>
 
 
<form action="<? $PHP_SELF; ?>" method="POST">
 
 	<fieldset>
    	<legend>@ Envio de e-mail</legend>
        <label>Assunto</label>
        <input type="text" size="30" name="assunto">
    
       <label>Texto</label>
        <textarea name="texto"></textarea>

    
        <input type="submit" name="BTEnvia" value="Enviar">
        <input type="reset" name="BTApaga" value="Apagar">
    </fieldset>
</form>