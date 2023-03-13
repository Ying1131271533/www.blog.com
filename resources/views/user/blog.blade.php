@extends('layout.app')

@section('title', '我的博客')

@section('style')
    <!-- css -->
    <link href="{{ asset('static/css/site.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/chosen.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('static/css/activity.css') }}" rel="stylesheet" type="text/css">
@endsection

<!-- 主体内容 -->
@section('content')
    <div class="container body-container">
        <div class="site-body">

            <!-- 左边导航 -->
            @include('user.nav', ['action' => 'blog'])

            <!-- 右侧 -->
            <div class="left_cont">
                <style>
                    #table-list tr td {
                        padding: 10px !important;
                        margin: 0;
                    }

                    .layui-btn+.layui-btn {
                        margin-left: 0px !important;
                    }
                </style>
                <div class="main-info">
                    <h1 class="site-h1">我的博客</h1>
                    <div class="data-list">
                        <table class="layui-table" id="table-list">
                            <thead>
                                <tr>
                                    <td width="3%">No.</td>
                                    <td width="35%">标题</td>
                                    <td width="5%">浏览量</td>
                                    <td width="5%">评论数</td>
                                    <td width="8%">创建时间</td>
                                    <td width="5%">状态</td>
                                    <td width="10%">操作</td>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($blogs as $blog)
                                    <tr>
                                        <td>{{ $blog->id }}</td>
                                        <td>
                                            <a target="_blank"
                                                href="{{ route('blog.show', $blog->id) }}">{{ $blog->title }}</a>
                                        </td>
                                        <td>{{ $blog->view }}</td>
                                        <td>{{ $blog->comments_count }}</td>
                                        <td>{{ $blog->updated_at->diffForHumans() }}</td>

                                        <td>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input blog-status" id="status-{{ $blog->id }}" data-url="{{ route('blog.status', $blog) }}" @if ($blog->status == 1) checked @endif>
                                            </div>
                                        </td>
                                        <td>
                                            <a class="layui-btn layui-btn-sm" href="{{ route('blog.edit', $blog) }}">编辑</a>
                                            <a class="layui-btn layui-btn-sm del-blog" href="javascript:;"
                                                data-url="{{ route('blog.destroy', $blog) }}">删除</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                        {{ $blogs->links() }}
                    </div>
                </div>

                {{-- <script type="text/javascript" src="{{ asset('static/js/activityJoin.js') }}"></script> --}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- js -->
    <script src="{{ asset('static/js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('static/js/yii.js') }}"></script>
    <script>
        $(function() {
            // 博客删除
            $('.del-blog').click(function() {
                var that = this;
                $.ajax({
                    type: "delete",
                    url: $(that).data('url'),
                    dataType: "json",
                    success: function(response) {
                        if (response.code != 200) {
                            notiy('error', response.msg);
                            return false;
                        }
                        $(that).parents('tr').remove();
                        notiy('success', response.msg);
                    }
                });
            });
            // 博客状态
            $('.blog-status').change(function(){
                var that = this;
                $.ajax({
                    type: "patch",
                    url: $(that).data('url'),
                    dataType: "json",
                    success: function(response) {
                        if (response.code != 200) {
                            notiy('error', response.msg);
                            return false;
                        }
                        notiy('success', response.msg);
                    }
                });
            });
        });
    </script>
@endsection
