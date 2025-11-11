<?php

namespace App\Mail;

use App\Models\Contrat;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContratConfirmed extends Mailable
{
    use Queueable, SerializesModels;

    public $contrat;
    public $dashboardUrl;

    public function __construct(Contrat $contrat)
    {
        $this->contrat = $contrat;
        $this->dashboardUrl = url('/dashboard');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: '🎉 Nouveau contrat confirmé - ' . $this->contrat->entreprise->name,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contrat-confirmed',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}