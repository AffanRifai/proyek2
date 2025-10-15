<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;
    public $user;

    public function __construct($otp, $user)
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    public function build()
    {
        return $this->subject('Kode Verifikasi Akun Anda')
                    ->view('emails.otp')
                    ->with([
                        'otp' => $this->otp,
                        'user' => $this->user,
                        'appName' => config('app.name'),
                    ]);
    }
}
