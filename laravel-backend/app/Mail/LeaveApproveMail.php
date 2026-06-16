<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LeaveApproveMail extends Mailable
{
    use Queueable, SerializesModels;

    public $leaveRequest;

    public function __construct($leaveRequest)
    {
        $this->leaveRequest = $leaveRequest;
    }

    public function build()
    {
        return $this->subject('Đơn nghỉ phép của bạn đã được duyệt')
                    ->view('email.leave_approve');
    }
}