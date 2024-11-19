<?php

namespace App\Mail;

use App\Models\Fournisseur;
use App\Models\ModelCourriel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Log;

class customMail extends Mailable
{
    use Queueable, SerializesModels;


    public $template;
    public $fournisseur;
    public $raisonRefu;
    /**
     * Create a new message instance.
     */
    public function __construct(ModelCourriel $template, Fournisseur $fournisseur, string $raisonRefus = null)
    {
        $this->template = $template;
        $this->fournisseur = $fournisseur;
        $this->raisonRefus = $raisonRefus;
    }
    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.Mail',
            with: [
                'template' => $this->template,
                'fournisseur' => $this->fournisseur,
                'raisonRefus' => $this->raisonRefus,
            ]
        );
    }
    /**
     * Get the message envelope.
     */
    /* 
         public function build()
        {
            return $this->view('emails.Mail')
                        ->with([
                            'template' => $this->template,
                            'fournisseur' => $this->fournisseur,
                            'raisonRefus' => $this->raisonRefus,
                        ]);
        } */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->template->sujet,
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
