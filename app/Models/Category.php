<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * 与模型关联的数据表.
     *
     * @var string
     */
    protected $table = 'categorys';

    /**
     * 获取分类的所有博客
     */
    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
}
