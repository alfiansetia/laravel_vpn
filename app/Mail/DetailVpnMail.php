<?php

namespace App\Mail;

use App\Models\Company;
use App\Models\Vpn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DetailVpnMail extends Mailable
{
    use Queueable, SerializesModels;

    public $vpn;

    /**
     * Create a new message instance.
     */
    public function __construct(Vpn $vpn)
    {
        $this->vpn = $vpn;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Detail Vpn ' . $this->vpn->username,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.detail_vpn',
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
        $vpn = $this->vpn->load('server', 'port');
        return $this->view('mail.monitor')
            ->with([
                'company' => $company, 'vpn' => $vpn
            ]);
    }
}
