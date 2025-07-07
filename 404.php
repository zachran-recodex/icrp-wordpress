<?php
/**
 * 404 page template.
 *
 * @package TailPress
 */

require_once get_template_directory() . '/layout.php';

ob_start();
?>

<div class="text-center py-24">
    <h1 class="text-6xl font-bold text-zinc-900 mb-4">404</h1>
    <h2 class="text-2xl font-semibold text-zinc-700 mb-4">
        <?php _e('Page Not Found', 'tailpress'); ?>
    </h2>
    <p class="text-zinc-600 mb-8">
        <?php _e('Sorry, the page you are looking for could not be found.', 'tailpress'); ?>
    </p>
    <a href="<?php echo home_url(); ?>" class="inline-flex rounded-full px-4 py-1.5 text-sm font-semibold transition bg-dark text-white hover:bg-dark/90 !no-underline">
        <?php _e('Go Home', 'tailpress'); ?>
    </a>
</div>

<?php
$content = ob_get_clean();

$layout_args = [
    'show_breadcrumbs' => true,
    'page_title' => __('Page Not Found', 'tailpress'),
    'page_description' => __('The page you are looking for could not be found.', 'tailpress'),
];

icrp_layout($content, $layout_args);
