<?php

namespace App\Mail;

use App\Models\Entreprise;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EntrepriseOTP extends Mailable
{
    use Queueable, SerializesModels;

    public $entreprise;
    public $otp;

    public function __construct(Entreprise $entreprise, string $otp)
    {
        $this->entreprise = $entreprise;
        $this->otp = $otp;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Code de vérification - Ivoire Transmission',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.entreprise-otp',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
