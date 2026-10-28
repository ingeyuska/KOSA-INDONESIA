<?php

namespace App\Mail;

use App\Models\MemberVerification;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MemberVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public MemberVerification $verification;

    public function __construct(MemberVerification $verification)
    {
        $this->verification = $verification;
    }

    public function build()
    {
        return $this
            ->subject('Konfirmasi Akun Member KOSA Indonesia')
            ->view('emails.member-verification');
    }
}