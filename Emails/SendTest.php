<?php

namespace Modules\Itest\Emails;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTest extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $subject;
    public $view;
    public $quiz;
    public $result;
    public $user;

    public function __construct($user, $quiz, $result, $view, $subject)
    {

        $this->subject = $subject;
        $this->view = $view;
        $this->result = $result;
        $this->user=$user;
        $this->quiz=$quiz;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->view)->subject($this->subject);
    }
}
