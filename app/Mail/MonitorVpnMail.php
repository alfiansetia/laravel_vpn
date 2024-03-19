<?php

namespace App\Mail;

use App\Models\Company;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MonitorVpnMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vpns;

    /**
     * Create a new message instance.
     */
    public function __construct(array $vpns = [])
    {
        $this->vpns = $vpns;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Monitor Expired Vpn',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.monitor_vpn'
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

    public function build()
    {
        $company = Company::first();
        $vpns = $this->vpns;
        return $this->view('mail.monitor')
            ->with([
                'company' => $company, 'vpns' => $vpns
            ]);
    }
}
