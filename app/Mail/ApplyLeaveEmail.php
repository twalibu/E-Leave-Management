<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyLeaveEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $pendind;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pendind)
    {
        $this->pendind = $pendind;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("New Leave Application from {$this->pendind['name']}")
        ->view('emails.test');
    }
}
