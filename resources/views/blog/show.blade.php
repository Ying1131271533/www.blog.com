@extends('layout.app')
@section('title', $blog->title)

@section('style')
    <!-- css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('static/css/article.css') }}">
    <style>
        .star_and_top {
            background: #fff;
            clear: both;
            border-bottom: 1px solid #ddd;
            width: 260px;
            margin-bottom: 2rem;
        }
    </style>
@endsection

<!-- 主体内容 -->
@section('content')
    <div class="container body-container">
        <div class="site-index">
            <ol class="crumbs">
                <li>
                    <a href="/">
                        <svg class="icon" aria-hidden="true">
                            <use xlink:href="#icon-shouye2"></use>
                        </svg>
                        首页
                    </a>
                </li>
                <li><a href="/"> 博客 </a></li>
                <li><a class="color-555"> {{ $blog->title }} </a></li>
            </ol>
            <div class="article-detail clearfix">
                <h1>{{ $blog->title }}</h1>
                <input type="hidden" id="user_id" name="user_id" value="{{ auth()->id() }}">
                <input type="hidden" id="blog_id" name="blog_id" value="{{ $blog->id }}">
                <input type="hidden" id="shareContent" value="【{{ $blog->title }}】">
                <div class="article-tips clearfix color-aaa">
                    <div class="sub-tips fl">
                        <span class="pr15 ">作者：神织知更</span>
                        <span class="pl15 color-aaa">发布于：{{ $blog->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="like">
                        <a href="javascript:void(0)" title="浏览量" style="color:#757575">
                            <span class="fa fa-comment-o">浏览数</span>
                            <span class="al_comment_num">{{ $blog->view }}</span>
                        </a>

                    </div>
                    <div class="tag" style="clear: both;margin-top: 30px;text-align: left;">
                        <a style="border:1px solid #ddd;color:#757575;border-radius: 20px;padding: 2px 10px;"
                            href="{:url('keyword/article', ['id' => $value.id])}">前端</a>
                    </div>
                </div>
                <!-- 内容部分 -->
                <div class="sub-text">没有描述</div>
                <div class="article-content clearfix" id='container'></div>
                <div class="h16 bg-color"></div>
                <!-- 评论区 -->
                @auth
                @include('common.success')
                @include('common.error')
                    <!-- 登录时显示 -->
                    <div class="comment-textarea-div">
                        <form method="post" action="{{ route('blog.commnet', $blog) }}" id="form-comment">
                            @csrf
                            <textarea class="input-text" type="text" id="comment" name="comment" placeholder="说点什么吧..."></textarea>
                            <div class="clearfix">
                                <div class="Avatar">
                                    <img src="{{ avatar(auth()->user()->avatar) }}" class="fl">
                                    <div class="c_aaa fl"> {{ auth()->user()->name }} </div>
                                </div>
                                <input type="hidden" name="parent_id" value="0">
                                <div class="fr sub-btn" onclick="comment({{ $blog->id }})">发表评论</div>
                            </div>
                        </form>
                    </div>
                @else
                    <!-- 未登录显示 -->
                    <div class="comment-textarea-div">
                        <div class="prompt">
                            <span><a href="{{ route('login') }}">登录</a>后参与评论</span>
                        </div>
                    </div>
                @endauth

                <!-- 评论区容器 -->
                {{-- <div class="comment_stories_list" style="display: none;"> --}}
                <div class="comment_stories_list">
                    <div class="comment-div">
                        <ul class="stories_list">
                            @forelse ($blog->comments as $id => $comment)
                            <li class="clearfix">
                                <div class="Avatar fl">
                                    <img src="{{ avatar($comment->user->avatar) }}" />
                                </div>
                                <div class="fr stories_con">

                                    @if ($comment->parent_id > 0)
                                    <div class="blockquote_wrap">
                                        <a href="javascript:">
                                            {{ $comments[$comment->parent_id]->user->name }}
                                        </a> :
                                        {{ $comments[$comment->parent_id]->content }}
                                    </div>
                                    @endif

                                    <div class="comment_subt">{{ $comment->content }}</div>
                                    <div class="clearfix to ols">
                                        <div class="fl">
                                            <div class="name fl mr30">
                                                <a href="javascript:">{{ $comment->user->name }}</a>
                                            </div>
                                            <div class="time fl">
                                                发布于 {{ $comment->updated_at->diffForHumans() }}
                                            </div>
                                        </div>
                                        <div class="fr tools2">
                                            <div class="comment" data-id="{{ $comment->id }}">回复</div>
                                        </div>
                                    </div>
                                    <div class="comment_input comment_input_{{ $comment->id }}" style="display: none;">
                                        <input type="text" id="comment_{{ $comment->id }}" placeholder="回复 {{ $comment->user->name }} : " class="c_input" />
                                        <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                                        <button class="Reply_btn" onclick="comment({{ $blog->id }},{{ $comment->id }})">回复</button>
                                    </div>
                                </div>
                            </li>
                            @empty
                            {{-- <div class="time fl">暂时没有评论</div> --}}
                            @endforelse
                        </ul>
                    </div>
                </div>

                <div class="h16 bg-color"></div>

                <!--上一篇 & 下一篇-->
                <div class="page-turning clearfix bordered">

                    <a class="col-md-6 text-center page-prev"
                        href="{$topArticle.id ? url('home/article', ['id' => $topArticle.id]) : 'javascript:;'}">
                        <div class="page-title">
                            <i class="fa fa-angle-left"></i> <span>上一篇</span>
                        </div>
                        <div class="article-title"> {$topArticle.title ? $topArticle.title : '没有了'} </div>
                    </a>

                    <a class="col-md-6 text-center page-next"
                        href="{$bottomArticle.id ? url('home/article', ['id' => $bottomArticle.id]) : 'javascript:;'}">
                        <div class="page-title">
                            <span>下一篇</span> <i class="fa fa-angle-right"></i>
                        </div>
                        <div class="article-title"> {$bottomArticle.title ? $bottomArticle.title : '没有了'} </div>
                    </a>

                </div>


            </div>

            <div class="index-right">
                @include('common.right-card', [
                    'image' => '/static/images/90D0O_11F6UO8HZS20INI.jpg',
                    'title' => $blog->category->name,
                    'content' => $blog->category->name . '相关的文章',
                    'count' => $blog->category->blogs()->count(),
                    'category_id' => $blog->category_id,
                ])
            </div>
        </div>

    </div>
@endsection

@section('script')
    <!-- js -->
    <script type="text/javascript" src="{{ asset('static/js/article.js') }}"></script>
    {{-- <script type="text/javascript" src="{{ asset('static/js/share_article.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('static/js/jquery.lazyload.js') }}"></script>

    <script>
        $('#container').html(@json($blog->content));
        $(function() {
            $(".share_div,.share_jzc").mouseover(function() {
                $(".share_jzc").show();

            }).mouseout(function() {
                $(".share_jzc").hide();
            });


        })
        window._bd_share_config = {
            "common": {
                "bdSnsKey": {
                    "tsina": "3429961073"
                },
                "bdText": $("#shareContent").val(),
                "bdMini": "2",
                "bdMiniList": false,
                "bdPic": "",
                "bdStyle": "1",
                "bdSize": "24"
            },
            "share": {}
        };
    </script>
    <script>
        window._bd_share_config = {
            "common": {
                "bdSnsKey": {
                    "tsina": "3429961073"
                },
                "bdText": $("#shareContent").val(),
                "bdMini": "2",
                "bdMiniList": false,
                "bdPic": "",
                "bdStyle": "1",
                "bdSize": "24"
            },
            "share": {}
        };
        with(document) 0[(getElementsByTagName('head')[0] || body).appendChild(createElement('script')).src =
            'https://www.caomaokj.com/static/akali/js/share.js?v=89860593.js?cdnversion=' + ~(-new Date() / 36e5)];
    </script>
@endsection
