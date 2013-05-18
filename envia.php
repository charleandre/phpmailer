<?php
$erro = "";
/*Variaveis do Formulario*/
$nome = trim($_POST['nome']);/*recebe os dados digitados no campo "nome"*/
$email = trim($_POST['email']);/*recebe os dados digitados no campo "email"*/
$assunto = trim($_POST['assunto']);/*recebe os dados digitados no campo "assunto"*/
$msg= trim($_POST['msg']);/*recebe os dados digitados no campo "mensagem"*/



    if($nome == ""){
  	$erro = "Preencha campo nome"."<br />";
	
    }

     //Verifica se o e-mail é válido 
    $emailPattern = '/^[^@\s]+@([-a-z0-9]+\.)+[a-z]{2,}$/i'; 
    if (!preg_match($emailPattern, $email)) { 
        $erro .= "Por favor verifique o endereço de e-mail"."<br />"; 
      
    }
	
	if($msg == ""){
		$erro .= "Preencha campo mensagem"."<br />";
	
    }

	



	  //ADICIONA O SCRIPT DE ENVIO DE E-MAILS
      require_once('phpmailer/class.phpmailer.php'); 
 
//Se não existir erro faz o procedimento para enviar o e-mail
if(empty($erro)){
  
      // O BLOCO ABAIXO INICIALIZA O ENVIO
      
      $para = "charleandre@gmail.com"; //SEU EMAIL QUE VAI RECEBER O E-MAIL ENVIADO
      
      $mail = new PHPMailer(); // INICIA A CLASSE PHPMAILER
      $mail->IsSMTP(); //ESSA OPÇÃO HABILITA O ENVIO DE SMTP
      
      $mail->Host = "smtp.googlemail.com"; //SERVIDOR DE SMTP, USE smtp.SeuDominio.com OU smtp.hostsys.com.br 
      $mail->SMTPAuth = true; //ATIVA O SMTP AUTENTICADO
      $mail->Username = "charleandre@gmail.com"; //EMAIL PARA SMTP AUTENTICADO (pode ser qualquer conta de email do seu domínio)
      $mail->Password = "apollo32"; //SENHA DO EMAIL PARA SMTP AUTENTICADO
      $mail->From = $email; //E-MAIL DO REMETENTE 
      $mail->FromName = $nome; //NOME DO REMETENTE
      $mail->AddAddress($para); //E-MAIL DO DESINATÁRIO, NOME DO DESINATÁRIO --> AS VARIÁVEIS ALI PODEM FAZER REFERÊNCIA A DADOS VINDO DE $_GET OU $_POST, OU AINDA DO BANCO DE DADOS
      $mail->WordWrap = 50; // ATIVAR QUEBRA DE LINHA
      $mail->IsHTML(true); //ATIVA MENSAGEM NO FORMATO HTML
      $mail->Subject = $assunto; //ASSUNTO DA MENSAGEM
      $mail->Body = "<table width='628' height='205' border='0'bgcolor='#D1DCED'>
             <tr>
            <td width='73'>Nome:</td>
            <td width='539'>$nome</td>
             </tr>
             <tr>
            <td>Email:</td>
            <td>$email</td>
             </tr>
             <tr>
            <td>Assunto:</td>
            <td>$assunto</td>
             </tr>
             <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
             </tr>
             <tr>
            <td colspan='2'>Mensagem</td>
             </tr>
             <tr>
            <td colspan='2'>$msg</td>
             </tr>
            </table>"; //MENSAGEM NO FORMATO HTML, PODE SER TEXTO OU IMAGEM
      
      
      // verifica se está tudo ok com oa parametros acima, se nao, avisa do erro. Se sim, envia.
      if($mail->Send())   { 
       echo "<div align='center'>Mensagem enviada!</div>";
      
      }else{
       echo "<div align='center'>Mensagem não enviada!</div>";
	  
      }

} 

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pt-br" lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Script que envia e-mail</title>
</head>
<body>
	<div align="center"><?php if(isset($erro)){ echo $erro; }  ?></div>
</body>
</html>
