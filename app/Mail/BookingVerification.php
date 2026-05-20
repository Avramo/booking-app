<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class BookingVerification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public Booking $booking) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Please confirm your booking request — First Class Potash',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.booking-verification',
            with: [
                'booking' => $this->booking,
                'confirmUrl' => url('/bookings/' . $this->booking->confirmation_token . '/confirm'),
            ],
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
