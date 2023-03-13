
<!-- 左侧跨境干货文章列表 -->
<div class="left_cont">
    <div class="clear"></div>
    <div class="wenzhang_nav">
        <div class="article_type fenlei_article_style current_select_type" category="0" id="category_0">全部</div>
        <div class="article_type fenlei_article_style" id="category_1">前端</div>
        <div class="article_type fenlei_article_style" id="category_2">后端</div>
    </div>

    <ul class="article_body" style="margin-top: 30px;">
        <input type="hidden" id="dataCount" value="{{ $blogs->total() }}">
        <input type="hidden" id="thisPage" value="1">

        @foreach ($blogs as $blog)
        <li class="article_li">
            <dl class="wz_info clearfix">
                <dt>
                    <span class="labelBg{{ $blog->category_id }} categoryLabel">{{ $categorys[$blog->category_id] }}</span>
                    <a href="{{ route('blog.show', $blog) }}" target="_blank" title="{{ $blog->title }}" data-ac="{{ $categorys[$blog->category_id] }}">
                        <img class="lazy" data-original="/static/images/35sdg5ds4g.gif" alt="{{ $blog->title }}" style="display: inline;">
                    </a>
                </dt>
                <dd>
                    <h4>
                        <a href="{{ route('blog.show', $blog) }}" target="_blank" title="{{ $blog->title }}">{{ $blog->title }}</a>
                    </h4>
                    <div class="bot_tips">
                        <span class="color-aaa font12">
                            <!-- 作者 -->
                            <a href="{{ route('blog.show', $blog) }}" target="_blank" class="pr15 a-small">{{ $blog->user->name }}</a>
                            <span class="fr pr10">
                            </span>
                        </span>
                    </div>
                    <p><a href="{{ route('blog.show', $blog) }}" title="描述">描述</a></p>
                    <div class="tags_div_jzc tags_and_time">
                        <div class="tagItems">

                            <span class="keyword_span">
                                <a href="">标签</a>
                            <span>

                        </div>
                        <div class="publish_time">
                            <img class="publish_time-img" style="" src="/static/images/6b13cde4eec0be19.png" title="发布时间" alt="发布时间">
                            <span>{{ $blog->updated_at->diffForHumans() }}<span>
                            </span></span>
                        </div>
                    </div>
                </dd>
            </dl>
        </li>
        @endforeach

    </ul>
    {{-- {{ $blogs->appends(['keyword' => request()->query('keyword')])->links() }} --}}
    {{ $blogs->withQueryString()->links() }}
    {{-- <div class="load-more" id="index_more" onclick="getMoreArticle()">
        加载更多
    </div> --}}
</div>
