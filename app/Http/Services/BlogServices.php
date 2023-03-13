<?php

namespace App\Http\Services;

use App\Models\Blog;

class BlogServices
{
    public static function saveBlog($data, $model = null)
    {
        $blog = $model ? $model : new Blog();
        $result = $blog->fill($data)->save();
        return $result;
    }
}
