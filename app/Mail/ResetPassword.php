<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $name;
     public $token;

    public function __construct($name,$token)
    {
        //
        $this->name = $name;
        $this->token = $token;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user['name'] = $this->name;
        $user['token'] = $this->token;
        
        return $this->from("info@parots.it", "Password Reset")
        ->subject('Password Reset Link')
        ->view('email.reset-password', ['user' => $user]);
    }
}
