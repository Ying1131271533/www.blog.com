<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/************************ 测试 ************************/

// 欢迎
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

// 子域名
Route::domain('{account}.wse.com')->group(function () {
    Route::get('/domain', function () {
        dd('子域名路由');
    })->name('domain');
});

// 路由前缀 路由名称前缀
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/users', function () {
        dd('后台用户列表');
    })->name('users');
});

// 测试
Route::any('/test', TestController::class)->name('test');

// @csrf
Route::get('/token', function (Request $request) {
    return success(['token' => $request->session()->token()]);
});

// 模型隐式绑定，找不到数据则返回404
Route::get('users/{user}', function (User $user) {
// Route::get('users/{user}', function(Request $request, User $user){
    dd($user);
});

// 软删除
Route::middleware('auth')->delete('/users/{user}', function (User $user) {
    return $user->id;
})->withTrashed();

/************************ 项目 ************************/

// 首页
Route::get('/', [IndexController::class, 'index'])->name('index');

// 博客资源控制器
Route::resource('blog', BlogController::class) ->except(['index']) ->whereNumber('blog');

// 权限路由组
Route::middleware('auth')->whereNumber('id')->group(function () {

        /************************ 博客 ************************/
        Route::prefix('blog')->name('blog.')->group(function () {
            // 博客发布状态修改
            Route::patch('{blog}/status', [BlogController::class, 'status'])->name('status');
            // 博客发布推荐状态修改
            Route::patch('{blog}/recommend', [BlogController::class, 'recommend'])->name('recommend');
            // 博客评论
            Route::post('{blog}/comment', CommentController::class)->name('commnet');
            // 获取博客评论
            // Route::get('{blog}/comments',[BlogController::class, 'commnets'])->name('blog.commnets');
        });

        /************************ 个人中心 ************************/
        Route::prefix('user')
            ->name('user.')
            ->controller(UserController::class)
            ->group(function () {
                // 个人中心首页
                Route::get('', 'infoPage')->name('info');
                // 个人信息修改数据
                Route::put('{id}', 'infoUpdate')->name('infoUpdate');
                // 头像页面
                Route::get('{id}/avatar', 'avatarPage')->name('avatar');
                // 头像修改数据
                Route::patch('{id}/avatar', 'avatarUpdate')->name('avatarUpdate');
                // 用户所有博客
                Route::get('blog', 'blog')->name('blog');
            });
    });

// 登录注册相关的路由，将会直接使用Laravel提供的

// 查看添加好的路由列表
// php artisan route:list

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
