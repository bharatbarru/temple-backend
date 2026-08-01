<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class AdminHallOrderMail extends Mailable
{
    use Queueable, SerializesModels;

    public $hallOrder;
    public $halls;


    /**
     * Create a new message instance.
     */
    public function __construct($hallOrder,$halls)
    {
        $this->hallOrder = $hallOrder;
        $this->halls = $halls;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Admin Hall Order Mail' . $this->hallOrder->hall_request_id,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.admin_hall_request',
            with: ['hallOrder' => $this->hallOrder,'halls' => $this->halls],
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
