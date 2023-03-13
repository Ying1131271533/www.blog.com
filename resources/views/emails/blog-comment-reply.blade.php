<h2>您有新的回复评论</h2>

<h3>用户：{{ $comment->user->name }}，在博客 [{{ $comment->blog->title }}] </h3>

<h3>对您的评论：</h3>

<div>
    {{ $reply->content }}
</div>

<h3>进行了回复：</h3>

<div>
    {{ $comment->content }}
</div>
