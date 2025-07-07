<?php
/**
 * Universal layout template for all pages
 *
 * @package TailPress
 */

function icrp_layout($content, $args = []) {
    $defaults = [
        'show_header' => true,
        'show_footer' => true,
        'container_class' => 'container mx-auto',
        'content_class' => 'space-y-24 lg:space-y-32',
        'page_title' => '',
        'page_description' => '',
        'show_breadcrumbs' => false,
        'sidebar' => false,
        'custom_header' => null,
        'custom_footer' => null
    ];
    
    $args = wp_parse_args($args, $defaults);
    
    if ($args['show_header']) {
        get_header();
    }
    ?>
    
    <?php if ($args['custom_header']): ?>
        <div class="custom-header">
            <?php echo $args['custom_header']; ?>
        </div>
    <?php endif; ?>
    
    <?php if ($args['page_title'] || $args['page_description']): ?>
        <div class="page-header bg-light/30 py-12">
            <div class="<?php echo esc_attr($args['container_class']); ?>">
                <?php if ($args['show_breadcrumbs']): ?>
                    <nav class="breadcrumbs text-sm text-zinc-600 mb-4">
                        <?php icrp_breadcrumbs(); ?>
                    </nav>
                <?php endif; ?>
                
                <?php if ($args['page_title']): ?>
                    <h1 class="text-3xl md:text-4xl font-semibold text-zinc-900 mb-4">
                        <?php echo wp_kses_post($args['page_title']); ?>
                    </h1>
                <?php endif; ?>
                
                <?php if ($args['page_description']): ?>
                    <p class="text-lg text-zinc-600 leading-relaxed">
                        <?php echo wp_kses_post($args['page_description']); ?>
                    </p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    
    <div class="main-content py-12">
        <div class="<?php echo esc_attr($args['container_class']); ?>">
            <?php if ($args['sidebar']): ?>
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                    <div class="lg:col-span-2">
                        <div class="<?php echo esc_attr($args['content_class']); ?>">
                            <?php echo $content; ?>
                        </div>
                    </div>
                    <div class="lg:col-span-1">
                        <?php get_sidebar(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="<?php echo esc_attr($args['content_class']); ?>">
                    <?php echo $content; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    
    <?php if ($args['custom_footer']): ?>
        <div class="custom-footer">
            <?php echo $args['custom_footer']; ?>
        </div>
    <?php endif; ?>
    
    <?php
    if ($args['show_footer']) {
        get_footer();
    }
}

function icrp_breadcrumbs() {
    if (is_front_page()) {
        return;
    }
    
    $breadcrumbs = [];
    $breadcrumbs[] = '<a href="' . home_url('/') . '" class="hover:text-primary">Home</a>';
    
    if (is_category()) {
        $breadcrumbs[] = '<span class="current">Category: ' . single_cat_title('', false) . '</span>';
    } elseif (is_tag()) {
        $breadcrumbs[] = '<span class="current">Tag: ' . single_tag_title('', false) . '</span>';
    } elseif (is_author()) {
        $breadcrumbs[] = '<span class="current">Author: ' . get_the_author() . '</span>';
    } elseif (is_day()) {
        $breadcrumbs[] = '<span class="current">Daily Archives: ' . get_the_date() . '</span>';
    } elseif (is_month()) {
        $breadcrumbs[] = '<span class="current">Monthly Archives: ' . get_the_date('F Y') . '</span>';
    } elseif (is_year()) {
        $breadcrumbs[] = '<span class="current">Yearly Archives: ' . get_the_date('Y') . '</span>';
    } elseif (is_search()) {
        $breadcrumbs[] = '<span class="current">Search Results: ' . get_search_query() . '</span>';
    } elseif (is_404()) {
        $breadcrumbs[] = '<span class="current">Page Not Found</span>';
    } elseif (is_single()) {
        $category = get_the_category();
        if ($category) {
            $breadcrumbs[] = '<a href="' . get_category_link($category[0]->term_id) . '" class="hover:text-primary">' . $category[0]->name . '</a>';
        }
        $breadcrumbs[] = '<span class="current">' . get_the_title() . '</span>';
    } elseif (is_page()) {
        $breadcrumbs[] = '<span class="current">' . get_the_title() . '</span>';
    } elseif (is_archive()) {
        $breadcrumbs[] = '<span class="current">' . get_the_archive_title() . '</span>';
    }
    
    echo implode(' <span class="separator text-zinc-400">/</span> ', $breadcrumbs);
}

function icrp_get_archive_title() {
    if (is_category()) {
        return single_cat_title('', false);
    } elseif (is_tag()) {
        return single_tag_title('', false);
    } elseif (is_author()) {
        return __('Posts by ', 'tailpress') . get_the_author();
    } elseif (is_day()) {
        return __('Daily Archives: ', 'tailpress') . get_the_date();
    } elseif (is_month()) {
        return __('Monthly Archives: ', 'tailpress') . get_the_date('F Y');
    } elseif (is_year()) {
        return __('Yearly Archives: ', 'tailpress') . get_the_date('Y');
    } elseif (is_search()) {
        return __('Search results for: ', 'tailpress') . get_search_query();
    } elseif (is_404()) {
        return __('Page Not Found', 'tailpress');
    } elseif (is_archive()) {
        return get_the_archive_title();
    }
    return '';
}

function icrp_get_archive_description() {
    if (is_category()) {
        return category_description();
    } elseif (is_tag()) {
        return tag_description();
    } elseif (is_author()) {
        return get_the_author_meta('description');
    } elseif (is_search()) {
        return sprintf(__('Search results for "%s"', 'tailpress'), get_search_query());
    } elseif (is_404()) {
        return __('The page you are looking for could not be found.', 'tailpress');
    } elseif (is_archive()) {
        return get_the_archive_description();
    }
    return '';
}
?>