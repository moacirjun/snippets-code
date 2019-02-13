<?php
require_once __DIR__ . "/vendor/autoload.php";

class PatrimonioMail
{
    
    public $mailer;
    public $message;

    function __construct() {
        $transport = (new Swift_SmtpTransport('patrimoniomanaus.com.br', 587))
            ->setUsername('contato@patrimoniomanaus.com.br')
            ->setPassword('R9ZQNNje}$W&');

        $this->mailer = new Swift_Mailer($transport);
        $this->message = (new Swift_Message())
            ->setFrom(['contato@patrimoniomanaus.com.br' => 'Patrimônio Manaú']);
    }

    public function send() {
        return $this->mailer->send($this->message);
    }
}