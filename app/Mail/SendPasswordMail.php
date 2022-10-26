<?php

namespace App\Mail;

use App\Models\EmailDesign;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    public $password = "", $username = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($username, $password)
    {
        $this->password = $password;
        $this->username = $username;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mailData = EmailDesign::query()->where("key", "send_password_to_email")->first();
        $value= str_replace('[thispassword]',$this->password,$mailData->value);
        return $this->view('email.sendPasswordEmail')->with(["data" => $value, "password" => $this->password, "username" => $this->username]);
    }
}
