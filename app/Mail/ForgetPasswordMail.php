<?php

namespace App\Mail;

use App\Models\EmailDesign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    private $password = "";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($password)
    {
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = EmailDesign::query()->where("key", "forget_password_to_email")->first();
        return $this->view('email.sendPasswordEmail')->with(["data" => $mailData->value, "password" => $this->password]);
    }
}
