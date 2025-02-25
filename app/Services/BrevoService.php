<?php

namespace App\Services;

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use SendinBlue\Client\Model\SendSmtpEmail;
use SendinBlue\Client\Model\SendSmtpEmailSender;
use SendinBlue\Client\Model\SendSmtpEmailTo;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BrevoService
{
    protected $apiInstance;

    public function __construct()
    {
        $config = Configuration::getDefaultConfiguration()
            ->setApiKey('api-key', env('BREVO_API_KEY'));

        $this->apiInstance = new TransactionalEmailsApi(
            new Client(),
            $config
        );
    }

    public function sendEmail($to, string $subject, string $htmlContent, array $options = [])
    {
        try {
            // Préparation des destinataires
            $toArray = is_array($to) ? $to : [$to];
            $recipients = array_map(function($email) {
                return new SendSmtpEmailTo(['email' => $email]);
            }, $toArray);

            // Configuration de l'email
            $email = new SendSmtpEmail([
                'sender' => new SendSmtpEmailSender([
                    'name' => env('BREVO_SENDER_NAME', 'Demande de stage'),
                    'email' => env('BREVO_SENDER_EMAIL','oubbadayyoub12@gmail.com')
                ]),
                'to'=> $recipients,
                'subject' => $subject,
                'htmlContent' => $htmlContent,
                'attachment' => $options['attachments'] ?? []
            ]);

            // Envoi
            $response = $this->apiInstance->sendTransacEmail($email);

            return [
                'success' => true,
                'message_id' => $response->getMessageId()
            ];

        } catch (\Exception $e) {
            Log::error('Brevo API Error: '.$e->getMessage());
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}