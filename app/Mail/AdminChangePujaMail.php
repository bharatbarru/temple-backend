<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminChangePujaMail extends Mailable
{
    use Queueable, SerializesModels;
    public $pujaOrder;
    public $halls;
    /**
     * Create a new message instance.
     */
    public function __construct($pujaOrder,$halls)
    {
        $this->pujaOrder = $pujaOrder;
        $this->halls = $halls;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Change Puja Mail'. $this->pujaOrder->puja_request_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_change_puja_request',
            with: ['pujaOrder' => $this->pujaOrder , 'halls' => $this->halls],
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
