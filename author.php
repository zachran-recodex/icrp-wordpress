<?php
/**
 * Author archive template.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<div class="author-info bg-light/30 rounded-xl p-6 mb-8">
    <div class="flex items-center gap-4">
        <div class="flex-shrink-0">
            <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', ['class' => 'w-20 h-20 rounded-full']); ?>
        </div>
        <div>
            <h2 class="text-2xl font-semibold text-zinc-900 mb-2"><?php the_author(); ?></h2>
            <?php if (get_the_author_meta('description')): ?>
                <p class="text-zinc-600"><?php echo get_the_author_meta('description'); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php if (have_posts()): ?>
    <div class="author-posts">
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/content'); ?>
        <?php endwhile; ?>
    </div>
    
    <?php TailPress\Pagination::render(); ?>
<?php else: ?>
    <div class="text-center py-12">
        <h2 class="text-2xl font-semibold mb-4"><?php _e('No posts found', 'tailpress'); ?></h2>
        <p class="text-zinc-600"><?php _e('This author has not published any posts yet.', 'tailpress'); ?></p>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => true,
    'page_title' => sprintf(__('Posts by %s', 'tailpress'), get_the_author()),
    'page_description' => sprintf(__('All posts published by %s', 'tailpress'), get_the_author()),
    'sidebar' => true,
];

icrp_layout($content, $layout_args);