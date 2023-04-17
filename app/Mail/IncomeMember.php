<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;

class IncomeMember extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $total_bonus;


    /**
     * Create a new message instance.
     */
    public function __construct($name, $total_bonus)
    {
        //
        $this->name = $name;
        $this->total_bonus = $total_bonus;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            // from: new Address('muhammadagiandi@gmail.com', 'Muhammad Agiandi'),
            subject: 'Income Member',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.income',
            with: [
                'name' => $this->name,
                'total_bonus' => $this->total_bonus
            ]
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
