<?php get_header(); ?>

<div class="container">

    <?php
    /* =========================================================
       HERO CAROUSEL — ACF-managed featured articles
       ─────────────────────────────────────────────────────────
       EDITORIAL: In WP Admin go to Pages and open your Home page.
       Use the three "Featured Article" dropdowns to choose which
       posts appear in this carousel. Changes take effect
       immediately on save — no code changes needed.

       ACF field group : "Homepage Featured Articles"
       ACF fields       : featured_article_1, featured_article_2,
                          featured_article_3  (Post Object, on front page)
       Requires         : Advanced Custom Fields (free or Pro)
       ========================================================= */

    $featured_ids   = array();
    $featured_posts = array();

    // Read the three post objects from the front page itself.
    // get_field() with the page ID reads from that page's post meta.
    // Returns a WP_Post object (return_format = 'object')
    // or null/false when the field is empty.
    $front_page_id = get_option( 'page_on_front' );
    $acf_slots = array(
        get_field( 'featured_article_1', $front_page_id ),
        get_field( 'featured_article_2', $front_page_id ),
        get_field( 'featured_article_3', $front_page_id ),
    );

    foreach ( $acf_slots as $post_obj ) {
        if ( ! ( $post_obj instanceof WP_Post ) ) {
            continue; // slot is empty or ACF is not active — skip gracefully
        }

        $cats = get_the_terms( $post_obj->ID, 'category' );

        $featured_ids[]   = $post_obj->ID;
        $featured_posts[] = array(
            'id'         => $post_obj->ID,
            'title'      => get_the_title( $post_obj->ID ),
            'permalink'  => get_permalink( $post_obj->ID ),
            'excerpt'    => get_the_excerpt( $post_obj ),
            'categories' => ( $cats && ! is_wp_error( $cats ) ) ? $cats : array(),
            'has_thumb'  => has_post_thumbnail( $post_obj->ID ),
        );
    }
    ?>

    <?php if ( ! empty( $featured_posts ) ) :
        $slide_count = count( $featured_posts );
    ?>
    <section
        class="hero-carousel"
        aria-label="Featured articles"
        aria-roledescription="carousel"
        data-slide-count="<?php echo esc_attr( $slide_count ); ?>"
    >
        <div class="carousel-track" aria-live="polite" aria-atomic="false">

            <?php foreach ( $featured_posts as $i => $slide ) : ?>
            <div
                class="carousel-slide<?php echo $i === 0 ? ' is-active' : ''; ?>"
                role="group"
                aria-roledescription="slide"
                aria-label="Slide <?php echo esc_attr( $i + 1 ); ?> of <?php echo esc_attr( $slide_count ); ?>"
                aria-hidden="<?php echo $i === 0 ? 'false' : 'true'; ?>"
            >
                <a href="<?php echo esc_url( $slide['permalink'] ); ?>">
                    <?php if ( $slide['has_thumb'] ) : ?>
                        <?php echo get_the_post_thumbnail( $slide['id'], 'hero-large', array(
                            'class'         => 'hero-image',
                            'loading'       => $i === 0 ? 'eager' : 'lazy',
                            'fetchpriority' => $i === 0 ? 'high'  : 'auto',
                        ) ); ?>
                    <?php endif; ?>
                    <div class="hero-content">
                        <?php if ( ! empty( $slide['categories'] ) ) : ?>
                            <span class="article-category article-category--badge"><?php echo esc_html( $slide['categories'][0]->name ); ?></span>
                        <?php endif; ?>
                        <h2><?php echo esc_html( $slide['title'] ); ?></h2>
                        <p class="hero-excerpt"><?php echo esc_html( $slide['excerpt'] ); ?></p>
                        <span class="hero-read-more">Read Article &rarr;</span>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>

        </div><!-- /.carousel-track -->

        <?php if ( $slide_count > 1 ) : ?>
        <!-- Dot navigation -->
        <div class="carousel-dots" role="tablist" aria-label="Featured article slides">
            <?php for ( $i = 0; $i < $slide_count; $i++ ) : ?>
            <button
                class="carousel-dot<?php echo $i === 0 ? ' is-active' : ''; ?>"
                role="tab"
                aria-selected="<?php echo $i === 0 ? 'true' : 'false'; ?>"
                aria-label="Show slide <?php echo esc_attr( $i + 1 ); ?>"
                data-index="<?php echo esc_attr( $i ); ?>"
            ></button>
            <?php endfor; ?>
        </div><!-- /.carousel-dots -->
        <?php endif; ?>

    </section><!-- /.hero-carousel -->
    <?php endif; ?>


    <?php
    /* =========================================================
       LATEST NEWS — 6 posts, excluding the hero posts
       ========================================================= */
    $latest_query = new WP_Query(array(
        'posts_per_page'      => 6,
        'post__not_in'        => $featured_ids,
        'ignore_sticky_posts' => 1,
    ));
    ?>

    <?php if ( $latest_query->have_posts() ) : ?>
    <section class="latest-news-section">
        <h2 class="section-heading">Latest News</h2>
        <div class="article-grid">
            <?php while ( $latest_query->have_posts() ) : $latest_query->the_post(); ?>
                <?php $cats = get_the_category(); ?>
                <article class="article-card">
                    <?php if ( has_post_thumbnail() ) : ?>
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('card-medium', array('class' => 'card-image', 'loading' => 'lazy')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ( ! empty($cats) ) : ?>
                            <a class="article-category" href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>">
                                <?php echo esc_html($cats[0]->name); ?>
                            </a>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                        <div class="card-meta">
                            <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                        </div>
                        <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <a class="read-more" href="<?php the_permalink(); ?>">Read More &rarr;</a>
                    </div>
                </article>
            <?php endwhile; wp_reset_postdata(); ?>
        </div>
    </section>
    <?php endif; ?>



    <?php
    /* =========================================================
       HOMEPAGE BANNER AD — ACF-managed
       ─────────────────────────────────────────────────────────
       MARKETING: Go to Settings › Advertisement Settings in
       WP Admin and open the "Homepage Banner Ad" tab to update
       the sponsor image, headline, link, or toggle it on/off.
       ========================================================= */
    require_once get_template_directory() . '/components/ad-slot.php';
    render_ad_slot( array( 'slot' => 'homepage' ) );
    ?>


    <!-- NEWSLETTER SIGNUP -->
    <?php
    include_once get_template_directory() . '/components/newsletter-signup.php';
    render_newsletter_signup_section(array(
        'heading' => 'Subscribe for updates',
        'text'    => 'Get the latest news and analysis from The Strata Review delivered straight to your inbox.',
    ));
    ?>


    <?php
    /* =========================================================
       CATEGORY SPOTLIGHT — "Industry News" (or first available)
       1 large article left + 2 smaller articles right
       ========================================================= */
    $spotlight_cat = get_category_by_slug('industry-news');

    if ( $spotlight_cat ) :
        $spotlight_query = new WP_Query(array(
            'posts_per_page'      => 3,
            'cat'                 => $spotlight_cat->term_id,
            'ignore_sticky_posts' => 1,
        ));

        if ( $spotlight_query->have_posts() ) :
            $spot_posts = array();
            while ( $spotlight_query->have_posts() ) :
                $spotlight_query->the_post();
                $spot_posts[] = array(
                    'id'         => get_the_ID(),
                    'title'      => get_the_title(),
                    'permalink'  => get_permalink(),
                    'excerpt'    => get_the_excerpt(),
                    'categories' => get_the_category(),
                    'has_thumb'  => has_post_thumbnail(),
                );
            endwhile;
            wp_reset_postdata();
    ?>
    <section class="category-spotlight">
        <h2 class="section-heading"><?php echo esc_html($spotlight_cat->name); ?></h2>
        <div class="spotlight-grid">

            <!-- Spotlight primary (left) -->
            <?php $sp = $spot_posts[0]; ?>
            <article class="spotlight-primary">
                <?php if ( $sp['has_thumb'] ) : ?>
                    <a href="<?php echo esc_url($sp['permalink']); ?>">
                        <?php echo get_the_post_thumbnail($sp['id'], 'card-medium', array('class' => 'card-image', 'loading' => 'lazy')); ?>
                    </a>
                <?php endif; ?>
                <div class="card-body">
                    <?php if ( ! empty($sp['categories']) ) : ?>
                        <a class="article-category" href="<?php echo esc_url(get_category_link($sp['categories'][0]->term_id)); ?>">
                            <?php echo esc_html($sp['categories'][0]->name); ?>
                        </a>
                    <?php endif; ?>
                    <h3><a href="<?php echo esc_url($sp['permalink']); ?>"><?php echo esc_html($sp['title']); ?></a></h3>
                    <p class="card-excerpt"><?php echo esc_html($sp['excerpt']); ?></p>
                    <a class="read-more" href="<?php echo esc_url($sp['permalink']); ?>">Read More &rarr;</a>
                </div>
            </article>

            <!-- Spotlight secondary (right, stacked) -->
            <?php if ( count($spot_posts) > 1 ) : ?>
            <div class="spotlight-secondary-stack">
                <?php for ( $i = 1; $i < count($spot_posts); $i++ ) : $ss = $spot_posts[$i]; ?>
                <article class="spotlight-secondary">
                    <?php if ( $ss['has_thumb'] ) : ?>
                        <a href="<?php echo esc_url($ss['permalink']); ?>">
                            <?php echo get_the_post_thumbnail($ss['id'], 'card-medium', array('class' => 'card-image', 'loading' => 'lazy')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ( ! empty($ss['categories']) ) : ?>
                            <a class="article-category" href="<?php echo esc_url(get_category_link($ss['categories'][0]->term_id)); ?>">
                                <?php echo esc_html($ss['categories'][0]->name); ?>
                            </a>
                        <?php endif; ?>
                        <h3><a href="<?php echo esc_url($ss['permalink']); ?>"><?php echo esc_html($ss['title']); ?></a></h3>
                        <p class="card-excerpt"><?php echo esc_html($ss['excerpt']); ?></p>
                    </div>
                </article>
                <?php endfor; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php
        endif;
    endif;
    ?>

    <?php
    /* =========================================================
       FOOTER PROMO AD — ACF-managed (optional)
       ─────────────────────────────────────────────────────────
       MARKETING: Go to Settings › Advertisement Settings in
       WP Admin and open the "Footer Promo Ad" tab to manage
       this slot, or toggle it off to hide it entirely.
       ========================================================= */
    render_ad_slot( array( 'slot' => 'footer' ) );
    ?>

</div>

<?php get_footer(); ?>
