@php
    $logo = setting('site_logo', '');
    $brand = setting('site_brand', '');
    $title = isset($title) ? $title : setting('site_homepage_title', '');
@endphp
<div class="head @hasSection('navclass') @yield('navclass') @else head-c @endif header_nav1" id="nav">
    <div class="this-pc flex between">
        <div class="left flex">
            <div class="logo">
                <a class="gen-left-list-mobile" href="javascript:"><em class="fa ds-menu"></em></a>
                <a class="logo-brand" href="/">
                    @if ($logo)
                        {!! $logo !!}
                    @else
                        {!! $brand !!}
                    @endif
                </a>
            </div>
            <div class="head-nav ft4 roll bold0 pc-show1 wap-show0">
                <ul class="swiper-wrapper">
                    @foreach ($menu as $key => $item)
                        @if (count($item['children']))
                            <li class="rel head-more-menu">
                                <a class="this-get" href="{{$item['link']}}">{{$item['name']}} <em class="fa nav-more" style="font-size:18px">&#xe563;</em></a>
                                <div class="head-more none box size" style="display: none;">
                                    @foreach ($item['children'] as $children)
                                        <a href="{{$children['link']}}" class="nav-link">{{$children['name']}}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="swiper-slide"><a target="_self" href="{{$item['link']}}" class="">{{$item['name']}}</a></li>
                        @endif
                    @endforeach
                </ul>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
        </div>
        <div class="right flex">
            <div class="search-min-box">
                <form id="search" name="s" method="get" action="/">
                    <input id="dsSoInput" type="text" name="search" value="{{ request('search') }}"
                           placeholder="Tìm kiếm"
                           autocomplete="off"
                           class="input">
                    <button id="dsSo" type="submit" class="fa ds-sousuo"></button>
                </form>
                <div class="" id="result"></div>
            </div>
        </div>
    </div>

    <div class="drawer-list drawer-show" style="display: none;">
        <div class="drawer-list-bg box-bg ease" style="display: block;"></div>
        <div class="drawer-list-box bj3">
            <div class="drawer-menu cor2">
                <div class="head-user-info"
                     style="background-image: linear-gradient(to top,rgb(0 0 0 / 80%),transparent),url(/static/ds6/img/index_user.jpg);">
                    <a class="head-user" data-url="/user/index.html" href="javascript:">登录账号</a>
                </div>
            </div>
            <div class="drawer-nav drawer-scroll bold0 wap-show0" style="width: 100%;overflow-y: scroll">
                @foreach ($menu as $key => $item)
                    @if (count($item['children']))
                        <div style="color: #757474; padding: 10px 5px">{{$item['name']}}</div>
                        <div class="drawer-scroll-list" style="height: auto; margin: 0">
                            @foreach ($item['children'] as $children)
                                <a target="_self" href="{{$children['link']}}" class="nav-link none2"><em class="fa ds-dianshi"></em><em class="fa none ds-dianshi2"></em>{{$children['name']}}</a>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <div class="this-wap roll bold0 pc-show1">
        <ul class="swiper-wrapper">
            @foreach ($menu as $item)
                @if (count($item['children']))
                @else
                    <li class="swiper-slide"><a target="_self" href="{{$item['link']}}"
                                                class="">{{$item['name']}}</a></li>
                @endif
            @endforeach
        </ul>
        <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
</div>
<script type="text/javascript">
    $('#dsSoInput').on('keyup', function () {
        $("#result").html('');
        $value = $(this).val();
        if (!$value) {
            $("#result").html('');
            return;
        }
        $.ajax({
            type: 'get',
            url: '{{ URL::to('search') }}',
            data: {
                'search': $value
            },
            success: function (data) {
                $("#result").html('')
                $.each(data, function (key, value) {
                    $('#result').append('<a href="' + value.slug + '"><div class="rowsearch"> <div class="column lefts"> <img src="' + value.image + '" width="50" /> </div> <div class="column rights"><p> ' + value.title + ' ' + '</p><p> ' + value.original_title + '| ' + value.year + ' </p></div> </div></a>')
                });
            }
        });
    })
    document.body.addEventListener("click", function (event) {
        $("#result").html('');
    });
    $.ajaxSetup({headers: {'csrftoken': '{{ csrf_token() }}'}});
</script>
