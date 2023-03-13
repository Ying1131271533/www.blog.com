<!-- 右边的卡片 -->
<div class="march-activit">

    <div class="header">
        <div class="left">
            <svg class="icon" aria-hidden="true">
                <use xlink:href="#icon-canjiapeixun"></use>
            </svg>
            <div class="text">角色资料</div>
        </div>
        <a class="goMore" href="/" target="_blank" rel="noreferrer"><span>更多</span><i></i></a>
    </div>

    <a href="
    @if (isset($category_id) && !empty($category_id))
    {{ route('index', ['category_id' => $category_id]) }}
    @else
    {{ route('index') }}
    @endif
    ">
        <div class="march-item">
            <div class="img"><img src="{{ $image }}" style="width:100px" alt=""></div>
            <div class="container">
                <div class="title_mj">{{ $title }}</div>
                <div class="tip">
                    <div class="active">{{ $content }}</div>
                    <div class="hover">{{ $count }}</div>
                </div>
            </div>
        </div>
    </a>
</div>
