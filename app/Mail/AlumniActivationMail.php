<?php

namespace App\Mail;

use App\Models\AlumniInvitation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AlumniActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public AlumniInvitation $invitation;

    public function __construct(AlumniInvitation $invitation)
    {
        $this->invitation = $invitation;
    }

    public function build()
    {
        return $this
            ->subject('Aktivasi Akun Alumni KOSA Indonesia')
            ->view('emails.alumni-activation');
    }
}