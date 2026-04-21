@extends('themes::thememtyy.layout')

@php
    $years = Cache::remember('all_years', \Backpack\Settings\app\Models\Setting::get('site_cache_ttl', 5 * 60), function () {
        return \VsMov\Core\Models\Movie::select('publish_year')
            ->distinct()
            ->pluck('publish_year')
            ->sortDesc();
    });
@endphp
@section('content')
    <div style="display:none">{{ $section_name ?? 'Danh Sách Phim' }}</div>
    <div class="box-width wow fadeInUp ec-casc-list animated" style="visibility: visible; animation-name: fadeInUp;">
        <div class="title flex between top20">
            <div class="title-left">
                <h4 class="title-h cor4">{{ $section_name ?? 'Danh Sách Phim' }}</h4>
            </div>
        </div>
        <div class="overflow">
        </div>
        <div class="flex wrap border-box public-r">
            @if (count($data))
                @foreach ($data as $movie)
                    @include('themes::thememtyy.inc.section.movie_card')
                @endforeach
            @else
                <p class="text-danger">Không có dữ liệu cho mục này</p>
            @endif

        </div>
        {{ $data->appends(request()->all())->links("themes::thememtyy.inc.pagination") }}
    </div>
@endsection
