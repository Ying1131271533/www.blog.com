<?php

namespace App\Jobs;

use App\Mail\BlogComment;
use App\Mail\BlogCommentReply;
use App\Models\Comment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CommentEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $comment;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->comment->blog->user)->send(new BlogComment($this->comment));
        // 如果存在parent_id，则发送回复评论邮件
        if($this->comment->parent_id > 0){
            // 找到被回复的评论
            $reply = Comment::find($this->comment->parent_id);
            Mail::to($reply->user)->send(new BlogCommentReply($this->comment, $reply));
        }
    }
}
