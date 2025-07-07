<?php
/**
 * Sidebar template.
 *
 * @package TailPress
 */

if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
    <div class="space-y-8">
        <?php dynamic_sidebar('sidebar-1'); ?>
    </div>
</aside>