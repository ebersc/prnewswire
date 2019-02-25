<?php

class EnviaEmail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Função para o envio do email com a newsletter
     */
    public function EnviarEmail()
    {
        try {
            //Recebe o conteudo das newsletters selecionadas
            $arrMsg = $this->input->post('conteudo');

            //Email do destinatário
            $para = "michael.regis@prnewswire.com.br";

            //Email do remetente
            $email_enviar = "eberson.santoscosme@gmail.com";

            //Assunto do email
            $assunto = "Newsletter";

            //Headers para habilitar o conteudo HTML no corpo da email
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1;' . "\r\n";
            $headers .= "Return-Path: $email_enviar \r\n";
            $headers .= "From: $email_enviar \r\n";
            $headers .= "Reply-To: $email_enviar \r\n";

            //Conteudo do email
            $mensagem = "<h1>Suas newsletter</h1>";
            $mensagem .= $arrMsg;

            //Envio do email
            mail($para, $assunto, $mensagem, $headers);

        } catch (Exception $ex) {
            echo $ex->getMessage();
        }
    }
}