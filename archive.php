<?php
/**
 * Archive template.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<?php if (have_posts()): ?>
    <div class="archive-posts">
        <?php while (have_posts()): the_post(); ?>
            <?php get_template_part('template-parts/content'); ?>
        <?php endwhile; ?>
    </div>
    
    <?php TailPress\Pagination::render(); ?>
<?php else: ?>
    <div class="text-center py-12">
        <h2 class="text-2xl font-semibold mb-4"><?php _e('No posts found', 'tailpress'); ?></h2>
        <p class="text-zinc-600"><?php _e('It looks like nothing was found in this archive.', 'tailpress'); ?></p>
    </div>
<?php endif; ?>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => true,
    'page_title' => icrp_get_archive_title(),
    'page_description' => icrp_get_archive_description(),
];

icrp_layout($content, $layout_args);