class Mailer
{
    public function send($to, $subject, $body)
    {
        // Envoyer un email
        mail($to, $subject, $body);
    }
}