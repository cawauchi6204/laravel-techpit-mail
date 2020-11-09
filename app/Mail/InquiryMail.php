<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;
    
    public $email;
    public $name;
    public $relationship;
    public $content;
    
    public function __construct(array $data)
    {
        foreach($data as $key => $value) {
            $this->{$key} = $value;
        }
    }
    
    public function build()
    {
        return $this->subject($this->name . 'さんにお知らせがあります')
        ->text('emails.inquiry');
    }
}
