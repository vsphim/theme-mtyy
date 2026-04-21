@extends('themes::layout')

@php
    $menu = \VsMov\Core\Models\Menu::getTree();

    $tops = Cache::remember('site.movies.tops', setting('site_cache_ttl', 5 * 60), function () {
        $lists = preg_split('/[\n\r]+/', get_theme_option('hotest'));
        $data = [];
        foreach ($lists as $list) {
            if (trim($list)) {
                $list = explode('|', $list);
                [$label, $relation, $field, $val, $sortKey, $alg, $limit, $template] = array_merge($list, ['Phim hot', '', 'type', 'series', 'view_total', 'desc', 4, 'top_thumb']);
                try {
                    $data[] = [
                        'label' => $label,
                        'template' => $template,
                        'data' => \VsMov\Core\Models\Movie::when($relation, function ($query) use ($relation, $field, $val) {
                            $query->whereHas($relation, function ($rel) use ($field, $val) {
                                $rel->where($field, $val);
                            });
                        })
                            ->when(!$relation, function ($query) use ($field, $val) {
                                $query->where($field, $val);
                            })
                            ->orderBy($sortKey, $alg)
                            ->limit($limit)
                            ->get(),
                    ];
                } catch (\Exception $e) {
                    # code
                }
            }
        }

        return $data;
    });
@endphp

@push('header')
    <link href="{{ asset('/themes/mtyy/ds6/css/common_version_473.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('/themes/mtyy/ds6/css/custom.css') }}" rel="stylesheet" type="text/css">
    <script src="{{ asset('/themes/mtyy/ds6/js/jquery.js') }}"></script>
    <script src="{{ asset('/themes/mtyy/ds6/js/assembly.js') }}"></script>
    <script src="{{ asset('/themes/mtyy/ds6/js/swiper.min.js') }}"></script>
    <script src="{{ asset('/themes/mtyy/ds6/js/ecscript.js') }}"></script>
    <script src="{{ asset('/themes/mtyy/ds6/js/custom.js') }}"></script>
@endpush

@section('body')
    @include('themes::thememtyy.inc.nav')
    @if (get_theme_option('ads_header'))
        {!! get_theme_option('ads_header') !!}
    @endif
    @yield('slider_recommended')
    @yield('home_page_slider_thumb')
    @yield('content')
@endsection

@section('footer')
    {!! get_theme_option('footer') !!}
    @if (get_theme_option('ads_catfish'))
        {!! get_theme_option('ads_catfish') !!}
    @endif
    {!! setting('site_scripts_google_analytics') !!}
@endsection
