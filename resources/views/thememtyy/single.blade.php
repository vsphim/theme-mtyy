@extends('themes::thememtyy.layout')
@php
    $watch_url = '';
    if (!$currentMovie->is_copyright && count($currentMovie->episodes) && $currentMovie->episodes[0]['link'] != '') {
        $watch_url = $currentMovie->episodes
            ->sortBy([['server', 'asc']])
            ->groupBy('server')
            ->first()
            ->sortByDesc('name', SORT_NATURAL)
            ->groupBy('name')
            ->last()
            ->sortByDesc('type')
            ->first()
            ->getUrl();
    }
@endphp

@section('content')
    <div class="ds-vod-detail rel">
        <div class="box-width rel">
            @if ($currentMovie->showtimes)
                <div class="detail-score wow fadeInUp">
                    <div class="play-sc cf">
                        <p><strong>Lịch chiếu : </strong> {{$currentMovie->showtimes}}</p>
                    </div>
                </div>
            @endif
            @if ($currentMovie->notify )
                <div class="detail-score wow fadeInUp">
                    <div class="play-sc cf">
                        <p><strong>Thông báo : </strong> {{$currentMovie->notify}}</p>
                    </div>
                </div>
            @endif
            <div class="this-bj">
                <div class="this-pic-bj"
                     style="background-image: url('{{ $currentMovie->getPosterUrl() }}')"></div>
                <div class="large-t"></div>
                <div class="large-r"></div>
                <div class="large-l"></div>
                <div class="large-b"></div>
            </div>
            <div class="slide-desc-box">
                <div class="this-desc-title">{{ $currentMovie->name }}</div>
                <div class="this-desc-labels flex">
                    <span class="this-tag this-b"><i class="focus-item-label-rank">Năm</i>{{ $currentMovie->publish_year }}</span>
                    <span class="focus-item-label-original this-tag bj2">{{$currentMovie->getStatus()}}</span>
                </div>
                <div class="this-desc-info">
                    <span class="this-desc-score cor6"><i class="ds-shoucang fa"></i> {{$currentMovie->getRatingStar()}}</span>
                    {!! $currentMovie->regions->map(function ($region) {
                       return '<span>' . $region->name . '</span>';
                   })->implode('') !!}
                    <span>{{$currentMovie->episode_current}}</span>
                </div>
                <style>
                    .play-sc {
                        cursor: pointer;
                        border-radius: 4px;
                        padding: 14px 20px;
                        width: 380px;
                        margin: 10px 0 15px 0;
                        font-weight: 700;
                        background: hsla(0, 0%, 100%, .1);
                    }
                </style>
                <div class="detail-score wow fadeInUp">
                    <div class="play-sc cf">
                        <div class="rating-content">
                            <div id="movies-rating-star" style="height: 18px;"></div>
                            <div style="margin-top: 5px">
                                ({{$currentMovie->getRatingStar()}}
                                sao
                                /
                                {{$currentMovie->getRatingCount()}} đánh giá)
                            </div>
                            <div id="movies-rating-msg"></div>
                        </div>
                    </div>
                </div>
                <div class="this-info">
                    <strong class="r6">Đạo diễn:</strong>
                    {!! $currentMovie->directors->map(function ($director) {
                        return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                    })->implode(', ') !!}

                </div>
                <div class="this-info">
                    <strong class="r6">Diễn viên:</strong> {!! $currentMovie->actors->map(function ($director) {
                        return '<a href="' . $director->getUrl() . '" title="' . $director->name . '">' . $director->name . '</a>';
                    })->implode(', ') !!}
                </div>
                <div class="this-desc">
                    <div id="height_limit" class="text">
                        <strong class="r6">Nội dung:</strong> {!! strip_tags($currentMovie->content) !!}
                    </div>
                    <div class="text-open">
                        <span class="tim-bnt"><i class="fa r6 ease"></i>Xem thêm</span>
                    </div>
                </div>
                <div class="this-bnt flex">
                    @if($watch_url)
                        <a href="{{ $watch_url }}" class="vod-detail-bnt this-play this-bnt-a cr5"><i
                                class="fa r6 ds-bofang1"></i>Xem phim</a>
                    @endif
                    @if ($currentMovie->trailer_url && strpos($currentMovie->trailer_url, 'youtube'))
                        @php
                            parse_str( parse_url( $currentMovie->trailer_url, PHP_URL_QUERY ), $my_array_of_vars );
                            $video_id = $my_array_of_vars['v'] ?? null;
                        @endphp
                        <a href="https://www.youtube.com/embed/{{$video_id}}"
                           class="this-play this-bnt-a cr5 fancybox fancybox.iframe"><i
                                class="fa r6 ds-bofang1"></i>Trailer</a>

                    @endif

                </div>
            </div>
        </div>
    </div>

    <div class="box-width tv4 wow fadeInUp wr-list">
        <div class="title top10">
            <h4 class="title-h cor4">Bình luận</h4>
        </div>
        <div class="flex wrap border-box public-r hide-b-12">
            <div style="width: 100%; background-color: #fff;margin-top: 10px">
                <div class="fb-comments w-full" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                     data-numposts="5" data-colorscheme="light" data-lazy="true">
                </div>
            </div>
        </div>
    </div>
    <div class="box-width tv4 wow fadeInUp wr-list">
        <div class="title top10">
            <h4 class="title-h cor4">Đề xuất</h4>
        </div>
        <div class="flex wrap border-box public-r hide-b-12">
            <div class="ds-r-hide list-swiper-b">
                <div class="swiper-wrapper">
                    @foreach ($movie_related as $movie)
                        <div class="public-list-box public-pic-b swiper-slide">
                            <div class="public-list-div public-list-bj">
                                <a target="_self" class="public-list-exp" href="{{$movie->getUrl()}}"
                                   title="{{$movie->name}}">
                                    <img class="lazy lazy1 gen-movie-img mask-0" referrerpolicy="no-referrer"
                                         src="data:image/gif;base64,iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVQImWNgYGBgAAAABQABh6FO1AAAAABJRU5ErkJggg=="
                                         alt="{{$movie->name}} {{ $movie->origin_name }}"
                                         data-src="{{$movie->getThumbUrl()}}">
                                    <span class="public-bg"></span>
                                    <span class="public-list-prb hide ft2">{{$movie->language}} {{$movie->quality}}</span>
                                    <span class="public-play"><i
                                            class="fa ds-bofang1"></i></span>
                                </a>
                            </div>
                            <div class="public-list-button">
                                <a target="_self" class="time-title hide ft4" href="{{$movie->getUrl()}}"
                                   title="{{$movie->name}}">{{$movie->name}}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="swiper-button-prev fa ds-fanhui" href="javascript:"></a><a
                    class="swiper-button-next fa ds-jiantouyou" href="javascript:"></a></div>
        </div>
    </div>
    @push('scripts')
        <script src="{{ asset('/themes/mtyy/plugins/jquery-raty/jquery.raty.js') }}"></script>
        <link href="{{ asset('/themes/mtyy/plugins/jquery-raty/jquery.raty.css') }}" rel="stylesheet" type="text/css"/>
        <script>
            var rated = false;
            $('#movies-rating-star').raty({
                score: {{$currentMovie->getRatingStar()}},
                number: 10,
                numberMax: 10,
                hints: ['quá tệ', 'tệ', 'không hay', 'không hay lắm', 'bình thường', 'xem được', 'có vẻ hay', 'hay',
                    'rất hay', 'siêu phẩm'
                ],
                starOff: '{{ asset('/themes/mtyy/plugins/jquery-raty/images/star-off.png') }}',
                starOn: '{{ asset('/themes/mtyy/plugins/jquery-raty/images/star-on.png') }}',
                starHalf: '{{ asset('/themes/mtyy/plugins/jquery-raty/images/star-half.png') }}',
                click: function (score, evt) {
                    if (rated) return
                    fetch("{{ route('movie.rating', ['movie' => $currentMovie->slug]) }}", {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]')
                                .getAttribute(
                                    'content')
                        },
                        body: JSON.stringify({
                            rating: score
                        })
                    });
                    rated = true;
                    $('#movies-rating-star').data('raty').readOnly(true);
                    $('#movies-rating-msg').html(`Bạn đã đánh giá ${score} sao cho phim này!`);
                }
            });
        </script>
        <script src="{{ asset('/themes/mtyy/source/jquery.fancybox.pack.js?v=2.1.5') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{ asset('/themes/mtyy/source/jquery.fancybox.css?v=2.1.5') }}"
              media="screen"/>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".fancybox").fancybox({
                    maxWidth: 800,
                    maxHeight: 600,
                    fitToView: false,
                    width: '70%',
                    height: '70%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none'
                });
            });
        </script>

        {!! setting('site_scripts_facebook_sdk') !!}
    @endpush

@endsection

