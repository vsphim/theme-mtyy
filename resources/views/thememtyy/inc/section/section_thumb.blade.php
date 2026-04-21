<div class="box-width tv4 wow fadeInUp">
    <div class="title top10">
        <h4 class="title-h cor4">
            <a target="_self" href="{{$item['link']}}" class="ds-line22 more">
                <span>{{$item['label']}}</span>
                <span class="this-get">
                    <i class="this-hide">Xem thêm</i>
                    <i class="fa ds-jiantouyou"></i>
                </span>
            </a>
        </h4>
    </div>
    <div class="flex wrap border-box public-r hide-b-16">
        @foreach ($item['data'] as $movie)
            @include('themes::thememtyy.inc.section.movie_card')
        @endforeach
    </div>
</div>
