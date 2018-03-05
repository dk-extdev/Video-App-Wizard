<?php

namespace App\Mail;

use App\UserVideos;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VideoRendered extends Mailable
{
    use Queueable, SerializesModels;

    protected $userVideo;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(UserVideos $userVideo)
    {
        $this->userVideo = $userVideo;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $commonFields = $this->userVideo->commonFields;
        return $this->from($commonFields->sender_email, $commonFields->sender_name)
                    ->subject($commonFields->email_subject ?? $this->userVideo->project_title)
                    ->text('mail.video-rendered-text')
                    ->with([
                        'senderName' => $commonFields->sender_name,
                        'customerName' => $commonFields->customer_first_name,
                        'customerYoutubeUrl' => 'https://youtu.be/' .
                                                $this->userVideo->youtube_id,
                    ]);
    }
}
