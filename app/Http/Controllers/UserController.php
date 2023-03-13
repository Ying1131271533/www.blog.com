<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User as UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * 个人中心首页 - 个人信息
     *
     * @return \Illuminate\Http\Response
     */
    public function infoPage()
    {
        return view('user.info');
    }

    /**
     * 个人信息修改数据
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function infoUpdate(UserRequest $request, $id)
    {
        // 获取通过验证的数据
        $validated = $request->validated();
        $result = DB::table('users')->where('id', $id)->update($validated);
        if (!$result) return back()->with(['warning' => '未做更改']);
        return back()->with(['message' => '更新成功！']);
    }

    /**
     * 头像修改 页面
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function avatarPage()
    {
        return view('user.avatar');
    }

    /**
     * 头像更新
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function avatarUpdate(UserRequest $request, $id)
    {
        // 获取通过验证的数据
        $validated = $request->validated();
        $file = $validated['avatar'];
        if(empty($file)) return back()->withErrors('请选择文件');
        $path = $file->store('avatars', 'public');

        $result = DB::table('users')->where('id', $id)->update(['avatar' => $path]);
        if (!$result) return back()->withErrors('更新失败！');

        // 获取旧头像
        $oldAvatar = auth()->user()->avatar;
        // 删除旧头像
        if(!empty($oldAvatar) && Storage::disk('public')->exists($oldAvatar)){
            Storage::disk('public')->delete($oldAvatar);
        }
        return back()->with(['message' => '更新成功']);
    }

    /**
     * 用户所有博客
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function blog()
    {
        $blogs = auth()->user()
        ->blogs()
        ->withCount('comments')
        ->orderBy('updated_at', 'desc')
        ->paginate(5);
        return view('user.blog', ['blogs' => $blogs]);
    }
}
