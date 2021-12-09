<?php

namespace Core\Classes;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


class EnviarEmail
{

    public function enviar_email_confirmacao_novo_cliente($email        , $purl)
    {

        // envia um email para o novo cliente no sentido de confirmar o email

        // constroi o purl (link para a validação do email)
        $link = BASE_URL . '/confirmar_email&purl=' . $purl;

        $mail = new PHPMailer(true);

        try {
            //opções do servidor
            $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = EMAIL_HOST;                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = EMAIL_FROM;                     //SMTP username
            $mail->Password   = EMAIL_PASS;                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
            $mail->Port       = EMAIL_PORT;
            $mail->CharSet      = 'UTF-8';                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //emissor e receptor
            $mail->setFrom(EMAIL_FROM, APP_NAME);
            $mail->addAddress($email);     //Add a recipien              

            //assunto
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = APP_NAME . ' - Confirmação de email.';

            //mensagem
            $html = '<p>Seja bem-vindo a nossa loja' . APP_NAME . '.</p>';
            $html .= '<p>Para poder entrar na nossa loja, necessita confirmar o seu email.</p>';
            $html .= '<p>Para confirmar o email, clique no link abaixo:</p>';
            $html .= '<p><a href='.$link.'>Confirmar Email</a></p>';
            $html .= '<p><i><small>' . APP_NAME . '</small></i></p>';

            $mail->Body = $html;

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
