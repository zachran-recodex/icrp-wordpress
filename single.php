<?php
/**
 * Single post template file.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<?php if (have_posts()): ?>
    <?php while (have_posts()): the_post(); ?>
        <?php get_template_part('template-parts/content', 'single'); ?>

        <?php if (comments_open() || get_comments_number()): ?>
            <?php comments_template(); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => true,
    'page_title' => get_the_title(),
    'page_description' => '',
];

icrp_layout($content, $layout_args);
