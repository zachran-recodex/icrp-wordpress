<article id="post-<?php the_ID(); ?>" <?php post_class('prose prose-lg max-w-none'); ?>>
    <header class="mx-auto flex max-w-5xl flex-col text-center mb-12">
        <?php if (!is_page()): ?>
            <time datetime="<?php echo get_the_date('c'); ?>" itemprop="datePublished" class="order-first text-sm text-zinc-600 mb-4">
                <?php echo get_the_date(); ?>
            </time>
        <?php endif; ?>
        
        <h1 class="text-4xl md:text-5xl font-medium tracking-tight text-zinc-950 mb-6 leading-tight">
            <?php the_title(); ?>
        </h1>

        <?php if (!is_page()): ?>
            <div class="flex items-center justify-center gap-4 text-sm text-zinc-600">
                <div class="flex items-center gap-2">
                    <?php echo get_avatar(get_the_author_meta('ID'), 24, '', '', ['class' => 'w-6 h-6 rounded-full']); ?>
                    <span>by <?php the_author(); ?></span>
                </div>
                <?php if (get_comments_number()): ?>
                    <span>•</span>
                    <a href="<?php comments_link(); ?>" class="hover:text-primary transition-colors">
                        <?php printf(_n('1 Comment', '%s Comments', get_comments_number(), 'tailpress'), get_comments_number()); ?>
                    </a>
                <?php endif; ?>
                <?php if (get_the_category()): ?>
                    <span>•</span>
                    <span><?php the_category(', '); ?></span>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if (has_post_thumbnail()): ?>
        <div class="mt-8 mb-12 mx-auto max-w-4xl rounded-2xl bg-light overflow-hidden">
            <?php the_post_thumbnail('large', ['class' => 'w-full h-auto object-cover']); ?>
        </div>
    <?php endif; ?>

    <div class="entry-content mx-auto max-w-3xl prose prose-lg prose-zinc prose-headings:font-semibold prose-headings:text-zinc-900 prose-p:text-zinc-600 prose-a:text-primary prose-a:no-underline hover:prose-a:text-primary/80 prose-strong:text-zinc-900 prose-code:text-zinc-900 prose-code:bg-zinc-100 prose-code:px-1 prose-code:py-0.5 prose-code:rounded prose-pre:bg-zinc-900 prose-pre:text-zinc-100">
        <?php the_content(); ?>
    </div>

    <?php if (get_the_tags()): ?>
        <div class="mx-auto max-w-3xl mt-12 pt-8 border-t border-zinc-200">
            <h3 class="text-lg font-semibold text-zinc-900 mb-4"><?php _e('Tags', 'tailpress'); ?></h3>
            <div class="flex flex-wrap gap-2">
                <?php foreach (get_the_tags() as $tag): ?>
                    <a href="<?php echo get_tag_link($tag->term_id); ?>" class="inline-block bg-zinc-100 hover:bg-zinc-200 text-zinc-700 text-sm px-3 py-1 rounded-full transition-colors">
                        #<?php echo $tag->name; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>

    <?php if (!is_page()): ?>
        <div class="mx-auto max-w-3xl mt-12 pt-8 border-t border-zinc-200">
            <div class="flex items-center gap-4">
                <?php echo get_avatar(get_the_author_meta('ID'), 64, '', '', ['class' => 'w-16 h-16 rounded-full']); ?>
                <div>
                    <h3 class="text-lg font-semibold text-zinc-900"><?php the_author(); ?></h3>
                    <?php if (get_the_author_meta('description')): ?>
                        <p class="text-zinc-600 mt-1"><?php echo get_the_author_meta('description'); ?></p>
                    <?php endif; ?>
                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="text-primary hover:text-primary/80 text-sm transition-colors">
                        <?php _e('View all posts', 'tailpress'); ?>
                    </a>
                </div>
            </div>
        </div>
    <?php endif; ?>
</article>
