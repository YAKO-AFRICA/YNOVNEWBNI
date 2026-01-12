<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $mailData;
    public $emailSubject;

    public function __construct($mailData, $emailSubject)
    {
        $this->mailData = $mailData;
        $this->emailSubject = $emailSubject;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->emailSubject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.sendId',
            with: [
                'messageText' => $this->mailData['messages'] ?? '',
                'documentUrl' => $this->mailData['documents'] ?? '',
            ]
        );
    }

    public function attachments(): array
    {
        $attachments = [];

        if (!empty($this->mailData['documents'])) {
            $document = $this->mailData['documents'];

            // Si c’est un fichier local
            if (file_exists($document)) {
                $attachments[] = Attachment::fromPath($document);
            }
            // Si c’est une URL distante (on essaie de le télécharger et le joindre en mémoire)
            elseif (filter_var($document, FILTER_VALIDATE_URL)) {
                try {
                    $fileContents = file_get_contents($document);
                    $filename = basename(parse_url($document, PHP_URL_PATH));
                    $attachments[] = Attachment::fromData(fn () => $fileContents, $filename);
                } catch (\Exception $e) {
                    // On ignore si téléchargement échoue
                }
            }
        }

        return $attachments;
    }
}
