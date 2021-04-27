<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Http\Middleware\RateLimited;
use Illuminate\Contracts\Queue\ShouldQueue;

class CustomMail extends Mailable implements ShouldQueue
{
    use Queueable;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 15;

    /**
     * Get the middleware the job should pass through.
     *
     * @return array
     */
    public function middleware()
    {
        return [new RateLimited];
    }

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->subject($this->data["subject"]);
        $this->to($this->data["to_email"], $this->data["to_name"]);
        $this->from($this->data["from_email"], $this->data["from_name"]);
        $this->replyTo($this->data["from_email"], $this->data["from_name"]);
        
        return $this->view("vendor.notifications.custom_mail", ["data" => $this->data]);
    }
}
