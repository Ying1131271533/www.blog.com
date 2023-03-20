@extends('layout.app')

@section('style')
    <!-- css -->
    <link rel="stylesheet" href="{{ asset('static/css/swiper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/laypage.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/index.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('static/css/main-pc-kant.css') }}">
    <style>
        circle {
            -webkit-transition: stroke-dasharray .25s;
            transition: stroke-dasharray .25s;
        }

        body .swiper-pagination-white .swiper-pagination-bullet-active,
        body .swiper-pagination-white .swiper-pagination-bullet {
            background: transparent;
        }

        body .swiper-container-horizontal>.swiper-pagination-bullets,
        body .swiper-pagination-custom,
        .swiper-pagination-fraction {
            background: rgba(0, 0, 0, .15);
            opacity: 1;
            width: auto;
            left: 50%;
            transform: translateX(-50%);
            padding: 4px 4%;
            border-radius: 20px;
            -webkit-border-radius: 20px;
            -moz-border-radius: 20px;
        }

        body .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet {
            margin: 0 12px;
        }

        body .swiper-container-horizontal>.swiper-pagination-bullets .swiper-pagination-bullet:first-child {
            margin-left: 0;
        }
    </style>
@endsection

@section('content')
    <!-- 主体内容 -->
    <div class="container body-container">
        <!-- banner -->
        <div class="top clearfix">
            <div class="banner" style="position: relative">

                <!-- 左 -->
                <div class="col-md-6 banner-left" style="width: 700px;">
                    <div class="swiper-container swiper-container-horizontal swiper-container-fade">
                        <!-- 轮播图 -->
                        <div class="swiper-wrapper" style="transition-duration: 0ms;">

                            <div class="swiper-slide" data-swiper-slide-index="{$key}">
                                <img alt="草帽跨境" style="width:100%;height:100%;cursor: pointer;" class="banner_href"
                                    data-type="pc" data-id="157" data-url="/" src="/static/images/20210703131756.jpg">
                            </div>

                            <div class="swiper-slide" data-swiper-slide-index="{$key}">
                                <img alt="草帽跨境" style="width:100%;height:100%;cursor: pointer;" class="banner_href"
                                    data-type="pc" data-id="157" data-url="/" src="/static/images/20220128141903.jpg">
                            </div>

                        </div>

                        <!-- 轮播图下方的圈圈 -->
                        <div
                            class="swiper-pagination swiper-pagination-white swiper-pagination-clickable swiper-pagination-bullets">

                            <span class="swiper-pagination-bullet">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"
                                        stroke="rgba(255,255,255,0.5)" fill="none"></circle>
                                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#fff"
                                        fill="none" transform="matrix(0,-1,1,0,0,24)"
                                        stroke-dasharray="0 62.83185307179586"></circle>
                                </svg>
                            </span>

                            <span class="swiper-pagination-bullet">
                                <svg width="24" height="24" viewBox="0 0 24 24">
                                    <circle cx="12" cy="12" r="10" stroke-width="2"
                                        stroke="rgba(255,255,255,0.5)" fill="none"></circle>
                                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#fff"
                                        fill="none" transform="matrix(0,-1,1,0,0,24)"
                                        stroke-dasharray="0 62.83185307179586"></circle>
                                </svg>
                            </span>

                        </div>
                    </div>
                </div>

                <!-- 展示图 -->
                <div class="banner-swiper col-md-2" style="width: 19%;">
                    <div class="tuijian_div">

                        <div class="tuijian_content_div">
                            <div class="tuijian_img"><a href="/">
                            <img src="/static/images/135sd45dsfg.jpg"></a></div>
                            <div class="tuijian_title tuijian-bg2">
                                <a class="title-text ellipsis-2"  href="/">01</a>
                            </div>
                        </div>
                    </div>

                    <div class="tuijian_div">
                        <div class="tuijian_content_div">
                            <div class="tuijian_img"><a href="/">
                            <img src="/static/images/20230320093538.jpg"></a></div>
                            <div class="tuijian_title tuijian-bg2">
                                <a class="title-text ellipsis-2"  href="/">02</a>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-- 下部内容 -->
        <div class="container_div" style="margin-top: 0px">
            <!-- 博客列表 -->
            @include('index.list')
            <!-- 右侧推进内容卡片 -->
            <div class="index-right" style="margin-top:0px;">
                @include('common.right-card', [
                    'image' => '/static/images/90D0O_11F6UO8HZS20INI.jpg',
                    'title' => '阿卡丽',
                    'content' => '文章总数',
                    'count' => $blogs->total(),
                ])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- js -->
    <script src="{{ asset('static/js/swiper.min.js') }}"></script>
    <script src="{{ asset('static/js/banner_click.js') }}"></script>
    <script src="{{ asset('static/js/jquery.lazyload.js') }}"></script>
    <script src="{{ asset('static/js/home.js') }}" type="text/javascript"></script>
    <script src="{{ asset('static/js/laypage.js') }}" type="text/javascript"></script>

    <script>
        $(function() {
            var $slider = $('.top .banner .slider').css({
                width: 0
            });

            $('.top .banner .show-nav').hover(function() {
                navVisit('slider');
                var content = $(this).data('sign');
                $slider.stop(true)
                $slider.html($('#' + content).html()).attr('data-sign', content);
                $slider.css({
                    width: 0
                }).show();
                $slider.delay(0).animate({
                    width: '970px'
                }, 'fast');
            }, function() {
                $slider.delay(200).animate({
                    width: 0
                }, function() {
                    $slider.hide();
                });
            });

            $('.top .banner .slider').hover(function() {
                navVisit('click');
                $slider.stop(true)
                $slider.show().css({
                    width: '970px'
                })
            }, function() {
                $slider.stop(true)
                $slider.delay(200).animate({
                    width: 0
                }, function() {
                    $slider.hide();
                });
            });

            $('.banner .slider').on('click', 'a', function() {
                var clickItem = $(this).find('span').text();
                var parentItem = $('.banner .slider').attr('data-sign');
                $.get('/home/nav-click-log?item=' + clickItem + '&parent_item=' + parentItem);
            });

            function navVisit(type) {
                $.get('/index/index_api/navVisit?type=' + type);
            }

        });
    </script>
    <script>
        $(window).scroll(function() {
            var document_height = document.body.clientHeight - 380;
            if ($(document).scrollTop() >= $(document).height() - $(window).height()) {
                $('.right_bottom_div').css({
                    'position': 'absolute',
                    'top': document_height
                });
            } else {
                $('.right_bottom_div').css({
                    'position': 'fixed',
                    'bottom': '5px',
                    'top': ''
                });
            }
        });


        var perimeter = Math.PI * 2 * 10;
        var timer = null;
        var value = 0;

        function circleSvg() {
            value = 0;
            clearInterval(timer);

            var circle1 = $(".swiper-pagination-bullet");
            //console.log(circle1.valueOf());
            $.each(circle1, function(i, v) {
                $(v).html(
                    '<svg width="24" height="24" viewbox="0 0 24 24">\
                                <circle cx="12" cy="12" r="10" stroke-width="2" stroke="rgba(255,255,255,0.5)" fill="none"></circle>\
                                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#fff" fill="none" transform="matrix(0,-1,1,0,0,24)" stroke-dasharray="0 ' +
                    perimeter + '"></circle>\
                                </svg>');
                //console.log("=========" + i, v)
            })
            var circle = document.querySelectorAll(".swiper-pagination-bullet-active circle")[1];
            if (circle) {

                timer = setInterval(function() {
                    value++;
                    if (value == 102) {
                        value = 0;
                        circle.setAttribute('stroke-dasharray', 0 + " " + perimeter);
                        clearInterval(timer);
                        return false;
                    }
                    var percent = value / 100;
                    circle.setAttribute('stroke-dasharray', perimeter * percent + " " + perimeter * (1 - percent));

                }, 50)
            }
        }

        var swiper = new Swiper('.swiper-container', {


            pagination: '.swiper-pagination',
            paginationClickable: true,
            paginationBulletRender: function(swiper, index, className) {
                return '<span class="' + className + '">' +
                    '<svg width="24" height="24" viewbox="0 0 24 24">\
                                    <circle cx="12" cy="12" r="10" stroke-width="2" stroke="rgba(255,255,255,0.5)" fill="none"></circle>\
                                        <circle cx="12" cy="12" r="10" stroke-width="2" stroke="#fff" fill="none" transform="matrix(0,-1,1,0,0,24)" stroke-dasharray="0 ' +
                    perimeter + '"></circle>\
                                </svg>' +
                    '</span>';
            },

            spaceBetween: 30,
            effect: 'fade',
            loop: true,
            autoplay: 5000,
            autoplayDisableOnInteraction: false,
            onInit: function(swiper) {
                //Swiper初始化了
                //alert(swiper.activeIndex);提示Swiper的当前索引
                circleSvg();
            },
            onSlideChangeStart: function(swiper) {
                value = 0;
                console.log(swiper.activeIndex + '');
                // swiper.activeIndex 这个就是索引， 从 0 开始！ 可看一共有多少元素！
                circleSvg();
            },
        });

        $(function() {
            var h = $(".find-item>.table").height();

            $(".find-label_img").height(h + 2);

            $('.zhao_haiwaicang').click(function() {
                // $('.haiwaichangchu').show();
                // $('.zhuanxianwuliu').hide();
                // $(this).addClass('div_zhaowuliu_active').find('img').attr('src','https://cacwww.caomaokj.com/img/shouyetabhaiwaicang1.png');
                // $('.zhaozhuanxian').removeClass('div_zhaowuliu_active').find('img').attr('src','https://cacwww.caomaokj.com/img/shouyetabzhuanxian1.png');
                // $(this).find('p').addClass('p_zhaowuliu_active');
                // $('.zhaozhuanxian').find('p').removeClass('p_zhaowuliu_active');
            })

            $('.zhaozhuanxian').click(function() {
                // $('.haiwaichangchu').hide();
                // $('.zhuanxianwuliu').show();
                // $(this).addClass('div_zhaowuliu_active').find('img').attr('src','https://cacwww.caomaokj.com/img/shouyetabzhuanxian.png');;
                // $('.zhao_haiwaicang').removeClass('div_zhaowuliu_active').find('img').attr('src','https://cacwww.caomaokj.com/img/shouyetabhaiwaicang.png');
                // $(this).find('p').addClass('p_zhaowuliu_active');
                // $('.zhao_haiwaicang').find('p').removeClass('p_zhaowuliu_active');
            })


        })
    </script>

    <script>
        $(function() {
            $(".lazy").lazyload();

            var scrtime;
            var $ul = $("#con ul");
            var liFirstHeight = $ul.find("li:first").height();
            $ul.css({
                top: "-" + liFirstHeight - 10 + "px"
            });
            $("#con").hover(function() {
                    $ul.pause();
                    clearInterval(scrtime);
                },
                function() {
                    $ul.resume();
                    scrtime = setInterval(function scrolllist() {
                        $ul.animate({
                            top: 0 + "px"
                        },
                        1500,
                        function() {
                            $ul.find("li:last").prependTo($ul);
                            liFirstHeight = $ul.find("li:first").height();
                            $ul.css({
                                top: "-" + liFirstHeight - 10 + "px"
                            });
                        });
                    },
                    3300);
                }).trigger("mouseleave");
        });
    </script>
@endsection
