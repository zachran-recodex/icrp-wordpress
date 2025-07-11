<?php
/**
 * Comments template.
 *
 * @package TailPress
 */

if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area my-10 sm:my-20 mx-auto max-w-3xl" x-data="{ showComments: true }">
    <?php if (have_comments()): ?>
        <div class="flex items-center justify-between mb-8">
            <h2 class="comments-title text-3xl font-medium text-zinc-900">
                <?php
                printf(
                    esc_html(_nx(
                        'One comment',
                        '%1$s comments',
                        get_comments_number(),
                        'comments title',
                        'tailpress'
                    )),
                    esc_html(number_format_i18n(get_comments_number()))
                );
                ?>
            </h2>
            <button @click="showComments = !showComments"
                    class="text-sm text-zinc-600 hover:text-zinc-900 transition-colors flex items-center gap-2">
                <span x-text="showComments ? '<?php _e('Hide Comments', 'tailpress'); ?>' : '<?php _e('Show Comments', 'tailpress'); ?>'"></span>
                <svg x-show="!showComments" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="showComments" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </button>
        </div>

        <div x-show="showComments" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 max-h-0"
             x-transition:enter-end="opacity-100 max-h-full"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 max-h-full"
             x-transition:leave-end="opacity-0 max-h-0"
             class="overflow-hidden">
            <ol class="comment-list [&_.children]:ml-20 [&_.children_>_li]:mt-8 mb-12">
            <?php
            wp_list_comments([
                'format'      => 'html5',
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 56,
                'walker'      => new \TailPress\Walkers\CommentWalker(),
            ]);
            ?>
            </ol>
        </div>

        <?php if (get_comment_pages_count() > 1 && get_option('page_comments')): ?>
            <nav class="comment-navigation flex justify-between" id="comment-nav-above" aria-label="<?php esc_attr_e('Comment navigation', 'tailpress'); ?>">
                <div class="nav-previous">
                    <?php previous_comments_link(esc_html__('Older Comments &larr;', 'tailpress')); ?>
                </div>
                <div class="nav-next">
                    <?php next_comments_link(esc_html__('Newer Comments &rarr;', 'tailpress')); ?>
                </div>
            </nav>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')): ?>
        <p class="no-comments text-zinc-600"><?php esc_html_e('Comments are closed.', 'tailpress'); ?></p>
    <?php endif; ?>

    <?php
        $commenter = wp_get_current_commenter();

        $req = get_option('require_name_email');
        $aria_req = ($req ? ' aria-required="true"' : '');

        comment_form([
            'fields' => apply_filters('comment_form_default_fields', [
                'author' =>
                    '<p class="comment-form-author">' .
                    '<input id="author" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your Name*', 'text-domain') . '" name="author" type="text" value="' . esc_attr($commenter['comment_author']) .
                    '" size="30"' . $aria_req . ' /></p>',

                'email' =>
                    '<p class="comment-form-email">' .
                    '<input id="email" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your Email Address*', 'text-domain') . '" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) .
                    '" size="30"' . $aria_req . ' /></p>',

                'url' =>
                    '<p class="comment-form-url">' .
                    '<input id="url" class="bg-light w-full px-4 py-3 mb-4 rounded-xl text-sm" placeholder="' . esc_attr__('Your Website URL', 'text-domain') . '" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                    '" size="30" /></p>'
            ]),
            'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title text-2xl font-bold mb-2">',
            'class_submit'      => 'bg-dark rounded-full px-4 py-1.5 text-sm font-semibold text-light my-4',
            'comment_field'     => '<textarea id="comment" name="comment" class="bg-light w-full px-4 py-3 my-2 rounded-xl text-sm" aria-required="true" placeholder="' . esc_attr__('Your comment', 'text-domain') . '"></textarea>',
            'logged_in_as'      => '<p class="logged-in-as mb-4">',
        ]);
    ?>
</div>
