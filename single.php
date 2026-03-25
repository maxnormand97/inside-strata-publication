<?php get_header(); ?>

<?php
/*
 * Load the ad-slot component once so render_ad_slot() is available
 * to both the inline placement and the sidebar placement below.
 */
require_once get_template_directory() . '/components/ad-slot.php';
require_once get_template_directory() . '/components/sidebar-ad.php';
?>

<div class="container">

    <?php
    /*
     * Two-column layout: article content on the left, sticky sidebar on the right.
     * The sidebar collapses to a single column on screens narrower than 992 px.
     * See .single-layout in style.css.
     */
    ?>
    <div class="single-layout"><!-- open: two-column layout -->

    <div class="single-main"><!-- open: article column -->

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article class="single-article">

        <?php if ( has_post_thumbnail() ) : ?>
            <?php
            $thumb_id  = get_post_thumbnail_id();
            $thumb_alt = trim( get_post_meta( $thumb_id, '_wp_attachment_image_alt', true ) );
            the_post_thumbnail( 'hero-large', array(
                'class' => 'single-hero-image',
                'alt'   => $thumb_alt ?: get_the_title(),
            ) );
            ?>
        <?php endif; ?>

        <?php $categories = get_the_category(); ?>
        <?php if ( ! empty($categories) ) : ?>
            <a class="article-category" href="<?php echo esc_url(get_category_link($categories[0]->term_id)); ?>">
                <?php echo esc_html($categories[0]->name); ?>
            </a>
        <?php endif; ?>

        <h1><?php echo esc_html( get_the_title() ); ?></h1>

        <div class="article-meta">
            <span class="author">By <?php echo esc_html( get_the_author() ); ?></span>
            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>"><?php echo esc_html(get_the_date()); ?></time>
        </div>

        <div class="article-content">
            <?php the_content(); ?>
        </div>

        <!-- INLINE AD — ACF-managed
             MARKETING: WP Admin → Settings → Advertisement Settings → Article Inline Ad
             Toggle on/off or swap sponsor content there without editing code. -->
        <?php render_ad_slot( array( 'slot' => 'inline' ) ); ?>

    </article>

    <?php endwhile; endif; ?>

    <!-- NEWSLETTER SIGNUP -->
    <?php
    include_once get_template_directory() . '/components/newsletter-signup.php';
    render_newsletter_signup_section(array(
        'heading' => 'Subscribe for updates',
        'text'    => 'Get curated insights and market updates directly in your inbox.',
    ));
    ?>

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
                        <div class="card-meta">
                            <time datetime="<?php echo esc_attr( get_the_date('c') ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
                        </div>
                        <p class="card-excerpt"><?php echo esc_html(get_the_excerpt()); ?></p>
                        <a class="read-more" href="<?php the_permalink(); ?>">Read More &rarr;</a>
                    </div>
                </article>
            <?php endwhile; ?>
        </div>
    </section>
    <?php endif; wp_reset_postdata(); endif; ?>

    </div><!-- /single-main -->

    <aside class="single-sidebar">
        <?php
        /*
         * SIDEBAR AD — ACF-managed
         * MARKETING: WP Admin → Settings → Advertisement Settings → Article Sidebar Ad
         * Toggle on/off or swap sponsor content there without editing code.
         */
        render_sidebar_ad();
        ?>
    </aside><!-- /single-sidebar -->

    </div><!-- /single-layout -->

</div>

<?php get_footer(); ?>
