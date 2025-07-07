<?php

if (is_file(__DIR__.'/vendor/autoload_packages.php')) {
    require_once __DIR__.'/vendor/autoload_packages.php';
}

function tailpress(): TailPress\Framework\Theme
{
    return TailPress\Framework\Theme::instance()
        ->assets(fn($manager) => $manager
            ->withCompiler(new TailPress\Framework\Assets\ViteCompiler, fn($compiler) => $compiler
                ->registerAsset('resources/css/app.css')
                ->registerAsset('resources/js/app.js')
                ->editorStyleFile('resources/css/editor-style.css')
            )
            ->enqueueAssets()
        )
        ->features(fn($manager) => $manager->add(TailPress\Framework\Features\MenuOptions::class))
        ->menus(fn($manager) => $manager->add('primary', __( 'Primary Menu', 'tailpress')))
        ->themeSupport(fn($manager) => $manager->add([
            'title-tag',
            'custom-logo',
            'post-thumbnails',
            'align-wide',
            'wp-block-styles',
            'responsive-embeds',
            'html5' => [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            ]
        ]));
}

tailpress();

// Register sidebar widget area
function icrp_widgets_init() {
    register_sidebar([
        'name'          => __('Sidebar', 'tailpress'),
        'id'            => 'sidebar-1',
        'description'   => __('Add widgets here to appear in your sidebar.', 'tailpress'),
        'before_widget' => '<div id="%1$s" class="widget %2$s bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title text-lg font-semibold text-gray-900 mb-4">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'icrp_widgets_init');

// Add custom excerpt length
function icrp_excerpt_length($length) {
    return 25;
}
add_filter('excerpt_length', 'icrp_excerpt_length');

// Custom excerpt more text
function icrp_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'icrp_excerpt_more');

// Add theme support for editor color palette
function icrp_add_editor_color_palette() {
    add_theme_support('editor-color-palette', [
        [
            'name'  => __('Primary', 'tailpress'),
            'slug'  => 'primary',
            'color' => '#2C7FFF',
        ],
        [
            'name'  => __('Secondary', 'tailpress'),
            'slug'  => 'secondary',
            'color' => '#FD9A00',
        ],
        [
            'name'  => __('Dark', 'tailpress'),
            'slug'  => 'dark',
            'color' => '#18181C',
        ],
        [
            'name'  => __('Light', 'tailpress'),
            'slug'  => 'light',
            'color' => '#F4F4F5',
        ],
    ]);
}
add_action('after_setup_theme', 'icrp_add_editor_color_palette');

// Enqueue block editor styles
function icrp_block_editor_styles() {
    wp_enqueue_style('icrp-block-editor-styles', get_template_directory_uri() . '/resources/css/editor-style.css');
}
add_action('enqueue_block_editor_assets', 'icrp_block_editor_styles');
