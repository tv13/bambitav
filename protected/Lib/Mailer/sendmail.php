<?php 

function send_mail($to, $subject, $content, $attach=false)
{
    require_once('config.php');
    require_once('class.phpmailer.php');
    $mail = new PHPMailer(true);

    $mail->IsSMTP();
    try {
        $mail->Host       = $__smtp['host']; 
        $mail->SMTPDebug  = $__smtp['debug']; 
        $mail->SMTPAuth   = $__smtp['auth'];
        $mail->Host       = $__smtp['host'];
        $mail->Port       = $__smtp['port']; 
        $mail->Username   = $__smtp['username'];
        $mail->Password   = $__smtp['password'];
        $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
        $mail->AddAddress($to);
        $mail->SetFrom($__smtp['addreply'], $__smtp['username']);
        $mail->AddReplyTo($__smtp['addreply'], $__smtp['username']);
        $mail->Subject = htmlspecialchars($subject);
        $mail->MsgHTML($content);
        if($attach)  $mail->AddAttachment($attach);
        return $mail->Send();
    } catch (phpmailerException $e) {
        //echo $e->errorMessage(); 
        return false;
    } catch (Exception $e) {
        //echo $e->getMessage(); 
        return false;
    }
}