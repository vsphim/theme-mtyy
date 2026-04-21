@extends('themes::thememtyy.layout')
@section('content')
    <div class="box-width">
        <div class="player-style-2">
            <div class="player-top box radius">
                <style>.MacPlayer {
                        width: 100%;
                        height: 100%;
                    }

                    #jwplayer {
                        height: 100% !important;
                    }

                    .active-server {
                        background: #505054 !important;
                    }
                </style>
                <div class="MacPlayer">
                    <div id="player-wrapper" style="height: 100%!important;"></div>
                </div>
            </div>
        </div>
        <div class="player-info cor4">
            <div class="fun flex between radius">
                <a class="play-tips-bnt item cor5 load-icon-on"><i class="fa r6"></i>Chọn Server</a>
            </div>
            <div class="tips-box radius none">
                <div class="video-info-aux">
                    @foreach ($currentMovie->episodes->where('slug', $episode->slug)->where('server', $episode->server) as $server)
                        <a onclick="chooseStreamingServer(this)" data-type="{{ $server->type }}" id="streaming-sv"
                           data-id="{{ $server->id }}"
                           data-link="{{ $server->link }}" class="streaming-server tag-link "
                           style="background: #303033;color: #FFF;padding: 10px;border-radius: 10px;margin: 5px">
                            Nguồn #{{ $loop->index + 1 }}
                        </a>
                    @endforeach
                </div>
            </div>
            <div class="player-info-text cor4 top20 slide-desc-box">
                <div class="title">
                    <h2 class="title-h cor4">
                        <a target="_self" href="{{ $currentMovie->getUrl() }}" class="ds-line22 more">
                            <span>{{ $currentMovie->name }}</span>
                            <span class="this-get"><i class="this-hide">Chi tiết</i><i class="fa ds-jiantouyou"></i></span>
                        </a>Tập {{ $episode->name }} </h2>
                </div>
                <div class="this-desc-labels flex">
                    <span class="this-tag this-b"><i class="focus-item-label-rank">Năm</i>{{ $currentMovie->publish_year }}</span>
                </div>
                <div class="this-desc-info">
                    <span class="this-desc-score cor6"><i class="ds-shoucang fa"></i> {{$currentMovie->getRatingStar()}}</span>
                    {!! $currentMovie->regions->map(function ($region) {
                       return '<span>' . $region->name . '</span>';
                   })->implode('') !!}
                    {!! $currentMovie->directors->map(function ($director) {
                       return '<span>' . $director->name . '</span>';
                   })->implode('') !!}
                </div>
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
                <div class="this-desc-tags" style="margin-top: 10px">
                    {!! $currentMovie->tags->map(function ($tag) {
                        return ' <span>' . $tag->name . '</span>';
                    })->implode('') !!}
                </div>

                <div class="this-desc">
                    <div id="height_limit" class="text">
                        <em class="cor5">Nội dung：</em>　{!! strip_tags($currentMovie->content) !!}
                    </div>
                    <div class="text-open">
                        <span class="tim-bnt"><i class="fa r6 ease"></i>Xem thêm</span>
                    </div>
                </div>
                <div class="wow fadeInUp wr-list animated" style="visibility: visible; animation-name: fadeInUp;">
                    <div class="actor-new public-r">
                        <div class="ds-r-hide actor-roll swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden">
                            <ul class="swiper-wrapper">
                               @foreach($currentMovie->actors as $actor)
                                <li class="public-list-box public-pic-e swiper-slide swiper-slide-active"
                                    style="width: 146.556px; margin-right: 30px;">
                                    <div class="public-list-div">
                                        <a target="_self" class="public-list-exp"
                                           href="{{$actor->getUrl()}}"
                                           title="{{$actor->name}}">
                                            <img class="lazy lazy3 mask-1 br-100 entered loaded"
                                                 alt="{{$actor->name}}"
                                                 referrerpolicy="no-referrer"
                                                 src=""
                                                 data-src=""
                                                 data-ll-status="loaded">
                                        </a>
                                    </div>
                                    <div class="public-list-button">
                                        <a target="_self" class="time-title hide ft4"
                                           href="{{$actor->getUrl()}}"
                                           title="{{$actor->name}}">{{$actor->name}}</a>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <script>
                    new Swiper('.actor-roll', {
                        slidesPerView: 6,
                        slidesPerGroup: 6,
                        observer: true,
                        spaceBetween: 8,
                        navigation: {nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev',},
                        breakpoints: {
                            1692: {slidesPerView: 11, slidesPerGroup: 11, spaceBetween: 30,},
                            1330: {slidesPerView: 9, slidesPerGroup: 9, spaceBetween: 30,},
                            993: {slidesPerView: 7, slidesPerGroup: 7, spaceBetween: 30,},
                            560: {slidesPerView: 5, slidesPerGroup: 5, spaceBetween: 15,},
                        }
                    });
                </script>
            </div>
            <div class="title flex between top20">
                <div class="title-left">
                    <h4 class="title-h cor4">Danh sách tập</h4>
                </div>
            </div>
            @foreach ($currentMovie->episodes->sortBy([['server', 'asc']])->groupBy('server') as $server => $data)
            <div class="anthology-tab nav-swiper top10 swiper-initialized swiper-horizontal swiper-pointer-events swiper-free-mode">
                <div class="swiper-wrapper"
                     style="transition-duration: 300ms; transform: translate3d(0px, 0px, 0px);">
                    <a class="vod-playerUrl swiper-slide on nav-dt"
                       role="group"
                       aria-label="1 / 2"><i class="fa"></i>{{ $server }}</a>

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>
            <div class="player-list-box top20">
                <div class="anthology-list select-a">
                    <div class="anthology-list-box none dx">
                        <ul class="anthology-list-play size">
                            @foreach ($data->sortBy('name', SORT_NATURAL)->groupBy('name') as $name => $item)
                            <li class="box border on ecnav-dt">
                                <a class="hide cor4" href="{{ $item->sortByDesc('type')->first()->getUrl() }}">
                                    <span>{{ $name }}</span>
                                    @if ($item->contains($episode)) <em class="play-on"><i></i><i></i><i></i><i></i></em> @endif</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="ds-comments top20">
                <div class="title top10">
                    <h4 class="title-h cor4">Bình luận</h4>
                </div>
                <div style="width: 100%; background-color: #fff;margin-top: 10px">
                    <div class="fb-comments w-full" data-href="{{ $currentMovie->getUrl() }}" data-width="100%"
                         data-numposts="5" data-colorscheme="light" data-lazy="true">
                    </div>
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
@endsection

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

    <script src="/themes/mtyy/player/js/p2p-media-loader-core.min.js"></script>
    <script src="/themes/mtyy/player/js/p2p-media-loader-hlsjs.min.js"></script>

    <script src="/js/jwplayer-8.9.3.js"></script>
    <script src="/js/hls.min.js"></script>
    <script src="/js/jwplayer.hlsjs.min.js"></script>

    <script>
        var episode_id = {{ $episode->id }};
        const wrapper = document.getElementById('player-wrapper');
        const vastAds = "{{ Setting::get('jwplayer_advertising_file') }}";

        function chooseStreamingServer(el) {
            const type = el.dataset.type;
            const link = el.dataset.link.replace(/^http:\/\//i, 'https://');
            const id = el.dataset.id;

            const newUrl =
                location.protocol +
                "//" +
                location.host +
                location.pathname.replace(`-${episode_id}`, `-${id}`);

            history.pushState({
                path: newUrl
            }, "", newUrl);
            episode_id = id;


            Array.from(document.getElementsByClassName('streaming-server')).forEach(server => {
                server.classList.remove('active-server');
            })
            el.classList.add('active-server');

            link.replace('http://', 'https://');
            renderPlayer(type, link, id);
        }

        function renderPlayer(type, link, id) {
            if (type == 'embed') {
                if (vastAds) {
                    wrapper.innerHTML = `<div id="fake_jwplayer"></div>`;
                    const fake_player = jwplayer("fake_jwplayer");
                    const objSetupFake = {
                        key: "{{ Setting::get('jwplayer_license') }}",
                        aspectratio: "16:9",
                        width: "100%",
                        file: "/themes/vung/player/1s_blank.mp4",
                        volume: 100,
                        mute: false,
                        autostart: true,
                        advertising: {
                            tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                            client: "vast",
                            vpaidmode: "insecure",
                            skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                            skipmessage: "Bỏ qua sau xx giây",
                            skiptext: "Bỏ qua"
                        }
                    };
                    fake_player.setup(objSetupFake);
                    fake_player.on('complete', function (event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adSkipped', function (event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });

                    fake_player.on('adComplete', function (event) {
                        $("#fake_jwplayer").remove();
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                        fake_player.remove();
                    });
                } else {
                    if (wrapper) {
                        wrapper.innerHTML = `<iframe width="100%" height="100%" src="${link}" frameborder="0" scrolling="no"
                    allowfullscreen="" allow='autoplay'></iframe>`
                    }
                }
                return;
            }

            if (type == 'm3u8' || type == 'mp4') {
                wrapper.innerHTML = `<div id="jwplayer"></div>`;
                const player = jwplayer("jwplayer");
                const objSetup = {
                    key: "{{ Setting::get('jwplayer_license') }}",
                    aspectratio: "16:9",
                    width: "100%",
                    image: "{{ $currentMovie->getPosterUrl() }}",
                    file: link,
                    playbackRateControls: true,
                    playbackRates: [0.25, 0.75, 1, 1.25],
                    sharing: {
                        sites: [
                            "reddit",
                            "facebook",
                            "twitter",
                            "googleplus",
                            "email",
                            "linkedin",
                        ],
                    },
                    volume: 100,
                    mute: false,
                    autostart: true,
                    logo: {
                        file: "{{ Setting::get('jwplayer_logo_file') }}",
                        link: "{{ Setting::get('jwplayer_logo_link') }}",
                        position: "{{ Setting::get('jwplayer_logo_position') }}",
                    },
                    advertising: {
                        tag: "{{ Setting::get('jwplayer_advertising_file') }}",
                        client: "vast",
                        vpaidmode: "insecure",
                        skipoffset: {{ (int) Setting::get('jwplayer_advertising_skipoffset') ?: 5 }}, // Bỏ qua quảng cáo trong vòng 5 giây
                        skipmessage: "Bỏ qua sau xx giây",
                        skiptext: "Bỏ qua"
                    }
                };

                if (type == 'm3u8') {
                    const segments_in_queue = 50;

                    var engine_config = {
                        debug: !1,
                        segments: {
                            forwardSegmentCount: 50,
                        },
                        loader: {
                            cachedSegmentExpiration: 864e5,
                            cachedSegmentsCount: 1e3,
                            requiredSegmentsPriority: segments_in_queue,
                            httpDownloadMaxPriority: 9,
                            httpDownloadProbability: 0.06,
                            httpDownloadProbabilityInterval: 1e3,
                            httpDownloadProbabilitySkipIfNoPeers: !0,
                            p2pDownloadMaxPriority: 50,
                            httpFailedSegmentTimeout: 500,
                            simultaneousP2PDownloads: 20,
                            simultaneousHttpDownloads: 2,
                            // httpDownloadInitialTimeout: 12e4,
                            // httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpDownloadInitialTimeout: 0,
                            httpDownloadInitialTimeoutPerSegment: 17e3,
                            httpUseRanges: !0,
                            maxBufferLength: 300,
                            // useP2P: false,
                        },
                    };
                    if (Hls.isSupported() && p2pml.hlsjs.Engine.isSupported()) {
                        var engine = new p2pml.hlsjs.Engine(engine_config);
                        player.setup(objSetup);
                        jwplayer_hls_provider.attach();
                        p2pml.hlsjs.initJwPlayer(player, {
                            liveSyncDurationCount: segments_in_queue, // To have at least 7 segments in queue
                            maxBufferLength: 300,
                            loader: engine.createLoaderClass(),
                        });
                    } else {
                        player.setup(objSetup);
                    }
                } else {
                    player.setup(objSetup);
                }


                const resumeData = 'OPCMS-PlayerPosition-' + id;
                player.on('ready', function () {
                    if (typeof (Storage) !== 'undefined') {
                        if (localStorage[resumeData] == '' || localStorage[resumeData] == 'undefined') {
                            console.log("No cookie for position found");
                            var currentPosition = 0;
                        } else {
                            if (localStorage[resumeData] == "null") {
                                localStorage[resumeData] = 0;
                            } else {
                                var currentPosition = localStorage[resumeData];
                            }
                            console.log("Position cookie found: " + localStorage[resumeData]);
                        }
                        player.once('play', function () {
                            console.log('Checking position cookie!');
                            console.log(Math.abs(player.getDuration() - currentPosition));
                            if (currentPosition > 180 && Math.abs(player.getDuration() - currentPosition) >
                                5) {
                                player.seek(currentPosition);
                            }
                        });
                        window.onunload = function () {
                            localStorage[resumeData] = player.getPosition();
                        }
                    } else {
                        console.log('Your browser is too old!');
                    }
                });

                player.on('complete', function () {
                    if (typeof (Storage) !== 'undefined') {
                        localStorage.removeItem(resumeData);
                    } else {
                        console.log('Your browser is too old!');
                    }
                })

                function formatSeconds(seconds) {
                    var date = new Date(1970, 0, 1);
                    date.setSeconds(seconds);
                    return date.toTimeString().replace(/.*(\d{2}:\d{2}:\d{2}).*/, "$1");
                }
            }
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const episode = '{{ $episode->id }}';
            let playing = document.querySelector(`[data-id="${episode}"]`);
            if (playing) {
                playing.click();
                return;
            }

            const servers = document.getElementsByClassName('streaming-server');
            if (servers[0]) {
                servers[0].click();
            }
        });
    </script>

    {!! setting('site_scripts_facebook_sdk') !!}
@endpush
