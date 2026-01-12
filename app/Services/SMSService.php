<?php

namespace App\Services;

use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;

class SMSService
{

    // private $clientId = 'xjxWRml44RnoZ5dvMFIfQl3e18rGA7tv';
    private $clientId = 'nHGG0L8hBadaSPud8yja2MjYfmS183kh';
    private $clientSecret = 'Zc7RUVp7pBPBH4iS';
    private $sender = '701280'; // Sender ID configuré dans Orange SMS API
    private $tokenUrl = 'https://api.orange.com/oauth/v3/token';
    private $smsUrl = 'https://api.orange.com/smsmessaging/v1/outbound';

    // /**
    //  * Obtenir un jeton d'accès pour l'API Orange
    //  */
    private function getAccessToken()
    {
        try {
            $response = Http::asForm()
                ->withHeaders([
                    // 'Authorization' => 'Basic ' . "eGp4V1JtbDQ0Um5vWjVkdk1GSWZRbDNlMThyR0E3dHY6d1FrQzZZYk5kTTVBTVhpZw==",
                    // 'Authorization' => "Basic bkhHRzBMOGhCYWRhU1B1ZDh5amEyTWpZZm1TMTgza2g6WmM3UlVWcDdwQlBCSDRpUw==",
                    'Authorization' => 'Basic ' . base64_encode("$this->clientId:$this->clientSecret"),
                ])
                ->post($this->tokenUrl, [
                    'grant_type' => 'client_credentials',
                ]);

            if ($response->failed()) {
                throw new \Exception('Erreur lors de la récupération du token : ' . $response->body());
            }

            return $response->json()['access_token'];
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }

    // /**
    //  * Envoyer un OTP via l'API Orange
    //  */
    public function sendOtpByOrangeAPI($phoneNumber, $otp, $from="YAKO AFRICA")
    {
        // $accessToken = $this->getAccessToken();

        // if (isset($accessToken['error'])) {
        //     return $accessToken; // Retourne une erreur si le token n'a pas été généré correctement
        // }

        // $smsUrl = "{$this->smsUrl}/tel%3A%2B" . urlencode($this->sender) . "/requests";
        // // $smsUrl = "{$this->smsUrl}/tel%3A%2B" . urlencode($this->sender) . "/requests";

        // $body = [
        //     'outboundSMSMessageRequest' => [
        //         'address' => "tel:+{$phoneNumber}",
        //         // 'senderAddress' => "tel:+{$phoneNumber}",
        //         'senderAddress' => "tel:+{$this->sender}",
        //         'outboundSMSTextMessage' => [
        //             'message' => "Votre code de confirmation est : $otp",
        //         ],
        //     ],
        // ];

        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => "Bearer $accessToken",
        //         'Content-Type' => 'application/json',
        //     ])->post($smsUrl, $body);

        //     if ($response->failed()) {
        //         throw new \Exception('Erreur lors de l\'envoi du SMS : ' . $response->body());
        //     }

        //     return $response->json();
        // } catch (\Exception $e) {
        //     return ['error' => $e->getMessage()];
        // }
        $url = "https://wp2e3q.api.infobip.com/sms/2/text/advanced";
        $cleApi = "ca9b1e97d87d27dc425b2d598aa83c46-cbbd83f5-f0af-49ae-9bc0-02ba090ecac3";
        // $url = "https://z32vrw.api.infobip.com/sms/2/text/advanced";
        // $cleApi = "7e23a940f0227d7a9555890da2569aa2-80288480-49fb-47d5-bf44-fe05699acfbc";
        $headers = [
                    'Authorization' => "App $cleApi",
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
        ];

        $body = [
            "messages" => [
                [
                    // "from" => 2250789078557,
                    "from" => $from,
                    "destinations" => [
                        ["to" => $phoneNumber]
                    ],
                    "text" => "Votre code de confirmation de votre numéro est : $otp"
                ]
            ]
        ];

        try {
            
            $response = Http::withHeaders($headers)
                ->post($url, $body);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }
    }


    public function sendOtpByInfobipAPI($phoneNumber, $otp, $from="YAKO AFRICA")
    {
        $url = "https://wp2e3q.api.infobip.com/sms/2/text/advanced";
        $cleApi = "ca9b1e97d87d27dc425b2d598aa83c46-cbbd83f5-f0af-49ae-9bc0-02ba090ecac3";
        // $url = "https://z32vrw.api.infobip.com/sms/2/text/advanced";
        // $cleApi = "7e23a940f0227d7a9555890da2569aa2-80288480-49fb-47d5-bf44-fe05699acfbc";
        $headers = [
                    'Authorization' => "App $cleApi",
                    'Content-Type' => 'application/json',
                    'Accept' => 'application/json',
        ];

        $body = [
            "messages" => [
                [
                    // "from" => 2250789078557,
                    "from" => $from,
                    "destinations" => [
                        ["to" => $phoneNumber]
                    ],
                    "text" => "Votre code de confirmation de votre numéro est : $otp"
                ]
            ]
        ];

        try {
            
            $response = Http::withHeaders($headers)
                ->post($url, $body);

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        // $accessToken = $this->getAccessToken();

        // if (isset($accessToken['error'])) {
        //     return $accessToken; // Retourne une erreur si le token n'a pas été généré correctement
        // }

        // $smsUrl = "{$this->smsUrl}/tel%3A%2B" . urlencode($this->sender) . "/requests";
        // // $smsUrl = "{$this->smsUrl}/tel%3A%2B" . urlencode($this->sender) . "/requests";

        // $body = [
        //     'outboundSMSMessageRequest' => [
        //         'address' => "tel:+{$phoneNumber}",
        //         // 'senderAddress' => "tel:+{$phoneNumber}",
        //         'senderAddress' => "tel:+{$this->sender}",
        //         'outboundSMSTextMessage' => [
        //             'message' => "Votre code de confirmation est : $otp",
        //         ],
        //     ],
        // ];

        // try {
        //     $response = Http::withHeaders([
        //         'Authorization' => "Bearer $accessToken",
        //         'Content-Type' => 'application/json',
        //     ])->post($smsUrl, $body);

        //     if ($response->failed()) {
        //         throw new \Exception('Erreur lors de l\'envoi du SMS : ' . $response->body());
        //     }

        //     return $response->json();
        // } catch (\Exception $e) {
        //     return ['error' => $e->getMessage()];
        // }
    }
    
}
