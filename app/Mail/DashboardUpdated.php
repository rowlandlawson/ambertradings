<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DashboardUpdated extends Mailable
{
    use Queueable, SerializesModels;

    public User $user;
    public string $updateType;
    public array $updateDetails;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user, string $updateType, array $updateDetails = [])
    {
        $this->user = $user;
        $this->updateType = $updateType;
        $this->updateDetails = $updateDetails;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = match($this->updateType) {
            'balance_updated' => 'Your Account Balance Has Been Updated',
            'investment_added' => 'New Investment Added to Your Account',
            'investment_updated' => 'Your Investment Has Been Updated',
            'profit_credited' => 'Profit Has Been Credited to Your Account',
            default => 'Your Dashboard Has Been Updated',
        };

        return new Envelope(
            subject: $subject . ' - Amber Tradings',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.dashboard-updated',
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
