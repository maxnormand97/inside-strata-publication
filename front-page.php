<?php get_header(); ?>

<div class="container">

    <?php
    /* =========================================================
       HERO SECTION — 3 most recent posts
       Post 1 = large primary (left), Posts 2–3 = secondary (right)
       ========================================================= */
    $hero_query = new WP_Query(array(
        'posts_per_page'      => 3,
        'ignore_sticky_posts' => 1,
    ));

    $hero_ids   = array();
    $hero_posts = array();

    if ( $hero_query->have_posts() ) :
        while ( $hero_query->have_posts() ) :
            $hero_query->the_post();
            $hero_ids[]   = get_the_ID();
            $hero_posts[] = array(
                'id'         => get_the_ID(),
                'title'      => get_the_title(),
                'permalink'  => get_permalink(),
                'excerpt'    => get_the_excerpt(),
                'categories' => get_the_category(),
                'has_thumb'  => has_post_thumbnail(),
            );
        endwhile;
        wp_reset_postdata();
    endif;
    ?>

    <?php if ( ! empty($hero_posts) ) : ?>
    <section class="hero-section">
        <div class="hero-grid">

            <!-- PRIMARY HERO (latest post) -->
            <?php $primary = $hero_posts[0]; ?>
            <div class="hero-primary">
                <a href="<?php echo esc_url($primary['permalink']); ?>">
                    <?php if ( $primary['has_thumb'] ) : ?>
                        <?php echo get_the_post_thumbnail($primary['id'], 'hero-large', array('class' => 'hero-image')); ?>
                    <?php endif; ?>
                    <div class="hero-content">
                        <?php if ( ! empty($primary['categories']) ) : ?>
                            <span class="article-category article-category--badge"><?php echo esc_html($primary['categories'][0]->name); ?></span>
                        <?php endif; ?>
                        <h2><?php echo esc_html($primary['title']); ?></h2>
                        <p class="hero-excerpt"><?php echo esc_html($primary['excerpt']); ?></p>
                    </div>
                </a>
            </div>

            <!-- SECONDARY HEROES (posts 2 & 3) -->
            <?php if ( count($hero_posts) > 1 ) : ?>
            <div class="hero-secondary-stack">
                <?php for ( $i = 1; $i < count($hero_posts); $i++ ) : $sec = $hero_posts[$i]; ?>
                <div class="hero-secondary">
                    <a href="<?php echo esc_url($sec['permalink']); ?>">
                        <?php if ( $sec['has_thumb'] ) : ?>
                            <?php echo get_the_post_thumbnail($sec['id'], 'card-medium', array('class' => 'hero-image')); ?>
                        <?php endif; ?>
                        <div class="hero-content">
                            <?php if ( ! empty($sec['categories']) ) : ?>
                                <span class="article-category article-category--badge"><?php echo esc_html($sec['categories'][0]->name); ?></span>
                            <?php endif; ?>
                            <h3><?php echo esc_html($sec['title']); ?></h3>
                            <p class="hero-excerpt"><?php echo esc_html($sec['excerpt']); ?></p>
                        </div>
                    </a>
                </div>
                <?php endfor; ?>
            </div>
            <?php endif; ?>

        </div>
    </section>
    <?php endif; ?>


    <?php
    /* =========================================================
       LATEST NEWS — 6 posts, excluding the hero posts
       ========================================================= */
    $latest_query = new WP_Query(array(
        'posts_per_page'      => 6,
        'post__not_in'        => $hero_ids,
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
                            <?php the_post_thumbnail('card-medium', array('class' => 'card-image')); ?>
                        </a>
                    <?php endif; ?>
                    <div class="card-body">
                        <?php if ( ! empty($cats) ) : ?>
                            <a class="article-category" href="<?php echo esc_url(get_category_link($cats[0]->term_id)); ?>">
                                <?php echo esc_html($cats[0]->name); ?>
                            </a>
                        <?php endif; ?>
                        <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
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
       SPONSORED POSTS / OUR BRANDS
       ========================================================= */
    include_once get_template_directory() . '/components/brand-card.php';

    $sponsored_brands = array(
        array(
            'name'        => 'Cohabit',
            'description' => 'Innovative co-living spaces designed for modern professionals seeking community and convenience.',
            'bg_image'    => 'https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?auto=format&fit=crop&w=1200&q=80',
            'url'         => 'https://cohabit.com',
        ),
        array(
            'name'        => 'Lannock',
            'description' => 'Premium menswear and accessories crafted with timeless style and exceptional quality.',
            'bg_image'    => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?auto=format&fit=crop&w=1200&q=80',
            'url'         => 'https://lannock.com',
        ),
        array(
            'name'        => 'Kerin Benson',
            'description' => 'Contemporary fashion and lifestyle brand offering unique pieces for the discerning individual.',
            'bg_image'    => 'https://images.unsplash.com/photo-1493666438817-866a91353ca9?auto=format&fit=crop&w=1200&q=80',
            'url'         => 'https://kerinbenson.com',
        ),
        array(
            'name'        => 'Strata Studio',
            'description' => 'Editorial, data-driven storytelling for property and finance leaders.',
            'bg_image'    => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?auto=format&fit=crop&w=1200&q=80',
            'url'         => 'https://example.com',
        ),
    );
    ?>

    <?php if ( ! empty( $sponsored_brands ) ) : ?>
    <section class="sponsored-section">
        <h2 class="section-heading">Our Brands</h2>
        <p class="section-intro">Discover our curated selection of premium brands and partners that align with our commitment to quality and innovation.</p>
        <div class="sponsored-grid">
            <?php foreach ( $sponsored_brands as $brand ) : ?>
                <?php render_brand_card( $brand ); ?>
            <?php endforeach; ?>
        </div>
    </section>
    <?php endif; ?>


    <!-- PROMO BANNER SLOT -->
    <div class="promo-slot">
        <p>Promotional Banner &mdash; Advertisement</p>
    </div>


    <!-- NEWSLETTER SIGNUP -->
    <?php
    include_once get_template_directory() . '/components/newsletter-signup.php';
    render_newsletter_signup_section(array(
        'heading' => 'Subscribe for updates',
        'text'    => 'Get the latest news and analysis from Inside Strata delivered straight to your inbox.',
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
                        <?php echo get_the_post_thumbnail($sp['id'], 'card-medium', array('class' => 'card-image')); ?>
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
                            <?php echo get_the_post_thumbnail($ss['id'], 'card-medium', array('class' => 'card-image')); ?>
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

</div>

<?php get_footer(); ?>
