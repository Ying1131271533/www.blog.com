<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Http\Services\BlogServices;
use App\Models\Blog;
use Illuminate\Support\Js;

class BlogController extends Controller
{
    /**
     * 控制器中间件
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except(['show']);
        $this->middleware('blog')->only(['store', 'update']);
    }

    /**
     * 创建页面
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * 保存数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BlogRequest $request)
    {
        $validated = $request->validated();
        $result = BlogServices::saveBlog($validated);
        if(!$result) return back()->withErrors('发布失败！')->withInput();
        return back()->with('message', '发布成功！');
    }

    /**
     * 读取数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show(Blog $blog)
    public function show($id)
    {

        // 获取博客的所有评论
        // $comments = $blog->comments()->with('user')->get()->keyBy('id')->toArray();
        $blog = Blog::with(['comments.user' => function($query){
            $query->orderBy('id', 'asc');
        }])->find($id);
        // 浏览量加一时，停止时间戳维护
        $blog->timestamps = false;
        $blog->increment('view');
        // 启动时间戳维护
        $blog->timestamps = true;
        return view('blog.show', ['blog' => $blog, 'comments' => $blog->comments->keyBy('id')]);
    }

    /**
     * 修改页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        $content = old('content') ? old('content') :  $blog->content;
        return view('blog.edit', ['blog' => $blog, 'content' => Js::from($content)]);
    }

    /**
     * 更新数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, Blog $blog)
    {
        $validated = $request->validated();
        $result = BlogServices::saveBlog($validated, $blog);
        if(!$result) return back()->withErrors('发布失败！')->withInput();
        return back()->with('success', '发布成功！');
    }

    /**
     * 删除数据
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        $result = $blog->with('comments')->delete();
        if(!$result) return response()->api('删除失败', 400);
        return response()->api('删除成功！');
    }

    /**
     * 修改状态
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function status(Blog $blog)
    {
        // 停止时间戳维护
        $blog->timestamps = false;
        $blog->status = $blog->status == 1 ? 0 : 1;
        $result = $blog->save();
        if(!$result) {
            return response()->api('操作失败', 400);
        }
        $msg = $blog->status == 1 ? '成功发布' : '已取消发布';
        return response()->api($msg);
    }
}
