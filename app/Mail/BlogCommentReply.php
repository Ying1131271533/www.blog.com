<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BlogCommentReply extends Mailable
{
    use Queueable, SerializesModels;

    protected $comment;
    protected $reply; // 被回复的评论

    /**
     * 回复评论
     *
     * @return void
     */
    public function __construct($comment, $reply)
    {
        $this->comment = $comment;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.blog-comment-reply', [
            'comment' => $this->comment,
            'reply' => $this->reply
        ]);
    }
}
