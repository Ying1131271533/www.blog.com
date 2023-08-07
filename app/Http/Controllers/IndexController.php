<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class IndexController extends Controller
{

    /**
     * 博客首页
     */
    public function index(Request $request)
    {
        // $blogs = Blog::search()->where('user_id', 2)->get();
        // $blogs = Blog::search('title:(阿卡丽)')
        // ->query(fn (Builder $query) => $query->with('user'))
        // ->raw(); // 获取原始搜索结果
        // ->get()->toArray();
        // dd($blogs);

        // 搜索关键词
        $keyword = $request->query('keyword');
        // 分类id
        $category_id = $request->query('category_id');

        // 获取博客数据
        $blogs = Blog::with('user:id,name')
        ->when($keyword, function ($query) use ($keyword) {
            // 查询分组 会变成这样：(title like keyword or content like keyword) 有括号的
            $query->where(function($query) use ($keyword) {
                $query->where('title', 'like', "%{$keyword}%")->orWhere('content', 'like', "%{$keyword}%");
            });
        })
        ->when($category_id, function ($query) use ($category_id) {
            $query->where('category_id', $category_id);
        })
        ->where('status', 1)
        ->orderBy('updated_at', 'desc')
        ->paginate(2);
        // ->dd(); // 显示sql语句
        // dd($blogs->toArray());
        return view('index.index', ['blogs' => $blogs, 'categorys' => categorys()]);
    }
}
