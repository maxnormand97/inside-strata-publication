<?php get_header(); ?>

<div class="container">
<section class="category-archive">

    <!-- ── Category header ───────────────────────────────────── -->
    <header class="category-archive__header">
        <h1 class="category-archive__title"><?php single_cat_title(); ?></h1>
        <?php if ( category_description() ) : ?>
            <div class="category-archive__description">
                <?php echo wp_kses_post( category_description() ); ?>
            </div>
        <?php endif; ?>
    </header>

    <?php if ( have_posts() ) :

        /*
         * Buffer all posts from the main query so we can split them:
         *   $featured_post  — first post, rendered as a large lead card
         *   $grid_before    — posts 2–4, first grid segment
         *   $grid_after     — posts 5+, second grid segment (after the ad)
         *
         * $wp_query stays intact so the_posts_pagination() works correctly.
         */
        $archive_posts = array();
        while ( have_posts() ) :
            the_post();
            $archive_posts[] = $post;
        endwhile;

        $featured_post = $archive_posts[0];
        $grid_before   = array_slice( $archive_posts, 1, 3 ); // posts 2–4
        $grid_after    = array_slice( $archive_posts, 4 );    // posts 5+
    ?>

    <!-- ── Featured (lead) post ──────────────────────────────── -->
    <?php
        global $post;
        $post = $featured_post;
        setup_postdata( $post );
        $feat_cats = get_the_category();
    ?>
    <article <?php post_class( 'category-featured-post' ); ?>>
        <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" class="category-featured-post__image-link" tabindex="-1" aria-hidden="true">
                <?php the_post_thumbnail( 'hero-large', array( 'class' => 'category-featured-post__image' ) ); ?>
            </a>
        <?php endif; ?>
        <div class="category-featured-post__body">
            <?php if ( ! empty( $feat_cats ) ) : ?>
                <a class="article-category" href="<?php echo esc_url( get_category_link( $feat_cats[0]->term_id ) ); ?>">
                    <?php echo esc_html( $feat_cats[0]->name ); ?>
                </a>
            <?php endif; ?>
            <h2 class="category-featured-post__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <div class="category-featured-post__meta">
                <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                <?php $author = get_the_author(); if ( $author ) : ?>
                    <span class="category-featured-post__sep" aria-hidden="true">&middot;</span>
                    <span class="category-featured-post__author"><?php echo esc_html( $author ); ?></span>
                <?php endif; ?>
            </div>
            <p class="category-featured-post__excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
            <a class="read-more" href="<?php the_permalink(); ?>">Read Article &rarr;</a>
        </div>
    </article>

    <!-- ── First grid segment (posts 2–4) ────────────────────── -->
    <?php if ( ! empty( $grid_before ) ) : ?>
    <div class="article-grid category-archive__grid">
        <?php foreach ( $grid_before as $post ) :
            setup_postdata( $post );
            $card_cats = get_the_category();
        ?>
            <article <?php post_class( 'article-card' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'card-medium', array( 'class' => 'card-image' ) ); ?>
                    </a>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ( ! empty( $card_cats ) ) : ?>
                        <a class="article-category" href="<?php echo esc_url( get_category_link( $card_cats[0]->term_id ) ); ?>">
                            <?php echo esc_html( $card_cats[0]->name ); ?>
                        </a>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="card-meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                    </div>
                    <p class="card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <a class="read-more" href="<?php the_permalink(); ?>">Read More &rarr;</a>
                </div>
            </article>
        <?php endforeach; wp_reset_postdata(); ?>
    </div><!-- /.article-grid -->
    <?php endif; ?>

    <!-- ── Footer promo ad — after first few posts ───────────── -->
    <?php
    /* =========================================================
       CATEGORY FOOTER AD
       ─────────────────────────────────────────────────────────
       Advanced Ads is now the primary ad source (placement:
       'category_footer'). The ACF-managed slot is retained as a
       fallback if the plugin is inactive or the placement is empty.

       MARKETING: Advanced Ads › Placements › category_footer
       ========================================================= */
    $advanced_ad_cat_footer = '';
    if ( function_exists( 'the_ad_placement' ) ) {
        ob_start();
        the_ad_placement( 'category_footer' );
        $advanced_ad_cat_footer = ob_get_clean();
    }
    if ( ! empty( trim( $advanced_ad_cat_footer ) ) ) {
        ?>
        <aside class="ad-slot ad-slot--footer category-archive__ad" aria-label="Sponsored content">
            <span class="ad-slot__label">Sponsored</span>
            <?php echo $advanced_ad_cat_footer; ?>
        </aside>
        <?php

    }
    ?>

    <!-- ── Second grid segment (posts 5+) ────────────────────── -->
    <?php if ( ! empty( $grid_after ) ) : ?>
    <div class="article-grid category-archive__grid">
        <?php foreach ( $grid_after as $post ) :
            setup_postdata( $post );
            $card_cats = get_the_category();
        ?>
            <article <?php post_class( 'article-card' ); ?>>
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'card-medium', array( 'class' => 'card-image' ) ); ?>
                    </a>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ( ! empty( $card_cats ) ) : ?>
                        <a class="article-category" href="<?php echo esc_url( get_category_link( $card_cats[0]->term_id ) ); ?>">
                            <?php echo esc_html( $card_cats[0]->name ); ?>
                        </a>
                    <?php endif; ?>
                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                    <div class="card-meta">
                        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                    </div>
                    <p class="card-excerpt"><?php echo esc_html( get_the_excerpt() ); ?></p>
                    <a class="read-more" href="<?php the_permalink(); ?>">Read More &rarr;</a>
                </div>
            </article>
        <?php endforeach; ?>
    </div><!-- /.article-grid -->
    <?php endif; ?>

    <?php wp_reset_postdata(); ?>

    <?php
    $pagination = get_the_posts_pagination( array(
        'mid_size'  => 2,
        'prev_text' => __( '&larr; Newer', 'inside-strata-theme' ),
        'next_text' => __( 'Older &rarr;', 'inside-strata-theme' ),
    ) );
    if ( $pagination ) : ?>
    <nav class="pagination" aria-label="<?php esc_attr_e( 'Archive pages', 'inside-strata-theme' ); ?>">
        <?php echo $pagination; ?>
    </nav>
    <?php endif; ?>

    <?php else : ?>
        <p class="category-archive__empty">No posts found in this category.</p>
    <?php endif; ?>

</section>
</div>

<?php get_footer(); ?>
