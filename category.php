<?php get_header(); ?>

<section class="category-archive">
    <h1><?php single_cat_title(); ?></h1>

    <?php if (category_description()) : ?>
        <div class="category-description">
            <?php echo category_description(); ?>
        </div>
    <?php endif; ?>

    <?php if (have_posts()) : ?>
        <div class="posts-list">
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class(); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('medium'); ?>
                        </a>
                    <?php endif; ?>
                    <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <div class="entry-meta">
                        <time datetime="<?php echo get_the_date('c'); ?>"><?php echo get_the_date(); ?></time>
                    </div>
                    <div class="entry-excerpt">
                        <?php the_excerpt(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>

        <div class="pagination">
            <?php the_posts_pagination(); ?>
        </div>
    <?php else : ?>
        <p>No posts found in this category.</p>
    <?php endif; ?>
</section>

<?php get_footer(); ?>
