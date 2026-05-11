<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp; // Variabel ini akan dikirim ke file HTML tadi

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject("Kode OTP Verifikasi - Gentleman's Club")
            ->view('emails.otp'); // Memanggil file resources/views/emails/otp.blade.php
    }
}
