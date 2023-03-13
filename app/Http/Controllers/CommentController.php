<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Jobs\CommentEmail;
use App\Mail\BlogComment;
use App\Mail\BlogCommentReply;
use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    /**
     * 博客评论
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CommentRequest $request, Blog $blog)
    {
        // 保存评论
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();

        // // 发送邮件通知作者和有没有被回复的用户
        // // to()里面可以传入：用户模型/用户模型集合/邮箱地址/数组里面写多个邮箱地址
        // Mail::to($blog->user)->send(new BlogComment($comment));
        // // 如果存在parent_id，则发送回复评论邮件
        // if($comment->parent_id > 0){
        //     // 找到被回复的评论
        //     $reply = Comment::find($comment->parent_id);
        //     Mail::to($reply->user)->send(new BlogCommentReply($comment, $reply));
        // }

        $comment = $blog->comments()->create($validated);

        // 使用自定义的队列发送邮件
        // CommentEmail::dispatch($comment);

        // 使用Laravel自带的邮件队列
        Mail::to($blog->user)->queue(new BlogComment($comment));
        // 如果存在parent_id，则发送回复评论邮件
        if($comment->parent_id > 0){
            // 找到被回复的评论
            $reply = Comment::find($comment->parent_id);
            Mail::to($reply->user)->queue(new BlogCommentReply($comment, $reply));
        }
        // 延迟队列
        // Mail::to($request->user())->later(now()->addMinutes(10), new OrderShipped($order));

        if(!$comment) return response()->api('评论失败', 400);
        return response()->api('评论成功');
    }
}
