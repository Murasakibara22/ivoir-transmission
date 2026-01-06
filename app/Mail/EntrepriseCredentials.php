<?php

namespace App\Mail;

use App\Models\Entreprise;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EntrepriseCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $entreprise;
    public $password;
    public $loginUrl;

    /**
     * Create a new message instance.
     */
    public function __construct(Entreprise $entreprise, string $password)
    {
        $this->entreprise = $entreprise;
        $this->password = $password;
        $this->loginUrl = url('/connexion/entreprise');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bienvenue chez Ivoire Transmission - Vos identifiants de connexion',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.entreprise-credentials',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
