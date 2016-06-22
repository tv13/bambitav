<?php 

function send_mail($to, $subject, $content, $addreply=null, $attach=false)
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
        $mail->AddAddress($to);
        $mail->SetFrom($__smtp['username'], $__smtp['fromname']);
        if (!empty($addreply)) {
            $mail->AddReplyTo($addreply, $addreply);
        }
        else {
            $mail->AddReplyTo($__smtp['addreply'], $__smtp['fromname']);
        }
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