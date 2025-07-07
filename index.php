<?php
/**
 * Main template file for displaying posts.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <?php get_template_part('template-parts/content', is_singular() ? 'single' : ''); ?>
    <?php endwhile; ?>

    <?php TailPress\Pagination::render(); ?>
<?php else: ?>
    <div class="text-center py-12">
        <h2 class="text-2xl font-semibold mb-4"><?php _e('No posts found', 'tailpress'); ?></h2>
        <p class="text-zinc-600"><?php _e('It looks like nothing was found at this location.', 'tailpress'); ?></p>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => !is_front_page(),
    'page_title' => !is_singular() ? icrp_get_archive_title() : '',
    'page_description' => !is_singular() ? icrp_get_archive_description() : '',
];

icrp_layout($content, $layout_args);
