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

        $tags = $this->buildTags();
        $emailSubject = $this->parseTemplate($commonFields->email_subject, $tags);
        $emailBody = $this->parseTemplate($commonFields->email_body, $tags);

        return $this->from($commonFields->sender_email, $commonFields->sender_name)
                    ->subject($emailSubject ?? $this->userVideo->project_title)
                    ->text('mail.video-rendered-text')
                    ->with(['emailBody' => $emailBody]);
    }

    public function buildTags()
    {
        // build link to video: either youtube (if available)
        // or direct download link from S3
        if ($this->userVideo->youtube_id) {
            $link = 'https://youtu.be/' . $this->userVideo->youtube_id;
        } else {
            $link = $this->userVideo->video_url;
        }

        $tags = [
            '{first_name}' => $this->userVideo->commonFields['customer_first_name'],
            '{last_name}' => $this->userVideo->commonFields['customer_last_name'],
            '{link}' => $link,
        ];

        return $tags;
    }

    public function parseTemplate($input, Array $tags)
    {
        $parsedTemplate = str_replace(
            array_keys($tags),
            array_values($tags),
            $input
        );

        return $parsedTemplate;
    }

}
