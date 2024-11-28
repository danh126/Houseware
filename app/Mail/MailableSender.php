<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MailableSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */

    public $subject;
    public $view;
    private $body;

    public function __construct($view, $subject, $body)
    {
        $this->view = $view;
        $this->subject = $subject;
        $this->body = $body;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: $this->view,
            with: [
                'subject' => $this->subject,
                'body' => $this->body
            ]
        );
    }

    // public function build()
    // {
    //     $this->withSwiftMessage(function ($message) {
    //         $message->getHeaders()->addTextHeader('X-Priority', '1');
    //     });

    //     return $this->view($this->view)
    //         ->with([
    //             'body' => $this->body,
    //             'subject' => $this->subject,
    //         ]);
    // }

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
