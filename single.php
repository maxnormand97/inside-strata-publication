<?php get_header(); ?>

<div class="container">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article class="single-article">

        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('hero-large', array('class' => 'single-hero-image')); ?>
        <?php endif; ?>

        <?php $categories = get_the_category(); ?>
        <?php if ( ! empty($categories) ) : ?>
            <a class="article-category" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        <?php endif; ?>

        <h1><?php the_title(); ?></h1>

        <div class="article-meta">
            <span class="author">By <?php the_author(); ?></span>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
        </div>

        <div class="article-content">
            <?php the_content(); ?>
        </div>

        <!-- INLINE PROMO SLOT -->
        <div class="inline-promo-slot">
            <p>Promotional Banner &mdash; Ad Space</p>
        </div>

    </article>

    <?php endwhile; endif; ?>

    <!-- NEWSLETTER SIGNUP -->
    <section class="newsletter-section">
        <h2>Stay Informed</h2>
        <p>Get the latest industry news delivered straight to your inbox.</p>
        <div class="newsletter-form">
            <?php echo do_shortcode('[mc4wp_form]'); ?>
        </div>
    </section>

    <!-- RELATED ARTICLES -->
    <?php
    $categories = get_the_category();
    if ( ! empty($categories) ) :
        $related_args = array(
            'posts_per_page'      => 3,
            'post__not_in'        => array(get_the_ID()),
            'category__in'        => array($categories[0]->term_id),
            'ignore_sticky_posts' => 1,
        );
        $related_query = new WP_Query($related_args);

        if ( $related_query->have_posts() ) :
    ?>
    <section class="related-articles">
        <h2 class="section-heading">Related Articles</h2>
        <div class="article-grid">
            <?php while ( $related_query->have_posts() ) : $related_query->the_post(); ?>
                <?php $rel_categories = get_the_category(); ?>
                <article class="article-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('card-medium', array('class' => 'card-image')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ( ! empty($rel_categories) ) : ?>
                            <a class="article-category" href="<?php echo esc_url(get_category_link($rel_categories[0]->term_id)); ?>">
                                <?php echo esc_html($rel_categories[0]->name); ?>
                            </a>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <a class="read-more" href="<?php the_permalink(); ?>">Read More &rarr;</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); endif; ?>

</div>

<?php get_footer(); ?>
