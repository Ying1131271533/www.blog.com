<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Cache;

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * 可批量赋值的属性
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'title', 'content', 'status',
    ];

    /**
     * 获取这条博客所属的分类。
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * 获取这条博客所属的用户。
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 获取博客的所有评论
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    // 获取blog，并且缓存数据
    public static function findBlogById($id)
    {
        $blog = Cache::store('redis')->remember('blog:' . $id, cache_time(), function () use ($id) {
            return Blog::where('status', 1)
                ->select([
                    'id',
                    'user_id',
                    'category_id',
                    'title',
                    'content',
                    'view',
                    'status',
                    'created_at',
                    'updated_at',
                    ])
                ->find($id);
        });
        return $blog;
    }
}
