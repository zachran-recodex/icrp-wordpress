<?php
/**
 * Search results template.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<?php if (have_posts()): ?>
    <div class="search-results">
        <?php while (have_posts()): the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class('mb-12 pb-12 border-b border-gray-200 last:border-b-0'); ?>>
                <header class="mb-4">
                    <h2 class="text-2xl font-semibold text-zinc-950 mb-2">
                        <a href="<?php the_permalink(); ?>" class="!no-underline hover:text-primary transition-colors">
                            <?php the_title(); ?>
                        </a>
                    </h2>
                    <div class="flex items-center gap-4 text-sm text-zinc-600">
                        <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished">
                            <?php echo get_the_date(); ?>
                        </time>
                        <span>by <?php the_author(); ?></span>
                        <?php if (get_post_type() !== 'post'): ?>
                            <span class="capitalize"><?php echo get_post_type(); ?></span>
                        <?php endif; ?>
                    </div>
                </header>
                
                <div class="text-zinc-600 mb-4">
                    <?php the_excerpt(); ?>
                </div>
                
                <a href="<?php the_permalink(); ?>" class="inline-flex items-center text-primary hover:text-primary/80 transition-colors text-sm font-medium">
                    <?php _e('Read more', 'tailpress'); ?>
                    <svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
            </article>
        <?php endwhile; ?>
    </div>
    
    <?php TailPress\Pagination::render(); ?>
<?php else: ?>
    <div class="text-center py-12">
        <h2 class="text-2xl font-semibold mb-4"><?php _e('No results found', 'tailpress'); ?></h2>
        <p class="text-zinc-600 mb-8">
            <?php printf(__('Sorry, no results were found for "%s". Try different keywords.', 'tailpress'), get_search_query()); ?>
        </p>
        <div class="max-w-md mx-auto">
            <?php get_search_form(); ?>
        </div>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => true,
    'page_title' => sprintf(__('Search Results for "%s"', 'tailpress'), get_search_query()),
    'page_description' => sprintf(__('Found %d results for your search.', 'tailpress'), $wp_query->found_posts),
];

icrp_layout($content, $layout_args);