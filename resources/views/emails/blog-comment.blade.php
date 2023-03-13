{{-- 发送过去的邮件内容，就是下面这里的内容，支持html格式 --}}
{{-- 如果要写css样式，需要把css写在这个文件里面，不能够使用link引用 --}}
{{-- 自定义 CSS的话，需要去看Laravel手册 --}}
<h2>您有新的评论</h2>

<h3>{{ $comment->user->name }} 对您的博客 [{{ $comment->blog->title }}]</h3>

<h3>进行了评论：</h3>

<div>
    {{ $comment->content }}
</div>
