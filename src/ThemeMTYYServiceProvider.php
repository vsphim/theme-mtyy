<?php

namespace VsMov\ThemeMTYY;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class ThemeMTYYServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->setupDefaultThemeCustomizer();
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views/', 'themes');

        $this->publishes([
            __DIR__ . '/../resources/assets' => public_path('themes/mtyy')
        ], 'mtyy-assets');
    }

    protected function setupDefaultThemeCustomizer()
    {
        config(['themes' => array_merge(config('themes', []), [
            'mtyy' => [
                'name' => 'Theme MTYY',
                'author' => 'dev.ohpim.cc',
                'package_name' => 'vsmov/theme-mtyy',
                'publishes' => ['mtyy-assets'],
                'preview_image' => '',
                'options' => [
                    [
                        'name' => 'per_page_limit',
                        'label' => 'Pages limit',
                        'type' => 'number',
                        'value' => 24,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'movie_related_limit',
                        'label' => 'Movies related limit',
                        'type' => 'number',
                        'value' => 14,
                        'wrapperAttributes' => [
                            'class' => 'form-group col-md-4',
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'home_page_slider_poster',
                        'label' => 'Home page slider poster',
                        'type' => 'text',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit',
                        'value' => 'Slide||is_recommended|1|updated_at|desc|10',
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'home_page_slider_thumb',
                        'label' => 'Home page slider thumb',
                        'type' => 'text',
                        'hint' => 'Label|relation|find_by_field|value|sort_by_field|sort_algo|limit|show_more_url',
                        'value' => 'Phim mới cập nhật||is_copyright|0|updated_at|desc|24|#',
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'latest',
                        'label' => 'Home Page',
                        'type' => 'code',
                        'hint' => 'display_label|relation|find_by_field|value|limit|show_more_url|show_template (section_thumb|section_side)',
                        'value' => <<<EOT
                        Phim chiếu rạp||is_shown_in_theater|1|updated_at|desc|16|/danh-sach/phim-chieu-rap|section_thumb
                        Phim bộ mới||type|series|updated_at|desc|16|/danh-sach/phim-bo|section_thumb
                        Phim lẻ mới||type|single|updated_at|desc|16|/danh-sach/phim-le|section_thumb
                        Hoạt hình|categories|slug|hoat-hinh|updated_at|desc|14|/the-loai/hoat-hinh|section_side
                        EOT,
                        'attributes' => [
                            'rows' => 5
                        ],
                        'tab' => 'List'
                    ],
                    [
                        'name' => 'additional_css',
                        'label' => 'Additional CSS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'body_attributes',
                        'label' => 'Body attributes',
                        'type' => 'text',
                        'value' => 'class="theme2"',
                        'tab' => 'Custom CSS'
                    ],
                    [
                        'name' => 'additional_header_js',
                        'label' => 'Header JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_body_js',
                        'label' => 'Body JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'additional_footer_js',
                        'label' => 'Footer JS',
                        'type' => 'code',
                        'value' => "",
                        'tab' => 'Custom JS'
                    ],
                    [
                        'name' => 'footer',
                        'label' => 'Footer',
                        'type' => 'code',
                        'value' => <<<EOT
                        <div class="footer">
                            <div class="box-width">
                                <div class="footer-show">
                                    <div class="footer-title">Trải nghiệm tuyệt vời nhất, tất cả đều có tại VsMov</div>
                                    <div class="footer-desc"><span class="footer-n">vsmov.com</span><span>Xem miễn phí số lượng lớn tài nguyên có độ phân giải cực cao</span></div>
                                    <div class="footer-content">
                                        <a href="#" class="footer-phone"><span class="fa r6 ds-yinyue"></span><span>Mobile</span></a>
                                        <a href="#" class="footer-tv"><span class="fa r6 ds-yingyong"></span><span>Tivi</span></a>
                                        <a href="#" class="footer-computer"><span class="fa r6 ds-faxian"></span><span>Desktop</span></a>
                                    </div>
                                </div>
                                <div class="footer-line-top"></div>
                                <div class="footer-copy">
                                    <p class="footer-link"><a href="" target="_blank" rel="nofollow">Telegram</a><a href=""
                                                                                                                     target="_blank">Đánh giá</a><a
                                                href="" target="_blank">VsMov</a></p>
                                    <p class="copyright">@ 2024 <a href="/"></a> All rights reservd.</p>
                                    <p class="copyright">Tất cả các tài nguyên đều đến từ Internet Nếu có bất kỳ hành vi xâm phạm quyền nào của bạn, vui lòng liên hệ với chúng tôi.</p>
                                </div>
                            </div>
                        </div>
                        EOT,
                        'tab' => 'Custom HTML'
                    ],
                    [
                        'name' => 'ads_header',
                        'label' => 'Ads header',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ],
                    [
                        'name' => 'ads_catfish',
                        'label' => 'Ads catfish',
                        'type' => 'code',
                        'value' => '',
                        'tab' => 'Ads'
                    ]
                ],
            ]
        ])]);
    }
}
