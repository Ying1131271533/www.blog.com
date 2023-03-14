<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * 可批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'user_id', 'blog_id', 'content',
    ];

    /**
     * 获取这条评论属的博客。
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * 获取这条评论属的用户。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
