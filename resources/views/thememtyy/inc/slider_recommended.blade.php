<div class="slide-a slide-b overflow slid-d rel" style="background-color:rgb(17, 19, 25)">
    <div class="slide-time-list mySwiper2 hader1">
        <div class="swiper-wrapper">
            @foreach ($home_page_slider_poster['data'] as $key => $movie)
                <div class="slide-time-bj swiper-slide">
                    <a href="{{$movie->getUrl()}}">
                        <div class="slide-time-img3 mask-1"
                             style="background-image: url({{$movie->getPosterUrl()}});"></div>
                        <div class="large-t"></div>
                        <div class="large-r"></div>
                        <div class="large-l"></div>
                        <div class="box-width flex">
                            <div class="slide-desc-box">
                                <div class="this-desc-title">{{$movie->name}}</div>
                                <div class="this-desc-labels flex">
                                    <span class="this-tag this-b"><i class="focus-item-label-rank">TOP {{$key+1}}</i>HOT</span>
                                    <span class="focus-item-label-original this-tag bj2"> {{$movie->getStatus()}}</span>
                                </div>
                                <div class="this-desc-info">
                                    <span class="this-desc-score cor6"><i
                                            class="ds-shoucang fa"></i> {{$movie->getRatingStar()}}</span>
                                    <span>{{ $movie->publish_year }}</span>
                                           {!! $movie->regions->map(function ($region) {
                                               return '<span>' . $region->name . '</span>';
                                           })->implode('') !!}
                                    <span>{{$movie->episode_current}}</span>
                                </div>
                                <div class="this-desc-tags">
                                    {!! $movie->actors->map(function ($director) {
                                            return '  <span>' . $director->name . '</span>';
                                        })->implode('') !!}
                                </div>
                                <div class="this-desc-item">　　
                                    {!! strip_tags($movie->content) !!}
                                </div>
                                <div class="this-desc-bnt flex">
                                    <span href="{{$movie->getUrl()}}" class="bj2 ho cr5"><i class="fa ds-bofang1"></i></span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
        <div class="box-width this-button">
            <div class="swiper-pagination"></div>
        </div>
    </div>
</div>
